module.exports = {
	content: [
		"./assets/src/**/*.{vue,js,jsx,ts,tsx}",
		"./assets/src/*.{vue,js,jsx,ts,tsx}",
		"./awraq/**/*.php",
  ],
  theme: {
	  extend: {
		  typography:{
			  DEFAULT:{
				  css:{
					  maxWidth:'100%'
				  }
			  }
		  }
	  },


	  
  },
	plugins: [
		require('@tailwindcss/typography'),
	],
}
