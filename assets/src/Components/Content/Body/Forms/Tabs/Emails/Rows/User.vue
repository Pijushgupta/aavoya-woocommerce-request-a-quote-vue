<template>
  <div  class="mx-auto md:w-7/12 px-4 py-4">
    <div class="flex flex-row justify-between items-center py-6 px-4 mb-3.5 bg-gray-50 rounded-lg">
      <label class="font-medium" >Enable/Disable</label>

      <input  type="checkbox" />
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Sent to Email. </label>
        <button   @click="fieldSeclectorMenuToOpen == 'senttoemail' ? fieldSeclectorMenuToOpen = 'none' : fieldSeclectorMenuToOpen = 'senttoemail'" class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
        <FieldSelector v-if="fieldSeclectorMenuToOpen == 'senttoemail'" v-bind:name="'senttoemail'" v-bind:fields="flatInput" @selected='selected'/>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">From name. </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">From Email </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Reply to Email. </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">
      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Subject </label>
        <button  class=" ">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg>
        </button>
      </div>
      <input  type="text" class="w-full"  >
    </div>
    <div class="input-group">

      <div class="flex flex-row justify-between items-center relative">
        <label class="font-medium">Message</label>
        <button  class=" "><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"> <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /> </svg></button>

      </div>

    </div>
  </div>
  <div class=" bg-gray-50">
    <div class=" mx-auto md:w-7/12 flex flex-row justify-end px-4 py-2">
      <button class="px-6 py-2 rounded-full border bg-white" @click="">Save</button>
    </div>
  </div>
</template>
<script setup>
import {ref, watch} from 'vue';
import FieldSelector from './components/FieldSelector';
const props = defineProps({
  id:Number
})
const formMeta = ref(false);
const flatInput = ref([]);
const userNotificationSettingData = ref(false)
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
  if (name === 'senttoemail') {
    userNotificationSettingData.value.senttoemail = userNotificationSettingData.value.senttoemail + ' {'+fieldName+'} ';
  }
  if (name === 'subject') {
    userNotificationSettingData.value.subject = '{'+fieldName+'}';
  }
  if (name === 'bcc') {
    userNotificationSettingData.value.bcc = '{'+fieldName+'}';
  }
  if (name === 'replyto') {
    userNotificationSettingData.value.replay_To = '{'+fieldName+'}';
  }
  if (name === 'fromemail') {
    userNotificationSettingData.value.from_email = '{'+fieldName+'}';
  }
  if (name === 'fromname') {
    if(userNotificationSettingData.value.from_name == ''){
      userNotificationSettingData.value.from_name = '{'+fieldName+'}';
    }else{
      userNotificationSettingData.value.from_name = userNotificationSettingData.value.from_name +', {'+fieldName+'}';
    }

  }
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

</script>