<template>
	<div>
	 <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
		<div v-if="entries !== 0" >
			 <ul class="pb-8">
			 <Rows v-for="entry in entries" v-bind:row="entry" v-bind:key="entry"/>
			 </ul>
		 </div>
		<div v-if="entries === 0" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">

			<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">Empty</h2>
			<p class="text-md font-semibold text-gray-500"> The submitted forms will show here.</p>
			

		 </div>
		 <div v-if="entries === false" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">

			<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">Fetching...</h2>
			
			

		 </div>
		</div>
	</div>

</template>
<script setup>
import { ref, onMounted } from 'vue';
import Rows from './Entrys/Rows.vue'; 
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
