<template>
	<li class="border-b mb-0 ">
		<div class="form-row flex flex-row justify-between items-center px-4 py-2">
      <button @click="deleteEntry()" class="rounded border cursor-pointer flex flex-row items-center px-4 py-2 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg"  class="inline w-4 h-4 cursor-pointer mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
        <span class="font-semibold">Delete Entry</span></button>
      <div class="w-6/12 px-4">
        {{row.form_name}}
      </div>
      <div class="w-4/12 flex flex-row justify-end ">
        <div class="rounded-full border cursor-pointer px-1 py-1" @click="toggleDrawer()"><svg xmlns="http://www.w3.org/2000/svg" class="hover:cursor-pointer w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></div>
      </div>
		</div>
    <div class=" border-t flex flex-row justify-center bg-gray-50" v-show="entryToggle">
      <div v-if="row.entry" class=" m-4 border rounded w-full md:w-6/12 bg-white relative">
        <div v-if="row.entry['originUrl']" class="flex flex-row justify-between border-b items-center py-2 px-4 lowercase">
          <span>{{row.entry['originPageTitle'] ? row.entry['originPageTitle'] : ''}}</span>
          <span class="border ">
            <a v-bind:href="row.entry['originUrl']"  target="_blank" class="p-2 flex justify-between items-center font-semibold rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5  mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" /><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" /></svg>
            View Page</a>
          </span>
        </div>

        <div v-bind:id="'div' + props.row.id" >
					<div class="flex flex-row flex-wrap">
          <template v-for="e in entry" v-bind:key="e"  >
            <template v-for="(i,index) in e" v-bind:key="index">
              <div v-bind:class="i.css" class=" py-1 px-4 first:pt-4 last:pb-4 ">
                <div  class="flex flex-col">
                  <span class="my-1 capitalize font-semibold">{{i.name}}</span>
                  <span class="border rounded p-2 ">{{i.data}}</span>
                </div>
              </div>
            </template>
          </template>
					</div>
        </div>
        <div class="border-t flex justify-between items-center py-4 px-4">
					<button class="font-semibold flex flex-row items-center border rounded  py-2 px-4 lowercase">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" /></svg>						Block Sender
					</button>
          <button @click="printEntry" class="font-semibold flex flex-row items-center border rounded  py-2 px-4 lowercase">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" /></svg>Print</button>
          
        </div>
      </div>

    </div>
	</li>
</template>
<script setup>
import { ref, onMounted} from 'vue';

const props = defineProps({
	row:Object
});


const emits = defineEmits({
  removeEntry:String
});

const entryToggle = ref(false);
/**
 * This method adding css class to entry data object
 * To format the rows decently 
 */
function formatEntryData(){
	let fields = props.row.entry[0]
	for (let key in fields) {
		if (fields.hasOwnProperty(key)) {
			if (Number(fields[key].length) === 1) {
				fields[key][0]['css'] = 'w-full';
			} else {
				if (Number(fields[key].length % 2) === 0) {
					for (let k in fields[key]) {
						fields[key][k]['css'] = 'w-1/2';
					}
				} else {
					for (let j in fields[key]) {
						if (Number(j) === 0) {
							fields[key][j]['css'] = 'w-full';
						} else {
							fields[key][j]['css'] = 'w-1/2';
						}
						
					}
				}
			}
			

		}
	}
	return fields;
}
const entry = formatEntryData();


/**
 * This to toggle entry drawer
 */
function toggleDrawer(){
  entryToggle.value = !entryToggle.value;
}


/**
 * Delete Entry from Database
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
        emits('removeEntry',props.row.id);
      }
		})
		.catch(err => console.log(err));

  }


}

/**
 * This method to print the entry
 */
function printEntry(){
  let head = document.querySelector('head').innerHTML;
  let actualPrintableContent = document.querySelector('#div'+props.row.id).innerHTML;
  let WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
  WinPrint.document.body.innerHTML = actualPrintableContent;
  WinPrint.document.head.innerHTML = head;
  WinPrint.focus();
  WinPrint.print();

}

function exportEntryasCsv() {
	
}

onMounted(()=>{
});
</script>
