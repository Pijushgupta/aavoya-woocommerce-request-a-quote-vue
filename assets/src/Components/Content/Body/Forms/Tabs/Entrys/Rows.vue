<template>
	<li class="border-b mb-0 ">
		<div class="form-row flex flex-row justify-between items-center px-4 py-2">
      <button @click="deleteEntry()" class="rounded border cursor-pointer flex flex-row items-center px-4 py-2 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg"  class="inline w-4 h-4 cursor-pointer mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
        <span class="font-semibold">Delete Entry</span></button>
      <div class="w-6/12">
        {{row.form_name}}
      </div>
      <div class="w-4/12 flex flex-row justify-end ">
        <div class="rounded-full border cursor-pointer px-1 py-1" @click="toggleDrawer()"><svg xmlns="http://www.w3.org/2000/svg" class="hover:cursor-pointer w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></div>
      </div>
		</div>
    <div class="form-row-opened border-t flex flex-row" v-show="entryToggle">
      
    </div>
	</li>
</template>
<script setup>
import { ref} from 'vue';
const props = defineProps({
	row:Object
})

const entryToggle = ref(false);

/**
 * This to toggle entry drawer
 */
function toggleDrawer(){
  entryToggle.value = !entryToggle.value;
}

/**
 *
 */
function deleteEntry(){
  if(confirm('Entry will get deleted permanently?')){
    const data = new FormData();
    data.append('awraq_nonce',awraq_nonce);
    data.append('action','awraqEntryDelete');
    data.append('entryId',props.row.id);
    fetch(awraq_ajax_path,{
      method:'POST',
      credentials:'same-origin',
      body:data
    })
		.then(res => res.json())
		.then(res =>{
      if(res == true){

      }

		})
		.catch(err => console.log(err));

  }


}


</script>
