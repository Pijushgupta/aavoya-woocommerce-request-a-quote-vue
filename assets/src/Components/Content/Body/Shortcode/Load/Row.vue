<template>
<div class="drawer-row">
	<div class="drawer flex md:flex-row justify-between items-center ">
		
		<div class="title w-2/5 pr-2">
			<input class="w-full " name="title" type="text" v-model.trim="title" placeholder="Title"/>
		</div>
		<div class="short-code w-1/5">
			<span class="code">[awraq id="{{row.id}}"]</span >
			<span><svg xmlns="http://www.w3.org/2000/svg" class="inline  w-5 h-5 cursor-pointer " v-on:click="copyToClipBoard" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg></span>
		</div>
		<div class="w-1/5">
			<select name="contact7form" class="w-full" v-model="selectedFormOption">
				<option v-for="option in allFormOptions" v-bind:key="option.id" v-bind:value="option.id" v-bind:selected="selectedFormOption">{{option.title}}</option>
			
			</select>
		</div>
		<div>
			<svg xmlns="http://www.w3.org/2000/svg" v-bind:class="drawerIconPosition !== false ? 'h-5 w-5 hover:cursor-pointer transform rotate-90':'h-5 w-5 hover:cursor-pointer'"  v-on:click="openDrawer(); rotateIcon();" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
		</div>
	</div>
	<div v-show="drawerStatus === true" class="drawer-open">
		<Drawer v-bind:drawerData="drawerData" v-bind:drawerId="row.id" v-on:save-drawer = "emitDrawer" v-on:delete-row = "emitDrawerId"/>
	</div>
</div>

</template>
<script>
import Drawer from './Row/Drawer'
export default {
	name:'Row',
	props:{
		row:Object
	},
	components:{
		Drawer
	},
	data: function(){
		return{
			codeToCopy :'[awraq id="' + this.row.id +'"]' ,
			drawerStatus : false,
			drawerIconPosition:false,
			title:this.row.title ? this.row.title:'' ,
			drawerData:this.row.drawer,
			selectedFormOption: this.row.fso.selected,
			allFormOptions: this.row.fso.options
		}
	},
	methods:{
		copyToClipBoard: function(){
			let toClipBoard = this.codeToCopy;
			if(!navigator.clipboard){
				toClipBoard.select();
				document.execCommand("copy");
			}
			else{
				navigator.clipboard.writeText(toClipBoard).then(()=>{
					
					this.emitNotification();
				})
				.catch((err) => {
					this.emitNotification();
				})
			}
		
		},
		emitNotification: function(){
			//emit notification
		},
		emitDrawer: function(drawer,drawerId){
			this.$emit('save-drawer',drawer,drawerId);
		},
		emitDrawerId: function(drawerId){
			this.$emit('delete-row',drawerId);
		},
		openDrawer: function(){
			this.drawerStatus = !this.drawerStatus;
		},
		rotateIcon: function(){
			this.drawerIconPosition = !this.drawerIconPosition;
			
		}
	}
}

</script>