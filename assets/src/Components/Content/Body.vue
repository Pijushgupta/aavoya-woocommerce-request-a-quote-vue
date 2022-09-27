<template>
	<div class="">
		<div v-if="loadBody === 1" ><Shortcode/></div>
		<div v-if="loadBody === 2"><Woocommerce/></div>
		<div v-if="loadBody === 3"><Forms/></div>
		<div v-if="loadBody === 4"><Settings/></div>
		<div v-if="loadBody === 5"><Help/></div>
	</div>
</template>
<script>
import Shortcode from './Body/Shortcode';
import Woocommerce from './Body/Woocommerce';
import Forms from './Body/Forms.vue';
import Settings from './Body/Settings';
import Help from './Body/Help';
export default{
	name:'Body',
	components:{
		Shortcode,
		Woocommerce,
		Forms,
		Settings,
		Help
	},
	props:{
		loadBody: Number
	},

}
</script>