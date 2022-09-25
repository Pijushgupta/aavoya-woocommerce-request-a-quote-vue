<template>
	<div>
	 <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
		<div v-if="entries !== 0" >
			 <ul class="">
			 <Rows
           v-for="entry in entries"
           v-bind:row="entry"
           v-bind:key="entry"
           @removeEntry = "removeEntry"
       />
			 </ul>
		 </div>
		<div v-if="entries === 0" class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">
			<h2 class="flex items-center text-2xl font-semibold text-gray-600  tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor"> <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /> <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /> </svg>Inbox Empty</h2>
			<p class="text-md font-semibold text-gray-500"> The submitted forms will show here.</p>
		 </div>
		 <div v-if="entries === false" class="container mx-auto md:w-7/12  flex flex-col items-center">
       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="19" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.125s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.25s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.875s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.375s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.75s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.625s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.5s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect></svg>
		 </div>
		
		</div>
	</div>

</template>
<script setup>
import { ref, onMounted } from 'vue';
import Rows from './Entries/Rows.vue';

const entries = ref(false);


/**
 * This Method getting all the entries from server
 */
function getEntries() {
	let data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action','awraqEntriesGet')
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(response => response.json())
		.then(response => {
				entries.value = response;

		})
		.catch(err => console.log(err));
}

/**
 * This function to remove Entry from row after successful
 * deletion from server by other method from click component
 * @param id
 */
function removeEntry(id){
  if(typeof entries.value == 'object'){
    entries.value = entries.value.filter(e => {
      if(e.id != id){
        return e;
      }
    })
    if(entries.value.length < 1){
      entries.value = 0;
    }
  }
}

onMounted(function () {

	getEntries();
})
</script>
