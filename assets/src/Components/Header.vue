<template>
<div v-bind:style="{backgroundImage: 'url('+ assetPath + 'image/header.jpg)' } "> 
	
	<div class="relative w-full " >
		<div class="w-full h-full bg-transparent backdrop-blur px-5 border-b header">
			<div class="container mx-auto">
				<div class="flex md:flex-row md:h-28 justify-between items-center ">
					<div >
						<h1 class="text-white inline text-4xl uppercase tracking-wide "><span class="font-bold ">RAQ</span></h1>
            <span class="ml-2 font-bold uppercase text-xs tracking-wider text-white">by Aavoya</span>
					</div>
          <div class="backdrop-blur px-4 py-1 text-white border border-dashed border-white rounded-lg font-medium ">
            Made with ❤️ in India
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