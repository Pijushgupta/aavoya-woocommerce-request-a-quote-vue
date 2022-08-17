<template>
	
	<div v-if="products == false">
		<h3>Loading...</h3>
	</div>
	<div v-if="products == null ">
		<h3>No Product</h3>
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
				console.log(response)
			})
			.catch((err) => console.log(err));
		}
	},
	
	created: function() {
		this.getProducts();
	}
}
</script>