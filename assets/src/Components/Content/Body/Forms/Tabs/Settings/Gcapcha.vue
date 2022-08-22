<template>
  <!-- google Capcha keys -->
  <div class="w-full flex flex-col border   rounded-lg">
    <div class="px-4 py-3 border-b font-medium  flex flex-row items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 488 512" fill="currentColor"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>Capcha Settings</div>

    <div class="input-group px-4 mt-2">
      <label for="gsecretkey" class="font-medium ">Secret Key</label>
      <input id="gsecretkey" />
    </div>
    <div class="input-group px-4 ">
      <label for="gsitekey" class="font-medium ">Site Key</label>
      <input id="gsitekey" />
    </div>
    <div class=" pb-2 px-4 flex flex-row justify-end">
      <button class="rounded px-4 py-2 border mr-2 font-medium flex flex-row items-center justify-center" @click="test"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" /></svg>Check</button>
      <button class="rounded px-4 py-2 border  font-medium flex flex-row items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" /></svg>Save</button>
    </div>
  </div>
  <!-- google Capcha keys ends -->
</template>

<script setup>
  import {ref, onMounted} from "vue";
  //import grecaptcha from 'https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key';

  const  secretKey = ref('6LeYs8AUAAAAAN37UrOPC8KD1SIiCmJ-zBJl3xlw');
  const  siteKey = ref('6LeYs8AUAAAAAAWSgP2cttB_xgEhLSOx78cMG2DF');
  const googleToken = ref(false);

  function checkCaptchaKeys(){
    if(googleToken.value === false) return;
    const data = new FormData();
    data.append('awraq_nonce',awraq_nonce);
    data.append('action','awraqCheckCaptcha');
    data.append('secret',secretKey.value);
    data.append('token',googleToken.value);

    fetch(awraq_ajax_path,{
      method:'POST',
      credentials:'same-origin',
      body:data
    })
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(err => console.log(err));
  }

  function test(){
    grecaptcha.ready(function() {
      grecaptcha.execute(siteKey.value, {action: 'submit'}).then(function(token) {
        if(token){
          googleToken.value = token;
          checkCaptchaKeys();
        }
      });
    });
  }
  onMounted(()=>{
    if(siteKey.value){
      let capcha = document.createElement('script');
      capcha.setAttribute('src','https://www.google.com/recaptcha/api.js?render='+siteKey.value);
      document.head.appendChild(capcha);
    }
  })

</script>
