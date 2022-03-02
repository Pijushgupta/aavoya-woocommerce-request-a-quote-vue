<template>
<div class="w-full px-5 pt-5">
	<div class="container mx-auto ">
		<div class="flex flex-col">
			<Tab v-on:set-active-tab = "setActiveTab" v-bind:activeTab='loadTab'/>
			<Body v-bind:loadBody = 'loadTab'/>
		</div>
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

			loadTab:1
		}
	},
	methods:{
		setActiveTab: function (activeTab){
			this.loadTab = activeTab;
		}
	}

	
	
}
</script>