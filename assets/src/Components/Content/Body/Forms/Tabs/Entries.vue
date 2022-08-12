<template>
	<h1>Hello</h1>
</template>
<script setup>
import { ref, onMounted } from 'vue';
const entries = ref(false);

function getEntries() {
	let data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action','aqraqEntriesGet')
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(response => response.json())
		.then(response => {
			entries.value = response;
			console.log(response);
		})
		.catch(err => console.log(err));
}
onMounted(function (){
	getEntries();
})
</script>
