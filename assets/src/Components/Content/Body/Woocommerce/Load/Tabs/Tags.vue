<template>
	<div v-if="tags !== false && tags.length !== 0 " class="container mx-auto border md:w-7/12 my-10 rounded-lg">
		<ul >
			<Row
			v-for="tag in tags"
			v-bind:key="tag.term_id"
			v-bind:tag="tag"
			/>
		</ul>
		
	</div>
	<div v-if="tags.length === 0 "  class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">
		<h2 class="flex items-center text-2xl font-semibold text-gray-600 tracking-wide mb-4">No Product Tags.</h2>
		<p class="text-md font-semibold text-gray-500"> Create product tag(s) by clicking the button below.</p>
		<a href="/wp-admin/edit-tags.php?taxonomy=product_tag&post_type=product" target="_blank" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4"><svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>Create</a> 
	</div>
  <div v-if="tags === false" class="container mx-auto md:w-7/12  flex flex-col items-center">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="19" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.125s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.25s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.875s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.375s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.75s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.625s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.5s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect></svg>
  </div>
</template>

<script>
import Row from './Tags/Row.vue'
export default {
	name: 'Tags',
	components: { 
		Row ,
	},
	data: function(){
		return {
			tags:false
		}
	},
	created: function (){
		this.getTags();
	},
	methods:{
		getTags: function(){
			const data = new FormData();
			data.append('action','awraqGetProductTag');
			data.append('awraq_nonce',awraq_nonce);

			fetch(awraq_ajax_path,{
				method:'POST',
				credentials: 'same-origin',
				body: data
			})
			.then(response => response.json())
			.then(response => {
				this.tags = response
				
			})
			.catch(err => console.log(err));
		},
	}

}
</script>
