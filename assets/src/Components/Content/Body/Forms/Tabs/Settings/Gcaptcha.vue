<template>
  <!-- google Capcha keys -->
  <div class="w-full flex flex-col border   rounded-lg">
    <div class="px-4 py-3 border-b font-medium  flex flex-row items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 488 512" fill="currentColor"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>Capcha Settings</div>

    <div class="input-group px-4 mt-2">
      <label for="gsecretkey" class="font-medium ">Secret Key</label>
      <input id="gsecretkey" v-model="keys.secretKey"/>
    </div>
    <div class="input-group px-4 ">
      <label for="gsitekey" class="font-medium ">Site Key</label>
      <input id="gsitekey" v-model="keys.siteKey"/>
    </div>
    <div class=" pb-2 px-4 flex flex-row justify-end">
      <button v-bind:disabled="verificationLock" class="disabled:opacity-30 rounded px-4 py-2 border mr-2 font-medium flex flex-row items-center justify-center" @click="check"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" /></svg>Check</button>
      <button v-bind:disabled="statusOk === false" class="disabled:opacity-30 rounded px-4 py-2 border  font-medium flex flex-row items-center justify-center" @click="saveKeys"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" /></svg>Save</button>
    </div>
  </div>
  <!-- google Capcha keys ends -->
</template>

<script setup>
	import { ref, watch } from "vue";
	import _ from 'lodash';
	import { useToast } from 'vue-toastification';

	const keys = ref({ secretKey: '', siteKey: '' });
	const verificationLock = ref(true);
	const intervalId = ref(null);
	const recapchaLoaded = ref(false);
	const googleToken = ref(false);
  const statusOk = ref(false);
//()=>_.cloneDeep(keys.value)
	watch(keys, (currentValue, oldValue)=>{
		if(oldValue.secretKey == '' || oldValue.siteKey==''){
			return;
		}

		if (verificationLock.value == true) {
			verificationLock.value = false;
		}
    statusOk.value = false;
		
	},{deep:true});
	watch(recapchaLoaded,(newVal, oldval)=>{
		clearInterval(intervalId.value);
	});

  /**
   * This method to save site key and secrect key to the Database
   */
  function saveKeys(){


    if(googleToken.value === false) return;
    if(statusOk.value === false) return;

    const data = new FormData();
    data.append('awraq_nonce',awraq_nonce);
    data.append('action','awraqSetCaptchaKeys');
    data.append('secretKey',keys.value.secretKey);
    data.append('siteKey',keys.value.siteKey);

    fetch(awraq_ajax_path,{
      method:'POST',
      credentials:'same-origin',
      body:data
    })
        .then(res=> res.json())
        .then(res => {
          if(res === true){
            const toast = useToast();
            toast("Saved");

          }
        })
        .catch(err => console.log(err))
  }

	/**
	 * Sending AJAX request to server to validate client side token generated from site key
	 * with Secret key.
	 */
	function checkCaptchaKeys() {
		if(googleToken.value === false) return;
		const data = new FormData();
		data.append('awraq_nonce',awraq_nonce);
		data.append('action','awraqCheckCaptcha');
		data.append('secret',keys.value.secretKey);
		data.append('token',googleToken.value);

		fetch(awraq_ajax_path,{
			method:'POST',
			credentials:'same-origin',
			body:data
		})
			.then(res => res.json())
			.then(res => { 
				verificationLock.value = true;
				res = JSON.parse(res);
				const toast = useToast();
				if (res.success === true) {
					toast("Keys are Valid");
				}
				if (res.success === false) {
					toast("Invalid Key(s)");
				}
				verificationLock.value = true;
        statusOk.value = true;
			})
			.catch(err => console.log(err));
	}
	
	/**
	 * Setting the token from google via client side script
	 * to local variable. 
	 * if site key is invalid it output error in the console/notification
	 * And then calling the method checkCaptchaKeys for server-side verification.
	 */
	function setToken() {
			grecaptcha.ready(function () {
				try {
					grecaptcha.execute(keys.value.siteKey, {action: 'submit'}).then(function(token) {
					if(token){
						googleToken.value = token;
						checkCaptchaKeys();
					}
				});
				}
				catch (err) {
					const toast = useToast();
					toast("Invalid Site key");
					
				}
				
			});
	}
	
	/**
	 * This append google recaptcha client side script 
	 * to the current DOM
	 * Note: It will not output any errors regarding site key error
	 */
	function appendScript(){
		if (keys.value.siteKey) {
			try {
				document.querySelector('#awraqCaptchaScript').remove;
			}
			catch (err) {
				//don't do anything 
			}
			let captcha = document.createElement('script');
			captcha.setAttribute('src', 'https://www.google.com/recaptcha/api.js?render=' + keys.value.siteKey);
			captcha.setAttribute('id', 'awraqCaptchaScript');
			document.head.appendChild(captcha);
			
		}
	}
	
	/**
	 * This method Appending google recaptcha client side script 
	 * Waiting for google script to load. (setInterval and vue's watch for same).
	 * After loading (confirmed by window.grecaptcha) calling 
	 * setToken(may output error if site key is invalid) method 
	 * to set the googles client side token. 
	 */
	function check() {
	if (verificationLock.value == true) return;
		appendScript();
		intervalId.value = setInterval(function () { 
			if (window.grecaptcha) {
				recapchaLoaded.value = !recapchaLoaded.value; 
				setToken();
			}
		}, 500);
	}
	
	/**
	 * getting site key and secret key
	 * Firing on Load, automatically 
	 * Not invoking other method 
	 */
	const getKeys = (function () {
		const data = new FormData();
		data.append('awraq_nonce', awraq_nonce);
		data.append('action', 'awraqGetCaptchaKeys');
		fetch(awraq_ajax_path, {
			method: 'POST',
			credentials: 'same-origin',
			body: data
		})
			.then(res => res.json())
			.then(res => {
				if (res !== false) {
					keys.value.secretKey = res.secretKey;
					keys.value.siteKey = res.siteKey;
				} else {
					keys.value.secretKey = false;
					keys.value.siteKey = false;
				}
			})
			.catch(err => console.log(err));

	}());

</script>
