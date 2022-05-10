module.exports = {
	content: [
		"./assets/src/**/*.{vue,js,jsx,ts,tsx}",
		"./assets/src/*.{vue,js,jsx,ts,tsx}",
		"./awraq/**/*.php",
  ],
  theme: {
	  extend: {},
	  
  },
	plugins: [
		require('@tailwindcss/typography'),
	],
}
