<template>
	<div class="bg-white border rounded-lg">
		<ul class="flex md:flex-row justify-start font-semibold  border-b">
			<li @click="changeTab(1)" v-bind:class="activeTab === 1 ? 'sub-tab sub-tab-active':'sub-tab sub-tab-inactive'">
				<svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-orange-600 " viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
				Products
			</li>
			<li @click="changeTab(2)" v-bind:class="activeTab === 2 ? 'sub-tab sub-tab-active':'sub-tab sub-tab-inactive'">
				<svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-pink-600 " viewBox="0 0 20 20" fill="currentColor"><path d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" /></svg>
				Categories
			</li>
			<li @click="changeTab(3)" v-bind:class="activeTab === 3 ? 'sub-tab sub-tab-active':'sub-tab sub-tab-inactive'">
				<svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-red-600 " viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
				Tags
			</li>
		</ul>
		<div>
			<!-- products row -->
			<div v-if="activeTab == 1">
				<Products/>
			</div>
			<!-- products row ends -->
			
			<!-- Categories Area -->
			<div v-if="activeTab == 2">
				<Categories/>
			</div>
			<!-- Categories Area Ends -->

			<!-- Tab Area -->
			<div v-if="activeTab == 3">
				<Tags/>
			</div>
			<!-- Tab Area Ends -->
		</div>
	</div>
</template>
<script>
import Products from './Tabs/Products.vue';
import Categories from './Tabs/Categories.vue';
import Tags from './Tabs/Tags.vue';

	export default {
		name : 'Tabs',
		components:{
			Products,
			Categories,
			Tags
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