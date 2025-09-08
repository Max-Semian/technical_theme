(() => {
  var e,
    t,
    l,
    a = {
      353: (e, t, l) => {
        "use strict";
        const a = window.wp.blocks,
          o = JSON.parse(
            '{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"wp-custom-blocks/banner","version":"0.1.2","title":"Main banner","category":"wp-custom-blocks","description":"Main banner","supports":{"html":false},"textdomain":"banner-block","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css","viewScript":"file:./init-banner-sliders.js"}',
          ),
          r = window.React;
        var s = l(942),
          n = l.n(s);
        const i = window.wp.blockEditor,
          c = window.wp.components,
          m = window.wp.element,
          d = window.wp.i18n,
          p = JSON.parse('{"xs":320,"sm":640,"md":768,"lg":1024,"xl":1280}'),
          u = JSON.parse(
            '[{"name":"Small","slug":"small","size":14},{"name":"Medium","slug":"medium","size":16},{"name":"Large","slug":"large","size":18},{"name":"Big","slug":"big","size":24}]',
          );
        var b = l.t(u, 2);
        const g = JSON.parse(
          '[{"label":"H1","value":"h1"},{"label":"H2","value":"h2"},{"label":"H3","value":"h3"},{"label":"H4","value":"h4"},{"label":"H5","value":"h5"},{"label":"H6","value":"h6"},{"label":"P","value":"p"}]',
        );
        var w = l.t(g, 2);
        const v = JSON.parse(
          '[{"label":"Capitalize","value":"capitalize"},{"label":"Lowercase","value":"lowercase"},{"label":"Uppercase","value":"uppercase"},{"label":"None","value":"none"}]',
        );
        var k = l.t(v, 2);
        const f = {
            DEFAULT: "#17946d",
            grizzly: "#a5d6c6",
            light: "#ceede3",
            brightest: "#f1fbf8",
          },
          x = { DEFAULT: "#121212", grizzly: "#4e4e53", opacity: "#000c" },
          E = {
            DEFAULT: "#fff",
            light: "#f0eff8",
            opacity: "#f2eff833",
            standard: "#fff",
          },
          h = { DEFAULT: "#4e4e4e", light: "#7f8c8d", dark: "#353535" },
          C = p,
          y = (Array.from(w), Array.from(k), Array.from(b), "swiper-slider"),
          _ = window.wp.compose,
          T = (e, t) => e[t].default,
          N = [
            { name: (0, d.__)("Black", "wp-custom-blocks"), color: "#000" },
            { name: (0, d.__)("White", "wp-custom-blocks"), color: "#fff" },
            { name: (0, d.__)("Green", "wp-custom-blocks"), color: "#17946d" },
            { name: (0, d.__)("Purple", "wp-custom-blocks"), color: "#a689ff" },
            {
              name: (0, d.__)("Purple black", "wp-custom-blocks"),
              color: "#1c1230",
            },
            { name: (0, d.__)("Blue", "wp-custom-blocks"), color: "#3070e8" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#a97bff" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#bdabda" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#f5eeff" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#343741" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#2b39b4" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#2e3246" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#34495e" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#ff2453" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#ffd32a" },
            { name: (0, d.__)("Color", "wp-custom-blocks"), color: "#d63031" },
          ],
          S = ({
            label: e,
            name: t,
            disabled: l,
            attributes: a,
            defaultAttributes: o,
            setAttributes: s,
          }) => {
            const [i, p] = (0, m.useState)(!1),
              u = `color-control-${(0, _.useInstanceId)(S)}`,
              b = a[t],
              g = (e) => s({ [t]: e });
            return (0, r.createElement)(
              c.Flex,
              null,
              (0, r.createElement)(
                c.FlexBlock,
                null,
                (0, r.createElement)(c.BaseControl, {
                  id: u,
                  label: e,
                  className: n()("dgYvuo4SPB7iJTvwdKqA", "!mb-0"),
                  __nextHasNoMarginBottom: !0,
                  children: "",
                }),
              ),
              (0, r.createElement)(
                c.FlexItem,
                null,
                (0, r.createElement)(c.Button, {
                  icon: "image-rotate",
                  iconSize: 14,
                  label: (0, d.__)("Reset", "wp-custom-blocks"),
                  disabled: l,
                  size: "small",
                  onClick: () => g(String(T(o, t))),
                  className: n()("hm_U2TKdAiPMZ3zPD5YZ", "w-3", {
                    active: b,
                    disabled: !b,
                  }),
                }),
              ),
              (0, r.createElement)(
                c.FlexItem,
                null,
                (0, r.createElement)(
                  "button",
                  {
                    disabled: l,
                    className: n()("UmSE2k_HSA75GHz8g2hh", "w-6 h-6"),
                    onClick: () => p(!0),
                  },
                  (0, r.createElement)(c.ColorIndicator, { colorValue: b }),
                ),
                i &&
                  (0, r.createElement)(
                    c.Popover,
                    {
                      position: "bottom right",
                      onFocusOutside: () => p(!1),
                      offset: 5,
                    },
                    (0, r.createElement)(c.ColorPicker, {
                      color: b,
                      onChange: (e) => g(e),
                      enableAlpha: !0,
                    }),
                    (0, r.createElement)(
                      "div",
                      { className: "px-3 pb-3" },
                      (0, r.createElement)(
                        "label",
                        {
                          className: "label inline-block mb-2",
                          htmlFor: "colors-palette",
                        },
                        (0, d.__)("Colors Palette", "wp-custom-blocks"),
                      ),
                      (0, r.createElement)(
                        "div",
                        {
                          id: "colors-palette",
                          className:
                            "flex flex-wrap items-stretch justify-start gap-1",
                        },
                        N.map((e, t) =>
                          (0, r.createElement)(c.ColorIndicator, {
                            className: n()({ active: e.color === b }),
                            title: e.name,
                            key: t,
                            colorValue: e.color,
                            onClick: () => g(e.color),
                          }),
                        ),
                      ),
                    ),
                  ),
              ),
            );
          },
          D = ({ label: e, link: t, linkName: l, setAttributes: a }) =>
            (0, r.createElement)(
              "div",
              { className: "w-72 p-2" },
              (0, r.createElement)(c.TextControl, {
                label: e,
                value: t.url,
                onChange: (e) => {
                  a({ [l]: { ...t, url: e } });
                },
              }),
              (0, r.createElement)(c.ToggleControl, {
                label: (0, d.__)("Open in new tab", "wp-custom-blocks"),
                checked: t && t.openInNewTab,
                onChange: () => {
                  a({ [l]: { ...t, openInNewTab: !t.openInNewTab } });
                },
              }),
            ),
          B =
            (x.DEFAULT,
            x.DEFAULT,
            h.dark,
            h.dark,
            E.light,
            () =>
              (0, r.createElement)(
                "div",
                { style: { marginBottom: 24 } },
                (0, r.createElement)(
                  c.Tip,
                  null,
                  (0, r.createElement)(
                    "p",
                    null,
                    "Mobile display: ",
                    C.xs,
                    "...",
                    C.sm,
                    "px",
                  ),
                  (0, r.createElement)(
                    "p",
                    null,
                    "Tablet display: ",
                    C.sm,
                    "...",
                    C.md,
                    "px",
                  ),
                  (0, r.createElement)(
                    "p",
                    null,
                    "Laptop display: ",
                    C.md,
                    "...",
                    C.xl,
                    "px",
                  ),
                  (0, r.createElement)(
                    "p",
                    null,
                    "Desktop display: ",
                    C.xl,
                    "...",
                  ),
                ),
              )),
          A = 24,
          P = {
            uniqueId: { type: "string" },
            blockStyle: { type: "string" },
            backgroundColor: { type: "string", default: x.grizzly },
            backgroundImage: { type: "object", default: {} },
            contentImage: { type: "object", default: {} },
            subTitle: { type: "string", default: "Welcome to" },
            subTitleColor: { type: "string", default: E.DEFAULT },
            title: { type: "string" },
            titleColor: { type: "string", default: E.DEFAULT },
            description: { type: "string" },
            descriptionColor: { type: "string", default: E.DEFAULT },
            buttonLink: {
              type: "object",
              default: { url: "#", openInNewTab: !0 },
            },
            buttonText: { type: "string", default: "" },
            buttonTextColor: { type: "string", default: E.DEFAULT },
            buttonColor: { type: "string", default: f.DEFAULT },
            desktopItemsCount: { type: "number", default: 3 },
            desktopSpaceBetweenItems: { type: "number", default: A },
            isEnableSlider: { type: "boolean", default: !1 },
            isLoopSlider: { type: "boolean", default: !0 },
            isDisableAutoplay: { type: "boolean", default: !1 },
            sliderAutoplayDelay: { type: "number", default: 5e3 },
            sliderMobileSlidesPerView: { type: "number", default: 1 },
            sliderTabletSlidesPerView: { type: "number", default: 2 },
            sliderLaptopSlidesPerView: { type: "number", default: 3 },
            sliderMobileSpaceBetween: { type: "number", default: A },
            sliderTabletSpaceBetween: { type: "number", default: A },
            sliderLaptopSpaceBetween: { type: "number", default: A },
            adviceBackgroundColor: { type: "string", default: f.DEFAULT },
            adviceBackgroundImage: { type: "object", default: {} },
            adviceTitle: { type: "string" },
            adviceTitleColor: { type: "string", default: E.DEFAULT },
            adviceDescription: { type: "string" },
            adviceDescriptionColor: { type: "string", default: E.DEFAULT },
            titleSize: {
              type: "string",
              default: "mb-5 text-5xl lg:text-9xl block",
            },
            descriptionFontSize: {
              type: "string",
              default: "text-base max-w-2xl mb-10",
            },
            buttonAlignment: { type: "string", default: "justify-start" },
            contentTitle: { type: "string", default: "Content Title" },
            contentDescription: {
              type: "string",
              default: "Content Description",
            },
          },
          L = ({ attributes: e, setAttributes: t }) => {
            const {
                desktopItemsCount: l,
                desktopSpaceBetweenItems: a,
                isLoopSlider: o,
                isDisableAutoplay: s,
                sliderAutoplayDelay: n,
                sliderMobileSlidesPerView: m,
                sliderTabletSlidesPerView: p,
                sliderLaptopSlidesPerView: u,
                sliderMobileSpaceBetween: b,
                sliderTabletSpaceBetween: g,
                sliderLaptopSpaceBetween: w,
              } = e,
              v = { attributes: e, defaultAttributes: P, setAttributes: t };
            return (0, r.createElement)(
              i.InspectorControls,
              null,
              (0, r.createElement)(B, null),
              (0, r.createElement)(
                c.PanelBody,
                {
                  title: (0, d.__)("Block settings", "wp-custom-blocks"),
                  initialOpen: !0,
                },
                (0, r.createElement)(S, {
                  name: "backgroundColor",
                  label: (0, d.__)("Background Color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "titleColor",
                  label: (0, d.__)("Title Color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "subTitleColor",
                  label: (0, d.__)("Subtitle Color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "descriptionColor",
                  label: (0, d.__)("Description color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "buttonColor",
                  label: (0, d.__)("Button color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "buttonTextColor",
                  label: (0, d.__)("Button text color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.RangeControl, {
                  label: (0, d.__)("Desktop items count", "wp-custom-blocks"),
                  value: l,
                  onChange: (e) => t({ desktopItemsCount: e }),
                  step: 1,
                  min: 1,
                  max: 12,
                  allowReset: !0,
                  resetFallbackValue: Number(T(P, "desktopItemsCount")),
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.RangeControl, {
                  label: (0, d.__)(
                    "Desktop space between items",
                    "wp-custom-blocks",
                  ),
                  value: a,
                  onChange: (e) => t({ desktopSpaceBetweenItems: e }),
                  step: 2,
                  min: 4,
                  max: 64,
                  allowReset: !0,
                  resetFallbackValue: A,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(
                  "div",
                  { style: { marginBottom: "16px" } },
                  (0, r.createElement)(
                    "label",
                    {
                      style: {
                        marginBottom: "8px",
                        display: "block",
                        fontWeight: "bold",
                      },
                    },
                    (0, d.__)("Content Image", "wp-custom-blocks"),
                  ),
                  (0, r.createElement)(
                    i.MediaUploadCheck,
                    null,
                    (0, r.createElement)(i.MediaUpload, {
                      onSelect: (e) => t({ contentImage: e }),
                      allowedTypes: ["image"],
                      value: e.contentImage ? e.contentImage.id : 0,
                      render: ({ open: l }) =>
                        (0, r.createElement)(
                          c.Button,
                          {
                            onClick: l,
                            variant: "secondary",
                            style: { width: "100%" },
                          },
                          (0, d.__)("Select Content Image", "wp-custom-blocks"),
                        ),
                    }),
                  ),
                ),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "adviceBackgroundColor",
                  label: (0, d.__)(
                    "Advice background color",
                    "wp-custom-blocks",
                  ),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "adviceTitleColor",
                  label: (0, d.__)("Advice title color", "wp-custom-blocks"),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(S, {
                  name: "adviceDescriptionColor",
                  label: (0, d.__)(
                    "Advice description color",
                    "wp-custom-blocks",
                  ),
                  ...v,
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.SelectControl, {
                  label: (0, d.__)("Title Size", "wp-custom-blocks"),
                  value: e.titleSize || "mb-5 text-5xl lg:text-9xl block",
                  options: [
                    {
                      label: (0, d.__)("Small", "wp-custom-blocks"),
                      value: "mb-5 text-3xl lg:text-5xl block",
                    },
                    {
                      label: (0, d.__)("Medium", "wp-custom-blocks"),
                      value: "mb-5 text-4xl lg:text-6xl block",
                    },
                    {
                      label: (0, d.__)("Large", "wp-custom-blocks"),
                      value: "mb-5 text-5xl lg:text-9xl block",
                    },
                    {
                      label: (0, d.__)("Extra Large", "wp-custom-blocks"),
                      value: "mb-5 text-6xl lg:text-[120px] block",
                    },
                  ],
                  onChange: (l) => t({ titleSize: l }),
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.SelectControl, {
                  label: (0, d.__)("Description Font Size", "wp-custom-blocks"),
                  value: e.descriptionFontSize || "text-base max-w-2xl mb-10",
                  options: [
                    {
                      label: (0, d.__)("Small", "wp-custom-blocks"),
                      value: "text-sm max-w-2xl mb-10",
                    },
                    {
                      label: (0, d.__)("Medium", "wp-custom-blocks"),
                      value: "text-base max-w-2xl mb-10",
                    },
                    {
                      label: (0, d.__)("Large", "wp-custom-blocks"),
                      value: "text-lg max-w-2xl mb-10",
                    },
                    {
                      label: (0, d.__)("Extra Large", "wp-custom-blocks"),
                      value: "text-xl max-w-2xl mb-10",
                    },
                  ],
                  onChange: (l) => t({ descriptionFontSize: l }),
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.SelectControl, {
                  label: (0, d.__)("Button Alignment", "wp-custom-blocks"),
                  value: e.buttonAlignment || "justify-start",
                  options: [
                    {
                      label: (0, d.__)("Left", "wp-custom-blocks"),
                      value: "justify-start",
                    },
                    {
                      label: (0, d.__)("Center", "wp-custom-blocks"),
                      value: "justify-center",
                    },
                    {
                      label: (0, d.__)("Right", "wp-custom-blocks"),
                      value: "justify-end",
                    },
                  ],
                  onChange: (l) => t({ buttonAlignment: l }),
                }),
              ),
              (0, r.createElement)(
                c.PanelBody,
                {
                  title: (0, d.__)("Slider settings", "wp-custom-blocks"),
                  initialOpen: !0,
                },
                (0, r.createElement)(c.ToggleControl, {
                  label: (0, d.__)("Slider loop", "wp-custom-blocks"),
                  checked: o,
                  onChange: () => t({ isLoopSlider: !o }),
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.ToggleControl, {
                  label: (0, d.__)(
                    "Disable slider autoplay",
                    "wp-custom-blocks",
                  ),
                  checked: s,
                  onChange: () => t({ isDisableAutoplay: !s }),
                }),
                (0, r.createElement)(c.CardDivider, null),
                (0, r.createElement)(c.RangeControl, {
                  label: (0, d.__)("Slider autoplay delay", "wp-custom-blocks"),
                  value: n,
                  onChange: (e) => t({ sliderAutoplayDelay: e }),
                  disabled: s,
                  step: 500,
                  min: 0,
                  max: 3e4,
                  allowReset: !0,
                  resetFallbackValue: Number(T(P, "sliderAutoplayDelay")),
                }),
                (0, r.createElement)(
                  c.PanelBody,
                  {
                    title: (0, d.__)(
                      "Slides per view settings",
                      "wp-custom-blocks",
                    ),
                    initialOpen: !1,
                  },
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Mobile slides per view",
                      "wp-custom-blocks",
                    ),
                    value: m,
                    onChange: (e) => t({ sliderMobileSlidesPerView: e }),
                    step: 1,
                    min: 1,
                    max: 10,
                    allowReset: !0,
                    resetFallbackValue: Number(
                      T(P, "sliderMobileSlidesPerView"),
                    ),
                  }),
                  (0, r.createElement)(c.CardDivider, null),
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Tablet slides per view",
                      "wp-custom-blocks",
                    ),
                    value: p,
                    onChange: (e) => t({ sliderTabletSlidesPerView: e }),
                    step: 1,
                    min: 1,
                    max: 10,
                    allowReset: !0,
                    resetFallbackValue: Number(
                      T(P, "sliderTabletSlidesPerView"),
                    ),
                  }),
                  (0, r.createElement)(c.CardDivider, null),
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Laptop slides per view",
                      "wp-custom-blocks",
                    ),
                    value: u,
                    onChange: (e) => t({ sliderLaptopSlidesPerView: e }),
                    step: 1,
                    min: 1,
                    max: 10,
                    allowReset: !0,
                    resetFallbackValue: Number(
                      T(P, "sliderLaptopSlidesPerView"),
                    ),
                  }),
                ),
                (0, r.createElement)(
                  c.PanelBody,
                  {
                    title: (0, d.__)(
                      "Slides between settings",
                      "wp-custom-blocks",
                    ),
                    initialOpen: !1,
                  },
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Mobile space between slides",
                      "wp-custom-blocks",
                    ),
                    value: b,
                    onChange: (e) => t({ sliderMobileSpaceBetween: e }),
                    step: 2,
                    min: 4,
                    max: 64,
                    allowReset: !0,
                    resetFallbackValue: A,
                  }),
                  (0, r.createElement)(c.CardDivider, null),
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Tablet space between slides",
                      "wp-custom-blocks",
                    ),
                    value: g,
                    onChange: (e) => t({ sliderTabletSpaceBetween: e }),
                    step: 2,
                    min: 4,
                    max: 64,
                    allowReset: !0,
                    resetFallbackValue: A,
                  }),
                  (0, r.createElement)(c.CardDivider, null),
                  (0, r.createElement)(c.RangeControl, {
                    label: (0, d.__)(
                      "Laptop space between slides",
                      "wp-custom-blocks",
                    ),
                    value: w,
                    onChange: (e) => t({ sliderLaptopSpaceBetween: e }),
                    step: 2,
                    min: 4,
                    max: 64,
                    allowReset: !0,
                    resetFallbackValue: A,
                  }),
                ),
              ),
            );
          },
          I = "wp-custom-blocks/sport-card",
          { name: R, ...O } = o;
        (0, a.registerBlockType)(R, {
          ...O,
          icon: "welcome-widgets-menus",
          attributes: P,
          edit: ({ attributes: e, setAttributes: t, clientId: l }) => {
            const {
                uniqueId: a,
                blockStyle: o,
                backgroundColor: s,
                backgroundImage: p,
                contentImage: y,
                subTitle: u,
                subTitleColor: b,
                title: g,
                titleColor: w,
                description: v,
                descriptionColor: k,
                buttonLink: _,
                buttonText: T,
                buttonTextColor: N,
                buttonColor: S,
                desktopItemsCount: B,
                desktopSpaceBetweenItems: A,
                sliderMobileSlidesPerView: P,
                sliderTabletSlidesPerView: R,
                sliderLaptopSlidesPerView: O,
                sliderMobileSpaceBetween: F,
                sliderTabletSpaceBetween: V,
                sliderLaptopSpaceBetween: j,
                adviceBackgroundColor: M,
                adviceBackgroundImage: $,
                adviceTitle: U,
                adviceTitleColor: z,
                adviceDescription: H,
                adviceDescriptionColor: J,
                titleSize: titleSizeClass,
                descriptionFontSize: descriptionFontSizeClass,
                buttonAlignment: buttonAlignmentClass,
                contentTitle: contentTitleText,
                contentDescription: contentDescriptionText,
              } = e,
              [q, G] = (0, m.useState)(!1),
              W = () => G((e) => !e),
              K = (0, i.useBlockProps)({
                className: n()(a, "bg-white-standard font-notoSans"),
                style: { maxWidth: "none", margin: 0 },
              }),
              Y = (0, i.useInnerBlocksProps)(
                {
                  className:
                    "slider-wrapper flex flex-wrap overflow-hidden lg:!grid",
                },
                {
                  allowedBlocks: [I],
                  template: [[I, { linkText: "See more" }]],
                  renderAppender: () =>
                    (0, r.createElement)(
                      i.InnerBlocks.DefaultBlockAppender,
                      null,
                    ),
                },
              );
            (0, m.useEffect)(() => {
              a || t({ uniqueId: "banner" + l.slice(0, 8) });
            }, [l, t, a]);
            const Z = `\n\t\t.${a} .slider-wrapper {\n\t\t\tgap: ${V}px;\n\t\t}\n\n\t\t.${a} .slider-item {\n\t\t\tflex-basis: calc(${100 / R}% - ${V}px);\n\t\t}\n\t`,
              Q = `\n\t\t.${a} .slider-wrapper {\n\t\t\tgap: ${j}px;\n\t\t}\n\n\t\t.${a} .slider-item {\n\t\t\tflex-basis: calc(${100 / O}% - ${j}px);\n\t\t}\n\t`,
              X = `\n\t\t\n\t\t.${a} .slider-wrapper {\n\t\t\tgap: ${F}px;\n\t\t}\n\n\t\t.${a} .slider-item {\n\t\t\tflex-basis: calc(${100 / P}% - ${F}px);\n\t\t}\n\t\n\n\t\t@media (min-width: ${C.sm}px) {\n\t\t\t${Z}\n\t\t}\n\n\t\t@media (min-width: ${C.md}px) {\n\t\t\t${Q}\n\t\t}\n\t`,
              ee = `\n\t\t@media (min-width: ${C.lg}px) {\n\t\t\t.${a} .slider-wrapper {\n\t\t\t\tgap: ${A}px;\n\t\t\t\tgrid-template-columns: repeat(${B}, minmax(0, 1fr));\n\t\t\t}\n\t\t}\n\t`;
            return (0, r.createElement)(
              m.Fragment,
              null,
              (0, r.createElement)("style", null, X),
              (0, r.createElement)("style", null, ee),
              (0, r.createElement)(L, {
                attributes: e,
                setAttributes: (e) => {
                  const l = ((e = " ") =>
                    e
                      .replace(/\s+/g, " ")
                      .replace(
                        /\.zb\-[\w\-\s\.\,\:\>\(\)\d\+\[\]\#\>]+\{[\s]+\}/g,
                        "",
                      ))(ee);
                  (o !== l && (e.blockStyle = l), t(e));
                },
              }),
              (0, r.createElement)(
                i.BlockControls,
                { controls: [] },
                (0, r.createElement)(
                  c.ToolbarGroup,
                  null,
                  (0, r.createElement)(
                    i.MediaUploadCheck,
                    null,
                    (0, r.createElement)(i.MediaUpload, {
                      onSelect: (e) => t({ backgroundImage: e }),
                      allowedTypes: ["image"],
                      value: p.id,
                      render: ({ open: e }) =>
                        (0, r.createElement)(c.ToolbarButton, {
                          label: (0, d.__)(
                            "Edit background image",
                            "wp-custom-blocks",
                          ),
                          onClick: e,
                          icon: "format-image",
                          placeholder: (0, d.__)(
                            "Edit background image",
                            "wp-custom-blocks",
                          ),
                        }),
                    }),
                  ),
                  (0, r.createElement)(
                    i.MediaUploadCheck,
                    null,
                    (0, r.createElement)(i.MediaUpload, {
                      onSelect: (e) => t({ contentImage: e }),
                      allowedTypes: ["image"],
                      value: y ? y.id : 0,
                      render: ({ open: e }) =>
                        (0, r.createElement)(c.ToolbarButton, {
                          label: (0, d.__)(
                            "Edit content image",
                            "wp-custom-blocks",
                          ),
                          onClick: e,
                          icon: "format-image",
                          placeholder: (0, d.__)(
                            "Edit content image",
                            "wp-custom-blocks",
                          ),
                        }),
                    }),
                  ),
                  (0, r.createElement)(
                    i.MediaUploadCheck,
                    null,
                    (0, r.createElement)(i.MediaUpload, {
                      onSelect: (e) => t({ adviceBackgroundImage: e }),
                      allowedTypes: ["image"],
                      value: $.id,
                      render: ({ open: e }) =>
                        (0, r.createElement)(c.ToolbarButton, {
                          label: (0, d.__)(
                            "Edit advice background image",
                            "wp-custom-blocks",
                          ),
                          onClick: e,
                          icon: "format-image",
                          placeholder: (0, d.__)(
                            "Edit advice background image",
                            "wp-custom-blocks",
                          ),
                        }),
                    }),
                  ),
                ),
              ),
              (0, r.createElement)(
                i.BlockControls,
                { controls: [] },
                (0, r.createElement)(
                  m.Fragment,
                  null,
                  (0, r.createElement)(
                    c.ToolbarGroup,
                    null,
                    (0, r.createElement)(c.ToolbarButton, {
                      label: (0, d.__)("Add Link", "wp-custom-blocks"),
                      onClick: W,
                      icon: "admin-links",
                      placeholder: (0, d.__)("Add Link", "wp-custom-blocks"),
                    }),
                  ),
                  q &&
                    (0, r.createElement)(
                      c.Popover,
                      {
                        position: "bottom right",
                        onFocusOutside: W,
                        offset: 5,
                      },
                      (0, r.createElement)(D, {
                        link: _,
                        linkName: "link",
                        label: (0, d.__)("Link", "wp-custom-blocks"),
                        setAttributes: t,
                      }),
                    ),
                ),
              ),
              (0, r.createElement)(
                "div",
                { ...K },
                (0, r.createElement)(
                  "div",
                  { className: "relative md:mb-28" },
                  (0, r.createElement)(
                    "div",
                    {
                      className: "relative isolate py-16 lg:py-32",
                      style: { backgroundColor: s },
                    },
                    p.url &&
                      (0, r.createElement)("img", {
                        className:
                          "absolute inset-0 -z-10 !h-full w-full object-cover md:object-center",
                        src: p.url,
                        alt: p.alt,
                        width: p.width,
                        height: p.height,
                      }),
                    (0, r.createElement)(
                      "div",
                      { className: "mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" },
                      (0, r.createElement)(
                        "div",
                        { className: "mx-auto mb-10 lg:mx-0" },
                        (0, r.createElement)(
                          "h1",
                          { className: "font-black uppercase" },
                          (0, r.createElement)(i.RichText, {
                            tagName: "span",
                            className:
                              "text-base italic tracking-wide lg:text-2xl lg:tracking-widest",
                            value: u,
                            onChange: (e) => t({ subTitle: e }),
                            placeholder: (0, d.__)(
                              "Subtitle..",
                              "wp-custom-blocks",
                            ),
                            style: { color: b },
                          }),
                          (0, r.createElement)(i.RichText, {
                            tagName: "span",
                            className:
                              titleSizeClass ||
                              "mb-5 text-5xl lg:text-9xl block",
                            value: g,
                            onChange: (e) => t({ title: e }),
                            placeholder: (0, d.__)(
                              "Site name..",
                              "wp-custom-blocks",
                            ),
                            style: { color: w },
                          }),
                        ),
                        (0, r.createElement)(i.RichText, {
                          tagName: "p",
                          className:
                            descriptionFontSizeClass ||
                            "text-base max-w-2xl mb-10",
                          value: v,
                          onChange: (e) => t({ description: e }),
                          placeholder: (0, d.__)(
                            "Description title..",
                            "wp-custom-blocks",
                          ),
                          style: { color: k },
                        }),
                        (0, r.createElement)(
                          "div",
                          {
                            className:
                              "flex " +
                              (buttonAlignmentClass || "justify-start"),
                          },
                          (0, r.createElement)(
                            "button",
                            {
                              className:
                                "relative flex text-base italic font-black w-fit",
                              type: "button",
                              "aria-expanded": "false",
                            },
                            (0, r.createElement)("div", {
                              className:
                                "absolute w-full h-full rounded-lg transform -skew-x-12",
                              style: { backgroundColor: S },
                            }),
                            (0, r.createElement)(i.RichText, {
                              tagName: "span",
                              className: "relative uppercase py-5 px-8 mx-auto",
                              value: T,
                              onChange: (e) => t({ buttonText: e }),
                              placeholder: (0, d.__)(
                                "Button text..",
                                "wp-custom-blocks",
                              ),
                              style: { color: N },
                            }),
                          ),
                        ),
                      ),
                    ),
                  ),
                  (0, r.createElement)(
                    "div",
                    { className: "md:absolute md:inset-x-0 md:-bottom-28" },
                    (0, r.createElement)(
                      "div",
                      {
                        className:
                          "relative px-0 mx-auto max-w-7xl md:px-6 lg:px-8",
                      },
                      (0, r.createElement)("div", {
                        className:
                          "border-hex bg-white-standard w-full h-full absolute inset-x-0 -top-2 hidden md:!block",
                      }),
                      (0, r.createElement)(
                        "div",
                        {
                          className:
                            "mask-hex relative isolate overflow-hidden w-full",
                          style: { backgroundColor: M },
                        },
                        $.url &&
                          (0, r.createElement)("img", {
                            className:
                              "absolute inset-0 -z-10 !h-full w-full object-cover md:object-center",
                            src: $.url,
                            alt: $.alt,
                            width: $.width,
                            height: $.height,
                          }),
                        (0, r.createElement)(
                          "div",
                          { className: "max-w-3xl p-6 md:py-12 md:px-24" },
                          (0, r.createElement)(i.RichText, {
                            tagName: "h5",
                            className:
                              "mb-6 text-base font-black italic md:text-2xl",
                            value: U,
                            onChange: (e) => t({ adviceTitle: e }),
                            placeholder: (0, d.__)(
                              "Advice title..",
                              "wp-custom-blocks",
                            ),
                            style: { color: z },
                          }),
                          (0, r.createElement)(i.RichText, {
                            tagName: "p",
                            className: "text-base mb-1.5 md:mb-0",
                            value: H,
                            onChange: (e) => t({ adviceDescription: e }),
                            placeholder: (0, d.__)(
                              "Advice description..",
                              "wp-custom-blocks",
                            ),
                            style: { color: J },
                          }),
                        ),
                      ),
                    ),
                  ),
                ),
              ),
            );
          },
          save: ({ attributes: e }) => {
            const {
                uniqueId: t,
                backgroundColor: l,
                backgroundImage: a,
                contentImage: y,
                subTitle: o,
                subTitleColor: s,
                title: c,
                description: m,
                titleColor: d,
                descriptionColor: p,
                buttonLink: v,
                buttonText: k,
                buttonTextColor: f,
                buttonColor: x,
                isLoopSlider: E,
                isDisableAutoplay: h,
                sliderAutoplayDelay: C,
                sliderMobileSlidesPerView: _,
                sliderTabletSlidesPerView: T,
                sliderLaptopSlidesPerView: N,
                sliderMobileSpaceBetween: S,
                sliderTabletSpaceBetween: D,
                sliderLaptopSpaceBetween: B,
                adviceTitle: A,
                adviceBackgroundColor: P,
                adviceBackgroundImage: L,
                adviceTitleColor: I,
                adviceDescription: R,
                adviceDescriptionColor: O,
                titleSize: z,
                descriptionFontSize: Q,
                buttonAlignment: X,
                contentTitle: contentTitleText,
                contentDescription: contentDescriptionText,
              } = e,
              F = i.useBlockProps.save({
                className: n()(
                  t,
                  "font-notoSans relative left-1/2 w-screen -translate-x-2/4 !mt-0 md:!mb-32",
                ),
              }),
              V = {
                "data-slider-loop": E,
                "data-slider-disable-autoplay": h,
                "data-slider-autoplay-delay": C,
                "data-slides-per-view-xs": _,
                "data-slides-per-view-sm": T,
                "data-slides-per-view-md": N,
                "data-slides-space-between-xs": S,
                "data-slides-space-between-sm": D,
                "data-slides-space-between-md": B,
                "data-slider-destroy-breakpoint": "lg",
              };
            return (0, r.createElement)(
              "div",
              { ...F },
              (0, r.createElement)(
                "div",
                { className: "relative md:mb-28" },
                (0, r.createElement)(
                  "div",
                  {
                    className: "relative isolate py-16 lg:py-32",
                    style: { backgroundColor: l },
                  },
                  a.url &&
                    (0, r.createElement)("img", {
                      className:
                        "absolute inset-0 -z-10 h-full w-full object-cover md:object-center",
                      src: a.url,
                      alt: a.alt,
                      width: a.width,
                      height: a.height,
                    }),
                  (0, r.createElement)(
                    "div",
                    { className: "mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" },
                    (0, r.createElement)(
                      "div",
                      { className: "mx-auto mb-10 lg:mx-0" },
                      (0, r.createElement)(
                        "h1",
                        { className: "font-black uppercase" },
                        (0, r.createElement)(i.RichText.Content, {
                          tagName: "span",
                          className:
                            "text-base italic tracking-wide lg:text-2xl lg:tracking-widest",
                          value: o,
                          style: { color: s },
                        }),
                        (0, r.createElement)(i.RichText.Content, {
                          tagName: "span",
                          className: z || "mb-5 text-5xl lg:text-9xl block",
                          value: c,
                          style: { color: d },
                        }),
                      ),
                      (0, r.createElement)(i.RichText.Content, {
                        tagName: "p",
                        className: Q || "text-base max-w-2xl mb-10",
                        value: m,
                        style: { color: p },
                      }),
                      k &&
                        (0, r.createElement)(
                          "div",
                          { className: "flex " + (X || "justify-start") },
                          (0, r.createElement)(
                            "a",
                            {
                              href: v.url,
                              target: v.openInNewTab ? "_blank" : "_self",
                              rel: v.openInNewTab
                                ? "noopener noreferrer"
                                : "noopener",
                              className: "no-underline inline-block",
                            },
                            (0, r.createElement)(
                              "button",
                              {
                                className:
                                  "relative flex text-white text-base italic font-black w-fit",
                                type: "button",
                                "aria-expanded": "false",
                              },
                              (0, r.createElement)("div", {
                                className:
                                  "absolute w-full h-full rounded-lg transform -skew-x-12",
                                style: { backgroundColor: x },
                              }),
                              (0, r.createElement)(i.RichText.Content, {
                                tagName: "span",
                                className:
                                  "relative uppercase py-5 px-8 mx-auto",
                                value: k,
                                style: { color: f },
                              }),
                            ),
                          ),
                        ),
                    ),
                  ),
                ),
                (contentTitleText || contentDescriptionText) &&
                  y &&
                  y.url &&
                  (0, r.createElement)(
                    "div",
                    { className: "mt-16 container mx-auto px-4 sm:px-6 lg:px-8" },
                    (0, r.createElement)(
                      "div",
                      { className: "flex flex-col lg:flex-row items-start gap-8" },
                      (0, r.createElement)(
                        "div",
                        { className: "mx-auto mb-10 lg:mx-0" },
                        contentTitleText &&
                          (0, r.createElement)(i.RichText.Content, {
                            tagName: "h3",
                            className: "text-2xl font-bold mb-4",
                            value: contentTitleText,
                          }),
                        contentDescriptionText &&
                          (0, r.createElement)(i.RichText.Content, {
                            tagName: "p",
                            className: "text-base",
                            value: contentDescriptionText,
                          }),
                      ),
                      (0, r.createElement)(
                        "div",
                        { className: "flex-shrink-0" },
                        (0, r.createElement)("img", {
                          className: "w-64 h-48 object-cover rounded-lg",
                          src: y.url,
                          alt: y.alt || "Content image",
                          width: y.width || 256,
                          height: y.height || 192,
                        }),
                      ),
                    ),
                  ),
                (A || R) &&
                  (0, r.createElement)(
                    "div",
                    { className: "md:absolute md:inset-x-0 md:-bottom-28" },
                    (0, r.createElement)(
                      "div",
                      {
                        className:
                          "relative px-0 mx-auto max-w-7xl md:px-6 lg:px-8",
                      },
                      (0, r.createElement)("div", {
                        className:
                          "border-hex bg-white-standard w-full h-full absolute inset-x-0 -top-2 hidden md:!block",
                      }),
                      (0, r.createElement)(
                        "div",
                        {
                          className:
                            "mask-hex relative isolate overflow-hidden w-full",
                          style: { backgroundColor: P },
                        },
                        L &&
                          (0, r.createElement)("img", {
                            className:
                              "absolute inset-0 -z-10 h-full w-full object-cover md:object-center",
                            src: L.url,
                            alt: L.alt,
                            width: L.width,
                            height: L.height,
                          }),
                        (0, r.createElement)(
                          "div",
                          { className: "max-w-3xl p-6 md:!py-12 md:!px-24" },
                          (0, r.createElement)(i.RichText.Content, {
                            tagName: "h5",
                            className:
                              "mb-6 text-base font-black italic md:!text-2xl",
                            value: A,
                            style: { color: I },
                          }),
                          (0, r.createElement)(i.RichText.Content, {
                            tagName: "p",
                            className: "text-base mb-1.5 md:!mb-0",
                            value: R,
                            style: { color: O },
                          }),
                        ),
                      ),
                    ),
                  ),
              ),
            );
          },
        });
      },
      942: (e, t) => {
        var l;
        !(function () {
          "use strict";
          var a = {}.hasOwnProperty;
          function o() {
            for (var e = "", t = 0; t < arguments.length; t++) {
              var l = arguments[t];
              l && (e = s(e, r(l)));
            }
            return e;
          }
          function r(e) {
            if ("string" == typeof e || "number" == typeof e) return e;
            if ("object" != typeof e) return "";
            if (Array.isArray(e)) return o.apply(null, e);
            if (
              e.toString !== Object.prototype.toString &&
              !e.toString.toString().includes("[native code]")
            )
              return e.toString();
            var t = "";
            for (var l in e) a.call(e, l) && e[l] && (t = s(t, l));
            return t;
          }
          function s(e, t) {
            return t ? (e ? e + " " + t : e + t) : e;
          }
          e.exports
            ? ((o.default = o), (e.exports = o))
            : void 0 ===
                (l = function () {
                  return o;
                }.apply(t, [])) || (e.exports = l);
        })();
      },
    },
    o = {};
  function r(e) {
    var t = o[e];
    if (void 0 !== t) return t.exports;
    var l = (o[e] = { exports: {} });
    return (a[e](l, l.exports, r), l.exports);
  }
  ((r.m = a),
    (e = []),
    (r.O = (t, l, a, o) => {
      if (!l) {
        var s = 1 / 0;
        for (m = 0; m < e.length; m++) {
          for (var [l, a, o] = e[m], n = !0, i = 0; i < l.length; i++)
            (!1 & o || s >= o) && Object.keys(r.O).every((e) => r.O[e](l[i]))
              ? l.splice(i--, 1)
              : ((n = !1), o < s && (s = o));
          if (n) {
            e.splice(m--, 1);
            var c = a();
            void 0 !== c && (t = c);
          }
        }
        return t;
      }
      o = o || 0;
      for (var m = e.length; m > 0 && e[m - 1][2] > o; m--) e[m] = e[m - 1];
      e[m] = [l, a, o];
    }),
    (r.n = (e) => {
      var t = e && e.__esModule ? () => e.default : () => e;
      return (r.d(t, { a: t }), t);
    }),
    (l = Object.getPrototypeOf
      ? (e) => Object.getPrototypeOf(e)
      : (e) => e.__proto__),
    (r.t = function (e, a) {
      if ((1 & a && (e = this(e)), 8 & a)) return e;
      if ("object" == typeof e && e) {
        if (4 & a && e.__esModule) return e;
        if (16 & a && "function" == typeof e.then) return e;
      }
      var o = Object.create(null);
      r.r(o);
      var s = {};
      t = t || [null, l({}), l([]), l(l)];
      for (
        var n = 2 & a && e;
        ("object" == typeof n || "function" == typeof n) && !~t.indexOf(n);
        n = l(n)
      )
        Object.getOwnPropertyNames(n).forEach((t) => (s[t] = () => e[t]));
      return ((s.default = () => e), r.d(o, s), o);
    }),
    (r.d = (e, t) => {
      for (var l in t)
        r.o(t, l) &&
          !r.o(e, l) &&
          Object.defineProperty(e, l, { enumerable: !0, get: t[l] });
    }),
    (r.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t)),
    (r.r = (e) => {
      ("undefined" != typeof Symbol &&
        Symbol.toStringTag &&
        Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }),
        Object.defineProperty(e, "__esModule", { value: !0 }));
    }),
    (() => {
      var e = { 135: 0, 314: 0 };
      r.O.j = (t) => 0 === e[t];
      var t = (t, l) => {
          var a,
            o,
            [s, n, i] = l,
            c = 0;
          if (s.some((t) => 0 !== e[t])) {
            for (a in n) r.o(n, a) && (r.m[a] = n[a]);
            if (i) var m = i(r);
          }
          for (t && t(l); c < s.length; c++)
            ((o = s[c]), r.o(e, o) && e[o] && e[o][0](), (e[o] = 0));
          return r.O(m);
        },
        l = (globalThis.webpackChunkwp_custom_blocks =
          globalThis.webpackChunkwp_custom_blocks || []);
      (l.forEach(t.bind(null, 0)), (l.push = t.bind(null, l.push.bind(l))));
    })());
  var s = r.O(void 0, [314], () => r(353));
  s = r.O(s);
})();
