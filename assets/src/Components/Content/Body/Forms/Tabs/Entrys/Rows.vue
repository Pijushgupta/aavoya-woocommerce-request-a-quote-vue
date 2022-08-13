<template>
	<li class="border-b mb-0 ">
		<div class="form-row flex flex-row justify-between items-center px-4 py-2">
			{{row.form_name}}
		</div>
	</li>
</template>
<script setup>
import { ref, onMounted } from 'vue';
const props = defineProps({
	row:Object
})


</script>
