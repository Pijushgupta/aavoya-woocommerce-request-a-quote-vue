<template>
	<div class="flex md:flex-row flex-wrap ">
		<div class="w-full flex flex-row flex-wrap justify-center py-10">
			<div class="w-1/2 flex flex-col justify-center">
				<div class="flex justify-center">
					<div v-html="cssProperties"></div>
					<button v-bind:id="buttonId">{{drawer.buttontext}}</button>
				</div>
			</div>
			<div class="w-1/2 flex justify-center">
				<div class="flex justify-center">
					<div v-html="formCssProperties"></div>
					<div class="h-96 w-64 border" v-bind:id="formId">
						
						<div class="w-full h-full bg-gray-300" >
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flex w-1/2 pr-2 mt-2">
			<div class="w-1/2 pr-2">
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full pb-2">
						<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Corners and Padding</label>
					</div>
					<div class="w-full flex flex-col mt-2">
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Corners</label>
								<span class="pill">{{drawer.corners}}</span>
							</div>
							
							<div class="w-full">
								<input type="range" min="0" max="100" name="corners" v-model.number="drawer.corners">
							</div>
						</div>
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding X</label>
								<span class="pill">{{drawer.paddingx}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="paddingx" v-model.number="drawer.paddingx">
							</div>
							
						</div>
						<div class="flex flex-col flex-wrap w-full justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding Y</label>
								<span class="pill">{{drawer.paddingy}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="paddingy" v-model.number="drawer.paddingy">
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="flex flex-row flex-wrap w-full rounded mt-2 p-2 shadow">
					<div class="w-full pb-2">
						<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Text</label>
					</div>
					<div class="flex flex-col w-full mt-2  justify-between">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Tracking</label>
								<span class="pill">{{drawer.letterspacing}}</span>
						</div>
						<div class="w-full">
							<input type="range" min="0" max="100" name="letterspacing" v-model.number="drawer.letterspacing">
						</div>
					</div>
					<div class="flex flex-col w-full mt-2  justify-between">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Size</label>
								<span class="pill">{{drawer.fontsize}}</span>
						</div>
						<div class="w-full">
							<input type="range" min="8" max="80" name="fontsize" v-model.number="drawer.fontsize">
						</div>
					</div>
					<div class="flex flex-col mt-2 w-full  justify-between">
						<label class="label ">Weight</label>
						<select v-model.number="drawer.fontweight" class="rounded">
							<option v-for="fontWeight in fontWeights" v-bind:key="fontWeight.value" v-bind:value="fontWeight.value" v-bind:selected="drawer.fontweight">{{fontWeight.text}}</option>			
						</select>
					</div>
					<div class="flex flex-col w-full mt-2 pt-2 justify-between">
						<label class="label ">Button Text</label>
						<input type="text" name="buttontext" v-model="drawer.buttontext" class="rounded">
					</div>
				</div>

				<div class="flex flex-col mt-2 p-2 rounded shadow justify-between">
					<label class="label ">Css Class(Optional)</label>
					<input type="text" name="cssclassname" v-model="drawer.cssclassname" class="rounded">
				</div>
				
			</div>
			<div class="w-1/2 ">

			<div class="flex flex-row flex-wrap w-full rounded p-2 mt-2  shadow">
				<div class="w-full pb-2">
					<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Colours</label>
				</div>
				<div class="flex flex-col w-1/2 justify-between mt-2 pr-2">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
						<label class="label ">Background</label>
						<span class="pill">{{drawer.backgroundcolor}}</span>
					</div>
					<div class="w-full">
						<input type="color"  name="backgroundcolor" v-model="drawer.backgroundcolor">
					</div>
				</div>
				<div class="flex flex-col w-1/2 justify-between mt-2">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
						<label class="label ">Text</label>
						<span class="pill">{{drawer.textcolor}}</span>
					</div>
					<div class="w-full">
						<input type="color" name="textcolor" v-model="drawer.textcolor">
					</div>
				</div>
				<div class="flex flex-col w-1/2 justify-between mt-2 pr-2">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
						<label class="label ">Background Hover</label>
						<span class="pill">{{drawer.hoverbackgroundcolor}}</span>
					</div>
					<div class="w-full">
						<input type="color"  name="hoverbackgroundcolor" v-model="drawer.hoverbackgroundcolor">
					</div>
				</div>
				<div class="flex flex-col w-1/2 justify-between mt-2">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
						<label class="label ">Text Hover</label>
						<span class="pill">{{drawer.hovertextcolor}}</span>
					</div>
					<div class="w-full">
						<input type="color" name="hovertextcolor" v-model="drawer.hovertextcolor">
					</div>
				</div>

			</div>
			<div class="flex flex-col flex-wrap w-full rounded p-2 mt-2  shadow">
				<div class="w-full flex flex-row justify-between  pb-2">
					
					<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Border</label>
				
					<div class="w-1/2 flex flex-row justify-end"><input type="checkbox" name="bordertab" v-model="drawer.bordertab"/></div>
				</div>
				<div class="w-full flex flex-row flex-wrap">
					<div class="w-full flex flex-col mt-2">
						<div class="w-full flex flex-col mb-2 justify-between">
							<label class="label">Border Type</label>
							<select v-model="drawer.bordertype">
								<option v-for="borderType in borderTypes" v-bind:value="borderType.value" v-bind:key="borderType.value" v-bind:selected="drawer.bordertype">{{borderType.text}}</option>
							</select>
						</div>
						<div class="w-1full flex flex-col mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Border</label>
								<span class="pill">{{drawer.borderwidth}}</span>
							</div>
							<div class="w-full">
							<input type="range" min="0" max="100" name="border" v-model.number="drawer.borderwidth">
							</div>
						</div>	
						<div class="w-full flex flex-col justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Border Color</label>
								<span class="pill">{{drawer.bordercolor}}</span>
							</div>
							<div class="w-full">
								<input type="color" min="0" max="100" name="bordercolor"  v-model="drawer.bordercolor">
							</div>
						</div>
					</div>
					<div class="w-full flex flex-col mt-2 ">
						<div class="w-full flex flex-col mb-2 justify-between">
							<label class="label">Hover Border Type</label>
							<select v-model="drawer.hoverbordertype">
								<option v-for="hoverBorderType in hoverBorderTypes" v-bind:value="hoverBorderType.value" v-bind:key="hoverBorderType.value" v-bind:selected="drawer.hoverbordertype" >{{hoverBorderType.text}}</option>
							</select>
						</div>
						<div class="w-full flex flex-col mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Hover Border</label>
								<span class="pill">{{drawer.hoverborderwidth}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="border" v-model.number="drawer.hoverborderwidth">
							</div>
						</div>	
						<div class="w-full flex flex-col justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Hover Border Color</label>
								<span class="pill">{{drawer.hoverbordercolor}}</span>
							</div>
							<div class="w-full">
									<input type="color" min="0" max="100" name="bordercolor"  v-model="drawer.hoverbordercolor">
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			</div>
		</div>
		<div class="w-1/2 mt-2 flex flex-row flex-wrap">
			<div class="w-1/2 pr-2">
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full pb-2">
						<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Corners and Padding</label>
					</div>
					<div class="w-full flex flex-col mt-2">
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Corners</label>
								<span class="pill">{{formDrawer.corners}}</span>
							</div>
							
							<div class="w-full">
								<input type="range" min="0" max="100" name="corners" v-model.number="formDrawer.corners">
							</div>
						</div>
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding X</label>
								<span class="pill">{{formDrawer.paddingx}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="paddingx" v-model.number="formDrawer.paddingx">
							</div>
							
						</div>
						<div class="flex flex-col flex-wrap w-full justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding Y</label>
								<span class="pill">{{formDrawer.paddingy}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="paddingy" v-model.number="formDrawer.paddingy">
							</div>
						</div>
					</div>
					
				</div>

			</div>	
			<div class="w-1/2">
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full pb-2">
						<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Background Colour</label>
						
					</div>
					<div class="w-full flex flex-col mt-2">
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Colour</label>
								<span class="pill">{{formDrawer.bgcolor}}</span>
							</div>
							
							<div class="w-full">
								<input type="color" v-model.number="formDrawer.bgcolor">
							</div>
						</div>
					</div>
				</div>
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full pb-2">
						<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">X Button</label>
						
					</div>
					<div class="w-full flex flex-col mt-2">
						<div class="flex flex-col  w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Button Position</label>
								<span class="pill">{{formDrawer.btpossition}}</span>
							</div>
							
							<div class="w-full">
								
								<select v-model="formDrawer.btpossition">
									<option>Top Right</option>
									<option>Top Left</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="w-full  flex flex-row justify-end mt-5 ">
			<div class="flex flex-row justify-between">
				<button class="bg-red-700  px-4 py-2 text-white rounded font-semibold capitalize mr-2 flex items-center" v-on:click="$emit('delete-row',drawerId)">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
					Delete
				</button>
				<button class="bg-blue-800 px-4 py-2 text-white rounded font-semibold capitalize flex items-center" v-on:click="$emit('save-drawer',drawer,drawerId)">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" /></svg>	
					Save
				</button>
			</div>
			
		</div> 
	</div>
</template>
<script>


export default{
	name:'Drawer',
	props:{
		drawerData:Object,
		drawerId:Number
	},
	data: function(){
		return {
				drawer:{},
				formDrawer:{},
				cssProperties:'',
				formCssProperties:'',
				buttonId:'liveExample' + this.drawerId,
				formId:'formLiveExample' + this.drawerId,
				fontWeights:[
					{value:100,text:100},
					{value:200,text:200},
					{value:300,text:300},
					{value:400,text:400},
					{value:500,text:500},
					{value:600,text:600},
					{value:700,text:700},
					{value:800,text:800},
					{value:900,text:900}
					],
				borderTypes:[
					{value:"none",text:"none"},
					{value:"Dotted",text:"Dotted"},
					{value:"Dashed",text:"Dashed"},
					{value:"Solid",text:"Solid"},
					{value:"Double",text:"Double"},
					{value:"Groove",text:"Groove"},
					{value:"Ridge",text:"Ridge"},
					{value:"Inset",text:"Inset"},
					{value:"Outset",text:"Outset"},
					{value:"Hidden",text:"Hidden"},
				],
				hoverBorderTypes:[
					{value:"none",text:"none"},
					{value:"Dotted",text:"Dotted"},
					{value:"Dashed",text:"Dashed"},
					{value:"Solid",text:"Solid"},
					{value:"Double",text:"Double"},
					{value:"Groove",text:"Groove"},
					{value:"Ridge",text:"Ridge"},
					{value:"Inset",text:"Inset"},
					{value:"Outset",text:"Outset"},
					{value:"Hidden",text:"Hidden"},
				]
			}
	},
	watch: {
		drawer : {
			handler: function (oldVal,newVal){
				this.createCss(newVal);
			},
			deep:true
			
		},
		formDrawer:{
			handler: function(oldVal,newVal){
				this.createFormCss(newVal);
			},
			deep:true
		}
	},
	created:function(){
		this.drawer = {
			corners: this.drawerData.corners ? this.drawerData.corners : 0,
			paddingx: this.drawerData.paddingX ? this.drawerData.paddingX: 0,
			paddingy: this.drawerData.paddingY ? this.drawerData.paddingY: 0,
			letterspacing: this.drawerData.letterSpacing ? this.drawerData.letterSpacing : 0,
			fontsize: this.drawerData.fontSize ? this.drawerData.fontSize : 0,
			fontweight:this.drawerData.fontWeight ? this.drawerData.fontWeight : 300,
			buttontext: this.drawerData.buttonText ? this.drawerData.buttonText : "AWRAQ",
			cssclassname: this.drawerData.cssClass ? this.drawerData.cssClass : "aavoya",
			backgroundcolor: this.drawerData.backgroundColor ? this.drawerData.backgroundColor : "#FF0000",
			textcolor: this.drawerData.textColor ? this.drawerData.textColor : "#ffffff",
			hoverbackgroundcolor: this.drawerData.hoverBackgroundColor ? this.drawerData.hoverBackgroundColor : "#e5e7eb",
			hovertextcolor: this.drawerData.hoverTextColor ? this.drawerData.hoverTextColor  : "#ffffff",
			bordertab: this.drawerData.borderTab ? this.drawerData.borderTab : false,
			bordertype: this.drawerData.borderType ? this.drawerData.borderType : "none",
			borderwidth: this.drawerData.borderWidth ? this.drawerData.borderWidth : 0,
			bordercolor: this.drawerData.borderColor ? this.drawerData.borderColor : '#00FFFFFF',
			hoverbordertype: this.drawerData.hoverBorderType ? this.drawerData.hoverBorderType: "none",
			hoverborderwidth: this.drawerData.hoverBorderWidth ? this.drawerData.hoverBorderWidth: 0,
			hoverbordercolor: this.drawerData.hoverBorderColor ? this.drawerData.hoverBorderColor : "#00FFFFFF"
		}
		this.createCss(this.drawer);

		this.formDrawer = {
			corners:8,
			paddingx:4,
			paddingy:2,
			bgcolor:"#ececec",
			btpossition:"top-right"
		}
		this.createFormCss(this.formDrawer);
	},
	methods:{
		createCss: function (css){

			let border = 'none';
			if(css.bordertype !== 'none' && css.bordertab !== false){
				border = `${css.borderwidth}px ${css.bordertype} ${css.bordercolor}`;
			}

			let borderHover = 'none';
			if(css.hoverbordertype !== 'none' && css.bordertab !== false){
				borderHover = `${css.hoverborderwidth}px ${css.hoverbordertype} ${css.hoverbordercolor}`;
			}

			this.cssProperties = `<style>
			#${this.buttonId}{
				border-radius:${css.corners}px;
				padding:${css.paddingy}px ${css.paddingx}px;
				letter-spacing:${css.letterspacing}px; 
				font-size:${css.fontsize}px;
				font-weight:${css.fontweight};
				background-color:${css.backgroundcolor}; 
				color:${css.textcolor};
				border:${border};
				}
			#${this.buttonId}:hover{
				background-color:${css.hoverbackgroundcolor};
				color:${css.hovertextcolor};
				border:${borderHover};
			}	
				</style>`;
			
		},
		createFormCss: function(css){
			this.formCssProperties = `<style>
			#${this.formId}{
				border-radius:${css.corners}px;
				padding:${css.paddingy}px ${css.paddingx}px;
				background-color:${css.bgcolor} 
			}
			</style>`;
		}
	}
}
</script>
