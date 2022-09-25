<template>
	<li class="p-3 border-b last:border-0 m-0 flex flex-row items-center">
		<div class=" w-8/12 flex">
		<div v-html='localTag.name'></div>
		<div class="ml-2 rounded-full bg-gray-500 text-white inline px-2 py-0 h-4 text-xs">{{localTag.count}}</div></div>
		<div class="flex justify-around w-3/12">
			<select v-model.number="localTag.selected">
					<option 
					v-for="option in localTag.options"
					v-bind:key="option.id"
					v-bind:value="option.id"
					>
					[awraq id="{{option.id}}"]
					</option>
					
			</select>
		</div>
		<div class="flex justify-end w-1/12">
			<input type="checkbox" v-model="localTag.switch">
		</div>
	</li>
	
  
</template>

<script>
export default {
	name:'Row',
	props:{
		tag:Object
	},
	data: function(){
		return{
			localTag:this.tag ? this.tag : '',
		}
	},
	methods: {
		updateOnChange: function(newVal){
			const data = new FormData();

			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awarqUpdateProductTerm');

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
		localTag:{
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