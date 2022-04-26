<template>
<div>
  <div class="bg-white border border-b-0 rounded-t-lg">
	  <ul class="flex md:flex-row justify-start font-semibold  border-b">
			<li @click="changeTab(1)" v-bind:class="activeTab === 1 ? 'sub-tab sub-tab-active ':'sub-tab sub-tab-inactive'">
				<a><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Forms</a>
			</li>
			<li @click="changeTab(2)" v-bind:class="activeTab === 2 ? 'sub-tab sub-tab-active ':'sub-tab sub-tab-inactive'">
				<a><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z" clip-rule="evenodd" /></svg>Emails</a>
			</li>
			<li @click="changeTab(3)" v-bind:class="activeTab === 3 ? 'sub-tab sub-tab-active ':'sub-tab sub-tab-inactive'">
				<a><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
				Entries</a>
			</li>
			
		</ul>
		
	</div>
	<div v-if="activeTab === 1">
		<Forms/>
	</div>
	<div v-if="activeTab === 2">
		<Emails/>
	</div>
	<div v-if="activeTab === 3">
		<Entries/>
	</div>
</div>
</template>

<script>
import Forms from './Tabs/Forms.vue';
import Entries from './Tabs/Entries.vue';
import Emails from './Tabs/Emails.vue';
export default {
	name:'Tabs',
	components:{
		Forms,
		Emails,
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