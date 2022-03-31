<template>
<!-- This to show Woocommerce row -->
	<div v-if="hasWoo !== 1">
		<Nocommerce/>
	</div>
	<div v-else>
		<Tabs/>
	</div>
<!-- ends -->

</template>
<script>
import Nocommerce from './Load/Nocommerce.vue'
import Tabs from './Load/Tabs.vue'
export default {
	name:'Load',
	components:{
		Nocommerce,
		Tabs,
	},
	data: function(){
		return {
			hasWoo : parseInt(has_woo),
			
		}
	},
	
	

}
</script>


