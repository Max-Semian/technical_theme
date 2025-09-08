export interface IEntryPaths {
	main: string;
	imageUploader: string;
	blocks?: string;
	shortcodes?: string;
}

export type TEntryPathKeys = keyof IEntryPaths;

export interface IBuildPaths {
	entry: IEntryPaths;
	output: string;
	src: string;
}

export type TBuildMode = "production" | "development";

export interface IBuildOptions {
	mode: TBuildMode;
	port: number;
	paths: IBuildPaths;
}

export type TEnvVariables = Partial<IBuildOptions>;
