<template>
	<div  class="mx-auto md:w-7/12 px-4 py-4">
		<div class="flex flex-row justify-between items-center py-6 px-4 mb-3.5 bg-gray-50 rounded-lg">
      <label class="font-medium" :for="'ed'+props.id">Enable/Disable</label>
      <input :id="'ed'+props.id" type="checkbox" v-model="adminNotificationSettingData.ed"/>
    </div>
    <!-- Sent to Email -->
		<div class="input-group ">
			<label class="font-medium">Sent to Email. <div class="tool-tip">Hello</div>  (Required)</label>
			<input v-if="adminNotificationSettingData != false" type="text" class="w-full" v-model="adminNotificationSettingData.sent_to_email">
		</div>
		<!-- ends -->
		<div class="input-group">
			
			<div class="flex flex-row justify-between items-center relative">
				<label class="font-medium">From name</label>
				<button @click="fieldSeclectorMenuToOpen == 'fromname' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'fromname'" class=" ">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
				</button>
				<FieldSelector v-if="fieldSeclectorMenuToOpen == 'fromname'" v-bind:name="'fromname'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			
			<input v-if="adminNotificationSettingData != false" type="text" class="w-full" v-model="adminNotificationSettingData.from_name" >
		</div>
		<div class="input-group">
			<div class="flex flex-row justify-between items-center relative">
				<label class="font-medium">From email</label>
				<button @click="fieldSeclectorMenuToOpen == 'fromemail' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'fromemail'" class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>
				<FieldSelector v-if="fieldSeclectorMenuToOpen == 'fromemail'" v-bind:name="'fromemail'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			<input  type="text" class="w-full" v-model="adminNotificationSettingData.from_email">
		</div>
		<div class="input-group">
			
			<div class="flex flex-row justify-between items-center relative">
				<label class="font-medium">Reply to</label>
			<button @click="fieldSeclectorMenuToOpen == 'replyto' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'replyto'" class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>
			<FieldSelector v-if="fieldSeclectorMenuToOpen == 'replyto'" v-bind:name="'replyto'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			<input  v-if="adminNotificationSettingData != false" type="text" class="w-full" v-model="adminNotificationSettingData.replay_To">
		</div>
		<div class="input-group">
			
			<div class="flex flex-row justify-between items-center relative">
			<label class="font-medium">BCC</label>
			<button @click="fieldSeclectorMenuToOpen == 'bcc' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'bcc'" class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>
			<FieldSelector v-if="fieldSeclectorMenuToOpen == 'bcc'" v-bind:name="'bcc'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			<input v-if="adminNotificationSettingData != false" type="text" class="w-full" v-model="adminNotificationSettingData.bcc">
		</div>
		<div class="input-group">
			
			<div class="flex flex-row justify-between items-center relative">
				<label class="font-medium">Subject</label>
			<button @click="fieldSeclectorMenuToOpen == 'subject' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'subject'" class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>
			<FieldSelector v-if="fieldSeclectorMenuToOpen == 'subject'" v-bind:name="'subject'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			<input v-if="adminNotificationSettingData != false" type="text" class="w-full" v-model="adminNotificationSettingData.subject">
		</div>
		<div class="input-group">
			
			<div class="flex flex-row justify-between items-center relative">
				<label class="font-medium">Message</label>
			<button @click="fieldSeclectorMenuToOpen == 'message' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'message'" class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>
			<FieldSelector v-if="fieldSeclectorMenuToOpen == 'message'" v-bind:name="'message'" v-bind:fields="flatInput" @selected='selected'/>
			</div>
			<Editor v-if="adminNotificationSettingData != false" v-model="adminNotificationSettingData.message" class="w-full" />
		</div>
		
	</div>
	<div class=" bg-gray-50">
		<div class=" mx-auto md:w-7/12 flex flex-row justify-end px-4 py-2">
			<button class="px-6 py-2 rounded-full border bg-white" @click="updateAdminNotificationInputs">Save</button>
	  </div>
	</div>
	
