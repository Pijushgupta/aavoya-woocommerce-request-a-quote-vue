<template>
	<div>
	 <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
		<div v-if="entries !== 0" >
			 <ul class="pb-8">
			 <Rows v-for="entry in entries" v-bind:row="entry" v-bind:key="entry"/>
			 </ul>
		 </div>
		<div v-if="entries === 0" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">

			<h2 class="flex items-center text-2xl font-semibold text-gray-600  tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor"> <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /> <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /> </svg>Inbox Empty</h2>
			<p class="text-md font-semibold text-gray-500"> The submitted forms will show here.</p>
			

		 </div>
		 <div v-if="entries === false" class="container mx-auto md:w-7/12  flex flex-col items-center">
			
				 <img  v-bind:src="imagePath + 'image/loading.gif'"  :width="250" :height="250"/>
			
		 </div>
		
		</div>
	</div>

</template>
<script setup>
import { ref, onMounted } from 'vue';
import Rows from './Entrys/Rows.vue'; 

const entries = ref(false);
const imagePath = ref(''); 

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
onMounted(function () {
	imagePath.value = assetPath; 
	getEntries();
	
})
</script>
