import { createApp } from 'vue';
import Toast from "vue-toastification";
import App from './App.vue';



import "vue-toastification/dist/index.css";

const toastOption = {
	transition: "Vue-Toastification__fade",
	maxToasts: 20,
	timeout: 1048,
	hideProgressBar: false,
	newestOnTop: true,
	position: 'bottom-right',
	toastClassName: 'awraq-toast',
} 

createApp(App)
	.use(Toast, toastOption)
	
	.mount('#awraq-root');