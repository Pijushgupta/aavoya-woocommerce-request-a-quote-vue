<template>
  <div class="button-row flex flex justify-end  py-2">
		<a  v-on:click.prevent="$emit('createForm')" class="border bg-white px-4 py-2 rounded-full text-gray-500 font-semibold capitalize cursor-pointer">
		<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
			Add New
		</a>
	</div>
</template>

<script>
export default {
	name:'New'
}
</script>

<style>
</style>