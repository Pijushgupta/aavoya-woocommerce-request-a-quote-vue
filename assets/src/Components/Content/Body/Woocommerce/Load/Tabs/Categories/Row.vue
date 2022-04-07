<template>
	<li class="p-3 border-b last:border-0 m-0 flex flex-row items-center">
		<div class=" w-8/12 flex">
		<div v-html='localCategory.name'></div>
		<div class="ml-2 rounded-full bg-gray-500 text-white inline px-2 py-0 h-4 text-xs">{{localCategory.count}}</div></div>
		<div class="flex justify-around w-3/12">
			<select v-model.number="localCategory.selected">
					<option 
					v-for="option in localCategory.options"
					v-bind:key="option.id"
					v-bind:value="option.id"
					>
					[shotcode id="{{option.id}}"]
					</option>
					
			</select>
		</div>
		<div class="flex justify-end w-1/12">
			<input type="checkbox" v-model="localCategory.switch">
		</div>
	</li>
	
  
</template>

<script>
export default {
	name:'Row',
	props:{
		category:Object
	},
	data: function(){
		return{
			localCategory:this.category ? this.category : '',
		}
	},
	methods: {
		updateOnChange: function(newVal){
			const data = new FormData();

			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awarqUpdateProductCat');

			data.append('term_id',newVal.term_id);
			data.append('selected',newVal.selected);
			data.append('switch',newVal.switch);

			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body: data
			})
			.catch(err => console.log(err));
		}
	},
	watch:{
		localCategory:{
			handler: function(oldVal,newVal){
				this.updateOnChange(newVal);
				
			},
			deep: true
		}
	},
	
	

}
</script>

<style>
</style>