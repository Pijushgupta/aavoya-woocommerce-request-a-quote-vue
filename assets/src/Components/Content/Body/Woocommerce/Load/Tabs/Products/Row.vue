<template>
	<div class="flex flex-row justify-around border-b items-center last:border-0 py-2">
		<div class="w-1/12">{{rowLocal.id}}</div>
		<div class="w-4/12">{{rowLocal.title}}</div>
		<div class="w-4/12">
			<select v-model.number="rowLocal.selected" class="w-full">
				<option 
				v-for="option in rowLocal.options" 
				v-bind:key="option.id"
				v-bind:value="option.id"
				>
				[shortcode id="{{option.id}}"]
				</option>
			</select>
		</div>
		<div class="w-1/12"><input type="checkbox"></div>
		<div class="w-1/12">
			<a v-bind:href="'/'+rowLocal.slug" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-pink-700" viewBox="0 0 20 20" ><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
			</a>
		</div>
	</div>	
</template>
<script>
	export default {
		name: 'Row',
		props:{
			row:Object,
		},
		data: function(){
			return {
				rowLocal: this.row ? this.row : "",
			}
		},
		methods:{
			handleSelectedShortcode: function(newVal){
				const selectedShortcode = newVal.selected;
				console.log(selectedShortcode);
			}
		},
		watch: {
			rowLocal:{
				handler: function(oldVal,newVal){
					this.handleSelectedShortcode(newVal);
				},
				deep: true
			}
		},
	}

</script>