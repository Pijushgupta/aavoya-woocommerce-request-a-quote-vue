<template>
	<div class="bg-gray-50 p-4 rounded-lg ">
		<div v-if="loadBody === 1" ><Shortcode/></div>
		<div v-if="loadBody === 2"><Woocommerce/></div>
		<div v-if="loadBody === 3"><Settings/></div>
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