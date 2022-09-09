<template>
  <li class=" mb-0 ">
    <div class="border-b form-row flex flex-row justify-between items-center px-4 py-4">
      <div class="flex flex row">
        <div class="font-medium px-1">#{{props.row.ID}}</div>
        <div>{{props.row.post_title ? props.row.post_title : 'Untitled Form'}}</div>
      </div>
      <div class="rounded-full border cursor-pointer px-1 py-1" @click="toggleDrawer">
        <svg xmlns="http://www.w3.org/2000/svg" class="hover:cursor-pointer w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
      </div>

    </div>
    <div class="w-full border-b  flex flex-row " v-if="drawerStatus == true">
      <ul class="w-2/12 md:border-r">
				<li @click="toggleBody(1)" :class="bodyStatus == 1 ? 'text-blue-500 ':''" class="font-medium px-4 py-2 mb-0 first:pt-4 last:pb-4 cursor-pointer">user notification</li>
				<li @click="toggleBody(2)" :class="bodyStatus == 2 ? 'text-blue-500 ':''" class="font-medium px-4 py-2 mb-0 first:pt-4 last:pb-4 cursor-pointer">admin notification</li>
			</ul>
			<ul class="w-10/12 notification">
				<li v-show="bodyStatus == 1" class="m-0"><User :id="row.ID" /></li>
				<li v-show="bodyStatus == 2" class="m-0"><Admin :id="row.ID"/></li>
			</ul>
    </div>
  </li>
</template>

<script setup>
import { ref} from "vue";
import Admin from './Rows/Admin';
import User from './Rows/User';

const props = defineProps({
  row:Object
})

const drawerStatus = ref(false);
function toggleDrawer(){
  drawerStatus.value = !drawerStatus.value;
}

const bodyStatus = ref(1);
function toggleBody(active) {
	bodyStatus.value = active;
}






</script>
