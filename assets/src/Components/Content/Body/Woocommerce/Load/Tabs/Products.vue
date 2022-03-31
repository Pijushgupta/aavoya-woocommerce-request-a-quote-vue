<template>
	<Row 
	v-for="product in products" 
	v-bind:key="product.id"
	v-bind:row="product"
	/>
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
			products:'',
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