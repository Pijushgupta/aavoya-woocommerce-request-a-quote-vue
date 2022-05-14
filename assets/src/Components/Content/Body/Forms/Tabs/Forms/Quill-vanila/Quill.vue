<template>
	<div :class="class" :id="id"></div>	
</template>
<script>

import Quill from 'quill/dist/quill.js';
import 'quill/dist/quill.snow.css';

export default {
	name: 'QuillVanila',

	mounted: function() {
		if(this.id == '') return;
		
		this.textEditor = new Quill('#'+this.id, this.options); 
		
	},

	props:{
		id:String,
		class:String,
		options:Object,
		content:String
	},

	data (){
		return{
			textEditor :'',
		}
	},

	methods:{	

		returnTextDelta: function(){
			
		}
	}

}
</script>
