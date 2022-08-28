<template>
  <div>
	 <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
		 <div v-if="rows !== null && rows !== ''">
			 <ul class="pb-8">
			 <Rows 
			 v-for="row in rows" 
			 v-bind:key="row.ID" 
			 v-bind:row="row"
			 v-on:removeRow="removeRow"

			 />
			 </ul>
		 </div>
		 <div v-if="rows === null" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">

			<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">Aavoya Form</h2>
			<p class="text-md font-semibold text-gray-500"> Create form(s) by clicking the button below.</p>
			<a v-on:click.prevent="createForm" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4 cursor-pointer">
			<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Create</a> 

		 </div>
		 

			<div v-if="rows === ''"  class="container mx-auto md:w-7/12  flex flex-col items-center">

        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="19" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.125s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.25s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.875s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.375s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.75s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.625s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.5s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect></svg>
		 </div>
		 
	 </div>
	  
	  <New v-if="rows !== null" v-on:createForm='createForm'/>
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
			rows: '',

		}
	},
	methods:{
		getForms: function(){
			const data = new FormData();
			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awraqGetForms');

			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body: data
			})
			.then((response) => response.json())
			.then((response) =>{
				this.rows = response;	
			})
			.catch((err) => console.log(err));
		},
		createForm: function(){
			const data = new FormData();
			data.append('action','awraqCreateForms');
			data.append('awraq_nonce',awraq_nonce);

			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body:data
			})
			.then(response => response.json())
			.then(response => {
				if(this.rows === null){
					this.rows = [];
				}
				this.rows.unshift(response);
				
			})
			.catch((err) => console.log(err));

		},
		removeRow: function(id){
			this.rows = this.rows.filter(row => row.ID !== id);
		}
	},
	created: function(){
		this.getForms();
	}


}
</script>

<style>
</style>