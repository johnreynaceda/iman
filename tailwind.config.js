const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
  presets: [require('./vendor/wireui/wireui/tailwind.config.js')],
  content: [
    './resources/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    './vendor/wireui/wireui/resources/**/*.blade.php',
    './vendor/wireui/wireui/ts/**/*.ts',
    './vendor/wireui/wireui/src/View/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        danger: colors.rose,
        primary: colors.green,
        success: colors.green,
        warning: colors.yellow,
        gray: colors.gray,
        blue: colors.blue,
      },
    },
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
