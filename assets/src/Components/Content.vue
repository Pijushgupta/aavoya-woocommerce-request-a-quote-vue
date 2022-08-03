<template>
<div class="w-full px-5 border-b mb-4 bg-white">
	<div class="container mx-auto ">
		<Tab v-on:set-active-tab = "setActiveTab" v-bind:activeTab='loadTab'/>
	</div>
</div>

<div class="w-full px-5">
	<div class="container mx-auto ">
		<Body v-bind:loadBody = 'loadTab'/>
	</div>
</div>
</template>
<script>
import Tab from './Content/Tab'
import Body from './Content/Body'
export default{
	name: 'Content',
	components:{
		Tab,
		Body
	},
	data: function() {
		return {

			loadTab:3
		}
	},
	methods:{
		setActiveTab: function (activeTab){
			this.loadTab = activeTab;
		}
	}

	
	
}
</script>