<template>
	<div class="w-full flex flex-col border   rounded-lg my-2">
		<div class="px-4 py-3 border-b font-medium  flex flex-row items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd" /> <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z" clip-rule="evenodd" /> <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd" /> </svg>Block List</div>
		<div class=" px-4 py-2 h-28 flex flex-row flex-wrap">
			<template v-for="(ip,i) in blockList" :key="i">
				<div class="rounded-full border px-4 py-2 m-1 h-fit flex flex-row items-center">
					<span>{{ip}}</span>
					<span class="ml-1 cursor-pointer" @click="removeIpFromList(i)">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
					</span>
				</div>
			</template>
			<input type="text" class="h-fit px-4 py-2 m-1 ip-inputbox" v-on:keydown.enter="addIpToList" v-model="tempIp" placeholder="add ip"/>
		</div>
	</div>
</template>

<script setup>
import { ref } from 'vue';
const blockList = ref();
const tempIp = ref('');
function addIpToList() {
	blockList.value.push(tempIp.value);
	tempIp.value = '';
}
function removeIpFromList(i) {
	blockList.value.splice(i, 1);
}
const getBlockedIps = (function () {
	const data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action', 'awraqGetBlockedIps');
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(res => res.json())
		.then(res => {
			if (res != 0) {
				blockList.value = res;
			}
		})
		.catch(err => console.log(err));


}());
</script>
<style scoped>
.ip-inputbox {
	border: 0;
}
.ip-inputbox:focus {
	box-shadow: none;
}
</style>