</template>
<script setup>
import { ref, watch } from 'vue';
import FieldSelector from './components/FieldSelector';
import Editor from './components/Editor.vue';
import {useToast} from "vue-toastification";


const props = defineProps({
	id: Number
});

const formMeta = ref(false);
const flatInput = ref([]);
const adminNotificationSettingData = ref(false);
const fieldSeclectorMenuToOpen = ref('none');
/**
 * Add Non-readOnly/required types as Input types grows in future
 */
let typeToAllow = ['name','text','email','address','phone','textarea','checkbox','radio','date']




/**
 * Update the local variable related to inputs  
 * @param {string} fieldName 
 * @param {string} name 
 */
function selected(fieldName, name) { 
	if (name === 'message') {
		adminNotificationSettingData.value.message = adminNotificationSettingData.value.message + ' {'+fieldName+'} ';
	}
	if (name === 'subject') {
		adminNotificationSettingData.value.subject = '{'+fieldName+'}';
	}
	if (name === 'bcc') {
		adminNotificationSettingData.value.bcc = '{'+fieldName+'}';
	}
	if (name === 'replyto') {
		adminNotificationSettingData.value.replay_To = '{'+fieldName+'}';
	}
	if (name === 'fromemail') {
		adminNotificationSettingData.value.from_email = '{'+fieldName+'}';
	}
	if (name === 'fromname') {
    if(adminNotificationSettingData.value.from_name == ''){
      adminNotificationSettingData.value.from_name = '{'+fieldName+'}';
    }else{
      adminNotificationSettingData.value.from_name = adminNotificationSettingData.value.from_name +', {'+fieldName+'}';
    }

	}
}

/**
 * updating
 */
function updateAdminNotificationInputs() {
  if(adminNotificationSettingData.value === false) return;
  const data = new FormData();
  data.append('awraq_nonce',awraq_nonce);
  data.append('action','awraqUpdateAdminFormMeta');
  data.append('id',props.id);
  data.append('data',JSON.stringify(adminNotificationSettingData.value))
	fetch(awraq_ajax_path,{
    method:'POST',
    credentials:'same-origin',
    body:data
  })
      .then(res => res.json())
      .then(res => {
        if(res === true){
          const notification =  useToast();
          notification('Setting Updated');
        }
      })
      .catch(err => console.log(err));
}

/**
 * To find element in an array
 * @param {any} needle 
 * @param {array} haystack 
 */
function inArray(needle,haystack) {
	for (let i = 0; i < haystack.length; i++){
		if (haystack[i] == needle) {
			return i;
		}
	}
	return -1;
}

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
			if (formMeta.value[i].type == 'text' || formMeta.value[i].type == 'phone' || formMeta.value[i].type == 'textarea' || formMeta.value[i].type == 'email' || formMeta.value[i].type == 'date' || formMeta.value[i].type == 'radio' || formMeta.value[i].type == 'checkbox') {
				let uniqueName = formMeta.value[i].uniqueName;
				let displayName = formMeta.value[i].data.label != '' ? formMeta.value[i].data.label.toLowerCase() : formMeta.value[i].name.toLowerCase();
				flatInput.value.push({'uniqueName': uniqueName, 'displayName': displayName })
			}
		}
	}

	
}

/**
 * Watch to generate flat input if Form Meta fetched 
 */
 watch(formMeta, (newVal, oldVal) => {
	if (formMeta.value !== false) {
		makeInputFlat();
	}
}, { deep: true })

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
				
			}
		})
		.catch(err => console.log(err));

}());

 const getAdminMeta = (function () {
	const data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action', 'awraqGetAdminFormMeta');
	data.append('id', props.id);
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(res => res.json())
		.then(res => {
			
			adminNotificationSettingData.value = res; 
		})
		.catch (err => console.log(err));
}());



</script>