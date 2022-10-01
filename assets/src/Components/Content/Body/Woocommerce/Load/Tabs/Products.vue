<template>
	
	<div v-if="products == false" class="container mx-auto md:w-7/12  flex flex-col items-center">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="19" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.125s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.25s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.875s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.375s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.75s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.625s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.5s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect></svg>
	</div>
	<div v-if="products == null " class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">
    <h2 class="flex items-center text-2xl font-semibold text-gray-600 tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg> No Products</h2>
    <p class="text-md font-semibold text-gray-500"> Create Products </p>
    <a href="/wp-admin/post-new.php?post_type=product" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4 cursor-pointer">
      <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Create</a>
  </div>
	<div v-if="products != false && products != null">
		<Row 
	v-for="product in products" 
	v-bind:key="product.id"
	v-bind:row="product"
	/>
	</div>
	
</template>
<script>
import Row from './Products/Row.vue'
export default {
	name: 'Products',
	components:{
		Row,
	},
	data: function(){
		return{
			products:false,
		}
	},
	methods:{
		getProducts: function() {
			const data = new FormData();
			data.append('action','awraqProducts');
			data.append('awraq_nonce',awraq_nonce);
			
			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body:data
			})
			.then((response) => response.json())
			.then((response) => {
				this.products = response;
				
			})
			.catch((err) => console.log(err));
		}
	},
	
	created: function() {
		this.getProducts();
	}
}
</script>