<template>
	<div v-if="categories !== false && categories.length !==0 " class="container mx-auto border md:w-7/12 my-10 rounded-lg">
		<ul>
			<Row 
			v-for="category in categories" 
			v-bind:key="category.term_id" 
			v-bind:category="category"
			/>
		</ul>
	</div>

</template>

<script>
import Row from './Categories/Row.vue'
export default {
	name:'Categories',
	components:{
		Row,
	},
	data: function(){
		return {
			categories:false,
			
		}
	},
	created: function(){
		this.getCategories();
	},
	methods:{
		getCategories: function(){
			const data = new FormData();
			data.append('action','awraqGetProductCat');
			data.append('awraq_nonce',awraq_nonce);

			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body:data
			})
			.then((response) => response.json())
			.then((response) => {
				
				this.categories = response;
			
				
			})
			.catch((err) => console.log(err));
		},
		

	}
}
</script>
