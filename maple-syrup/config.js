const StyleDictionary = require("style-dictionary");

module.exports = {
  // This will match any files ending in json or json5
  // I am using json5 here, so I can add comments in the token files for reference
  source: ["tokens/**/**/*.@(json|json5)"],
  transform: {
    "color/css": Object.assign({}, StyleDictionary.transform[`color/css`], {
      transitive: true,
    }),
  },
  platforms: {
    less: {
      transformGroup: 'less',
      transforms: [
        "attribute/cti",
        "name/cti/kebab",
        "time/seconds",
        "size/rem",
        "color/css",
      ],
      buildPath: "build/less/",
      files: [
        {
          destination: "sugar-color-palette.less",
          format: "less/variables",
          filter: token => {
            return token.filePath === 'tokens/color/palette.json';
          }
        },
        {
          destination: "sugar-theme-variables.less",
          format: "less/variables",
          filter: token => {
            let isColor = token.attributes.category === 'color';
            let isNotPalette = token.filePath !== 'tokens/color/palette.json';
            return isColor && isNotPalette;
          }
        },
      ],
    },
  },
};
