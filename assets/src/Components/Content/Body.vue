<template>
	<div class="">
		<div v-if="loadBody === 1" ><Shortcode/></div>
		<div v-if="loadBody === 2"><Woocommerce/></div>
		<div v-if="loadBody === 3"><Forms/></div>
		<div v-if="loadBody === 4"><Settings/></div>
	</div>
</template>
<script>
import Shortcode from './Body/Shortcode';
import Woocommerce from './Body/Woocommerce';
import Settings from './Body/Settings';
export default{
	name:'Body',
	components:{
		Shortcode,
		Woocommerce,
		Settings
	},
	props:{
		loadBody: Number
	},

}
</script>