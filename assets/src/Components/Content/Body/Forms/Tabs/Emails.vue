<template>
  <template v-if="forms != false && forms != null">
    <div>
      <div class="bg-white border border-t-0 rounded-b-lg min-h-4">
        <ul>
         <Rows v-for="row in forms" :key="row" :row="row"/>
        </ul>
      </div>
    </div>
  </template>
  <div v-if="forms == false" class="bg-white w-full  rounded-b-lg">

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="19" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.125s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="19" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.25s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.875s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="40" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.375s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="19" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.75s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="40" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.625s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect><rect x="61" y="61" width="20" height="20" fill="#3b82f6" style="animation-play-state: running; animation-delay: 0s;"><animate attributeName="fill" values="#b6cdf2;#3b82f6;#3b82f6" keyTimes="0;0.125;1" dur="1s" repeatCount="indefinite" begin="0.5s" calcMode="discrete" style="animation-play-state: running; animation-delay: 0s;"></animate></rect></svg>
  </div>
  <div v-if="forms == null" class="container mx-auto w-full py-10 flex flex-col items-center bg-white border border-t-0 rounded-b-lg ">
    <h2 class="flex items-center text-2xl font-semibold text-gray-600  tracking-wide mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>No Forms</h2>

    <p class="text-md font-semibold text-gray-500">Please create a form to customize the email settings.</p>
  </div>
</template>
<script setup>
import {ref} from 'vue';
import Rows from './Emails/Rows';

const forms  = ref(false);

const getForms = (function (){
  const data = new FormData();
  data.append('awraq_nonce',awraq_nonce);
  data.append('action','awraqGetFormHavingMeta');
  fetch(awraq_ajax_path,{
    method:'POST',
    credentials:'same-origin',
    body:data
  })
      .then(res => res.json())
      .then(res=>{
				forms.value = res;
				
      })
      .catch(err => console.log(res));
}());



</script>