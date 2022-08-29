<template>
	<div  class="relative">
		
		<div class="input-group">
			<label class="font-medium">Sent to Email (Required)</label>
			<input type="text" class="w-full" >
		</div>
		<div class="input-group">
			<label class="font-medium">From name</label>
			<div class="flex flex-row">
			<input type="text" class="w-full">
			<button class="border border-l-0 p-2 "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /> </svg></button>
			</div>
		</div>
		<div class="input-group">
			<label class="font-medium">From email</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label class="font-medium">Reply to</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label class="font-medium">BCC</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label class="font-medium">Subject</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label class="font-medium">Message</label>
			<textarea class="w-full"> </textarea>
		</div>
	</div>
</template>
<script setup>
import { ref,watch } from 'vue';
const props = defineProps({
	id: Number
});

const formMeta = ref(false);
const flatInput = ref([]);
/**
 * Add Non-readOnly/required types as Input types grows in future
 */
let typeToAllow = ['content','name','text','email','address','phone','textarea','checkbox','radio']

/**
 * getting the form Meta AKA inputs 
 * Calling it during setup automatically 
 */
const getFormMeta = (function () {
	const data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action', 'awraqGetFormMeta');
	data.append('id', props.id);
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(res => res.json())
		.then(res => {
			
			if (res !== false) {
				formMeta.value = res;
				console.log(res);
			}
		})
		.catch(err => console.log(err));

}());

/**
 * Watch to generate flat input if Form Meta fetched 
 */
watch(formMeta, (newVal, oldVal) => {
	if (formMeta.value !== false) {
		makeInputFlat();
	}
}, { deep: true })

/**
 * Creating flat input from from nested inputs(FormMeta)
 */
function makeInputFlat() {
	if (formMeta.value === false) return;

	for (let i = 0; i < formMeta.value.length; i++){
		if (inArray(formMeta.value[i].type, typeToAllow) !== -1) {

			if (formMeta.value[i].type == 'address' || formMeta.value[i].type == 'name') {
				for (let j = 0; j < formMeta.value[i].data.Options.length; j++){
					if (formMeta.value[i].data.Options[j].enabled == true) {
						let uniqueName = formMeta.value[i].uniqueName;
						let displayName = formMeta.value[i].data.Options[j].label != '' ? formMeta.value[i].data.Options[j].label.toLowerCase() : formMeta.value[i].data.Options[j].name.toLowerCase();
						flatInput.value.push({'uniqueName': uniqueName + '_' + j, 'displayName': displayName })
					}
				}
			}
			if (formMeta.value[i].type == 'text' || formMeta.value[i].type == 'phone' || formMeta.value[i].type == 'textarea' || formMeta.value[i].type == 'email') {
				let uniqueName = formMeta.value[i].uniqueName;
				let displayName = formMeta.value[i].data.label != '' ? formMeta.value[i].data.label.toLowerCase() : formMeta.value[i].name.toLowerCase();
				flatInput.value.push({'uniqueName': uniqueName, 'displayName': displayName })
			}

			//TODO

			

		}
	}

	console.log(flatInput.value);
}

function inArray(needle,haystack) {
	for (let i = 0; i < haystack.length; i++){
		if (haystack[i] == needle) {
			return i;
		}
	}
	return -1;
}




</script>