import fs from "fs";

import CssMinimizerPlugin from "css-minimizer-webpack-plugin";
import TerserPlugin from "terser-webpack-plugin";
import type { Configuration } from "webpack";

import { buildDevServer } from "./build.server";
import { buildLoaders } from "./build.loaders";
import { buildPlugins } from "./build.plugins";
import { buildResolvers } from "./build.resolvers";
import type { IBuildOptions, IEntryPaths } from "./types";

export function buildWebpack(options: IBuildOptions): Configuration {
	const { mode, paths } = options;

	const isProduction = mode === "production";

	const { blocks, shortcodes, ...entryPaths } = paths.entry;
	const entry: IEntryPaths = { ...entryPaths };

	const config: Configuration = {
		mode: mode ?? "development",
		entry: {},
		output: {
			path: paths.output,
			filename: "js/[name].js",
			clean: isProduction,
		},
		plugins: buildPlugins(options),
		module: {
			rules: buildLoaders(options),
		},
		resolve: buildResolvers(options),
		devtool: isProduction ? "source-map" : "eval-cheap-module-source-map",
		devServer: isProduction ? undefined : buildDevServer(options),
	};

	const isExistBlocksStyles = fs.existsSync(blocks);
	const isExistShortcodeStyles = fs.existsSync(shortcodes);

	if (isExistBlocksStyles) {
		entry.blocks = blocks;
	}

	if (isExistShortcodeStyles) {
		entry.shortcodes = shortcodes;
	}

	if (typeof config.entry === "object") {
		config.entry = {
			...config.entry,
			...entry,
		};
	}

	if (isProduction) {
		config.optimization = {
			splitChunks: {
				cacheGroups: {
					styles: {
						name: "styles",
						type: "css/mini-extract",
						chunks: "all",
						enforce: true,
					},
				},
			},
			minimizer: [
				new CssMinimizerPlugin(),
				new TerserPlugin({ terserOptions: { keep_fnames: true } }),
			],
		};
	}

	return config;
}
