<template>
<div v-bind:style="{backgroundImage: 'url('+ assetPath + 'image/header.jpg)' } "> 
	
	<div class="relative w-full " >
		<div class="w-full h-full bg-transparent backdrop-blur px-5 border-b header">
			<div class="container mx-auto">
				<div class="flex md:flex-row md:h-28 justify-start items-center">
					<div class="w-full ">
						<h1 class="text-white inline text-4xl uppercase tracking-wide "><span class="font-bold ">RAQ</span></h1><span class="ml-2 font-bold uppercase text-xs tracking-wider text-white">by Aavoya</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
export default {
	name:'Header'
	,
	data: function(){
		return {
			assetPath : assetPath
		}
	},
	mounted: function(){
		
	}
}
</script>