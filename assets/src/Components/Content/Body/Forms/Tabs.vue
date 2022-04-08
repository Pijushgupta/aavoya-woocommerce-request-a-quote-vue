<template>
<div>
  <div class="bg-white border border-b-0 rounded-t-lg">
	  <ul class="flex md:flex-row justify-start font-semibold  border-b">
			<li @click="changeTab(1)" v-bind:class="activeTab === 1 ? 'sub-tab sub-tab-active ':'sub-tab sub-tab-inactive'">
				<a><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Forms</a>
			</li>
			<li @click="changeTab(2)" v-bind:class="activeTab === 2 ? 'sub-tab sub-tab-active ':'sub-tab sub-tab-inactive'">
				<a><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
				Entries</a>
			</li>
			
		</ul>
		
	</div>
	<div v-if="activeTab === 1">
		<Forms/>
	</div>
	<div v-if="activeTab === 2">
		<Entries/>
	</div>
</div>
</template>

<script>
import Forms from './Tabs/Forms.vue';
import Entries from './Tabs/Entries.vue';
export default {
	name:'Tabs',
	components:{
		Forms,
		Entries
	},
	data: function(){
		return {
			activeTab: 1
		}
	},
	methods:{
	changeTab : function (tab){
		this.activeTab = parseInt(tab);
		}
	}
}
</script>

<style>
</style>