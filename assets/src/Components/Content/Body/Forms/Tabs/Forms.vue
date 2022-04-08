<template>
  <div>
	 <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
		 <div v-if="rows !== null">
			 <Rows/>
		 </div>
		 <div v-if="rows === null" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">

			<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">Aavoya Form</h2>
			<p class="text-md font-semibold text-gray-500"> Create form(s) by clicking the button below.</p>
			<a href="/wp-admin/edit-tags.php?taxonomy=product_tag&post_type=product" target="_blank" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4">
			<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Create</a> 

		 </div>
		 
	 </div>
	  
	  <New v-if="rows !== null"/>
  </div>
</template>

<script>
import Rows from './Forms/Rows.vue';
import New from './Forms/New.vue';
export default {
	name:'Forms',
	components:{
		Rows,
		New
	},
	data: function(){
		return {
			rows : '',
		}
	},
	methods:{
		getForms: function(){
			this.rows = null;
		}
	},
	created: function(){
		this.getForms();
	}


}
</script>

<style>
</style>