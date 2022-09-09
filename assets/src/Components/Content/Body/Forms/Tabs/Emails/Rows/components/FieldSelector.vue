<template>
	<div  class="p-2 absolute right-0 top-6 bg-white rounded-lg border min-w-fit shadow z-10" >
	<ul class="max-h-52  overflow-y-scroll tw-scroll-bar">
		<li v-for="item in props.fields" :key="item" class="font-medium cursor-pointer border-l-2 border-transparent  py-2 pl-6 pr-8 first:mt-1 last:mb-1 hover:bg-gray-50 hover:border-blue-500" @click="$emit('selected',item.uniqueName,name)">{{item.displayName}} ({{item.uniqueName}})</li>
	</ul>
</div>
</template>
<script setup>
import { ref } from 'vue';
const props = defineProps({
	fields: [Array, Object],
	name:String
});




</script>
