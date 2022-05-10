<template>
<li class="drawer-row">
	<div class="drawer flex md:flex-row items-center justify-between">
		
		<div class="rounded-full border cursor-pointer flex flex-row items-center px-4 py-2 hover:text-blue-500" @click="deleteConfirmation">
			<svg xmlns="http://www.w3.org/2000/svg" class="inline  w-4 h-4 cursor-pointer  mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg> <span class=" font-semibold">Delete</span>
		</div>
		<div class="title w-4/12 ">
			<input class="w-full " type="text" v-model.trim="title" placeholder="Title"/>
		</div>
		
		<div class="w-4/12">
			<select name="contact7form" class="w-full" v-model.number="selectedFormOption">
				<option 
				v-for="option in allFormOptions" 
				v-bind:key="option.id" 
				v-bind:value="option.id" 
				v-bind:selected="selectedFormOption"
				>
				{{option.title}}
				</option>
			
			</select>
		</div>
		<div class="short-code  py-1  flex flex-row flex-wrap items-center ">
			<div class="flex flex-row justify-center">
				<span class="code px-4">{{row.sc}}</span >
			</div>
			
			<div class="flex flex-row justify-end">
				<span class="copy-button"><svg xmlns="http://www.w3.org/2000/svg" class="inline  w-5 h-6 cursor-pointer " v-on:click="copyToClipBoard" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg></span>
			</div>
			
		</div>
		<div class="rounded-full border cursor-pointer flex flex-row items-center px-1 py-1">
			<svg xmlns="http://www.w3.org/2000/svg" v-bind:class="drawerIconPosition !== false ? 'hover:cursor-pointer transform rotate-90   w-4 h-4':'hover:cursor-pointer w-4 h-4'"  v-on:click="openDrawer(); rotateIcon();" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
		</div>
	</div>
	<div v-show="drawerStatus === true" class="drawer-open">
		<Drawer 
			v-bind:drawerData="drawerData"  
			v-bind:formDrawerData="formDrawerData" 
			v-bind:drawerId="row.id" 
			v-on:send-data = "saveData" 
			v-on:delete-row = "emitDrawerId" 
			v-on:toogle-state = "toggleSate" 
			v-bind:state="state"
		/>
	</div>
</li>

</template>
<script>
import Drawer from './Row/Drawer'
import { useToast } from 'vue-toastification'
export default {
	name:'Row',
	props:{
		row:Object,
		
	},
	components:{
		Drawer
	},
	data: function(){
		return{
			codeToCopy :this.row.sc ,
			drawerStatus : false,
			drawerIconPosition:false,
			title:this.row.title ? this.row.title:'' ,
			drawerData:this.row.drawer,
			formDrawerData : this.row.formDrawer,
			selectedFormOption: this.row.fso.selected,
			allFormOptions: this.row.fso.options,

			/* States */
			state:{
				buttonCornersAndPadding:false,
				buttonText:false,
				buttonShadow:false,
				buttonColor:false,
				buttonBorder:false,
				buttonCssClass:false,
				formCornersAndPadding:false,
				formColor:false,
				formShadow:false,
				formCssClass:false,
				xButton:false,
				xButtonShadow:false,
				xButtonCssClass:false
			}
			

			
			
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
					
					const toast = useToast();
					toast("Copied to Clipboard");
				})
				.catch((err) => {
					this.emitNotification();
				})
			}
		
		},
		emitNotification: function(){
			//emit notification
		},
	
		emitDrawerId: function(drawerId){
			this.$emit('delete-row',drawerId);
		},
		toggleSate:function(statename){
			switch(statename){
				case "buttonCornersAndPadding":
					this.state.buttonCornersAndPadding = !this.state.buttonCornersAndPadding;
					break;
				case "buttonText":
					this.state.buttonText = !this.state.buttonText;
					break;
				case "buttonShadow":
					this.state.buttonShadow = !this.state.buttonShadow;
					break;
				case "buttonColor":
					this.state.buttonColor = !this.state.buttonColor;
					break;
				case "buttonBorder":
					this.state.buttonBorder = !this.state.buttonBorder;
					break;
				case "buttonCssClass":
					this.state.buttonCssClass = !this.state.buttonCssClass;
					break;
				case "formCornersAndPadding":
					this.state.formCornersAndPadding = !this.state.formCornersAndPadding;
					break;
				case "formColor":
					this.state.formColor = !this.state.formColor;
					break;
				case "formShadow":
					this.state.formShadow = !this.state.formShadow;
					break;
				case "formCssClass":
					this.state.formCssClass = !this.state.formCssClass;
					break;
				case "xButton":
					this.state.xButton = !this.state.xButton;
					break;
				case "xButtonShadow":
					this.state.xButtonShadow = !this.state.xButtonShadow;
					break;
				case "xButtonCssClass":
					this.state.xButtonCssClass = !this.state.xButtonCssClass;
					break;
				default:
					break;
			}
			
		},
		openDrawer: function(){
			this.drawerStatus = !this.drawerStatus;
		},
		rotateIcon: function(){
			this.drawerIconPosition = !this.drawerIconPosition;
			
		},
		saveData: function(drawerId,drawer,formDrawer){
			this.$emit('save-a-row',drawerId,this.title,this.selectedFormOption,drawer,formDrawer);
		},

		deleteConfirmation : function (){
			

			 if(confirm('ShortCode will get deleted Permanently')){
				this.emitDrawerId(this.row.id);
			 }
			 
		}
		

	}
}

</script>