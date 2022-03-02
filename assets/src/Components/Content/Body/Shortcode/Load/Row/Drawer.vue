<template>
	<div class="flex md:flex-row flex-wrap ">
		<div class="w-full flex flex-row justify-center py-10">
			<div v-html="cssProperties"></div>
			<button v-bind:id="buttonId">{{drawer.buttontext}}</button>
		</div>
		<div class="w-1/2 pr-2 mt-2">
			<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
				<div class="w-full pb-2">
					<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Corners and Padding</label>
				</div>
				<div class="w-full flex flex-row flex-wrap mt-2 h-10">
					<div class="flex flex-col flex-wrap w-1/3 pr-2 justify-between">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Corners</label>
							<span class="pill">{{drawer.corners}}</span>
						</div>
						
						<div class="w-full">
							<input type="range" min="0" max="100" name="corners" v-model="drawer.corners">
						</div>
					</div>
					<div class="flex flex-col flex-wrap w-1/3 pr-2 justify-between">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Padding X</label>
							<span class="pill">{{drawer.paddingx}}</span>
						</div>
						<div class="w-full">
							<input type="range" min="0" max="100" name="paddingx" v-model="drawer.paddingx">
						</div>
						
					</div>
					<div class="flex flex-col flex-wrap w-1/3 justify-between">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Padding Y</label>
							<span class="pill">{{drawer.paddingy}}</span>
						</div>
						<div class="w-full">
							<input type="range" min="0" max="100" name="paddingy" v-model="drawer.paddingy">
						</div>
					</div>
				</div>
				
			</div>
			
			
			<div class="flex flex-row flex-wrap w-full rounded mt-2 p-2 shadow">
				<div class="w-full pb-2">
					<label class="px-4 py-1 bg-gray-200 rounded-full font-semibold">Text</label>
				</div>
				<div class="flex flex-col w-1/3 mt-2 pr-2 justify-between">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Tracking</label>
							<span class="pill">{{drawer.letterspacing}}</span>
					</div>
					<div class="w-full">
						<input type="range" min="0" max="100" name="letterspacing" v-model="drawer.letterspacing">
					</div>
				</div>
				<div class="flex flex-col w-1/3 mt-2 pr-2 justify-between">
					<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Size</label>
							<span class="pill">{{drawer.fontsize}}</span>
					</div>
					<div class="w-full">
						<input type="range" min="8" max="80" name="fontsize" v-model="drawer.fontsize">
					</div>
				</div>
				<div class="flex flex-col mt-2 w-1/3  justify-between">
					<label class="label ">Weight</label>
					<select v-model="drawer.fontweight" class="rounded">
						<option>100</option>
						<option>200</option>
						<option>300</option>
						<option>400</option>
						<option>500</option>
						<option>600</option>
						<option>700</option>
						<option>800</option>
						<option>900</option>
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
		
		<div class="w-1/2 mt-2">

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
					<div class="w-full flex flex-row my-2">
						<div class="w-1/3 flex flex-col md:pr-2 justify-between">
							<label class="label">Border Type</label>
							<select v-model="drawer.bordertype">
								<option selected>None</option>
								<option>Dotted</option>
								<option>Dashed</option>
								<option>Solid</option>
								<option>Double</option>
								<option>Groove</option>
								<option>Ridge</option>
								<option>Inset</option>
								<option>Outset</option>
								<option>Hidden</option>
							</select>
						</div>
						<div class="w-1/3 flex flex-col md:pr-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Border</label>
								<span class="pill">{{drawer.borderwidth}}</span>
							</div>
							<div class="w-full">
							<input type="range" min="0" max="100" name="border" v-model="drawer.borderwidth">
							</div>
						</div>	
						<div class="w-1/3 flex flex-col justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Border Color</label>
								<span class="pill">{{drawer.bordercolor}}</span>
							</div>
							<div class="w-full">
								<input type="color" min="0" max="100" name="bordercolor"  v-model="drawer.bordercolor">
							</div>
						</div>
					</div>
					<div class="w-full flex flex-row mt-2 my-2">
						<div class="w-1/3 flex flex-col md:pr-2 justify-between">
							<label class="label">Hover Border Type</label>
							<select v-model="drawer.hoverbordertype">
								<option selected>None</option>
								<option>Dotted</option>
								<option>Dashed</option>
								<option>Solid</option>
								<option>Double</option>
								<option>Groove</option>
								<option>Ridge</option>
								<option>Inset</option>
								<option>Outset</option>
								<option>Hidden</option>
							</select>
						</div>
						<div class="w-1/3 flex flex-col md:pr-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Hover Border</label>
								<span class="pill">{{drawer.hoverborderwidth}}</span>
							</div>
							<div class="w-full">
								<input type="range" min="0" max="100" name="border" v-model="drawer.hoverborderwidth">
							</div>
						</div>	
						<div class="w-1/3 flex flex-col justify-between">
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
				cssProperties:'',
				buttonId:'liveExample' + this.drawerId,

			}
	},
	watch: {
		drawer : {
			handler: function (oldVal,newVal){
				this.createCss(newVal);
			},
			deep:true,
			
		}
	},
	created:function(){
		this.drawer = {
					corners: this.drawerData.corners ? this.drawerData.corners : 0,
					paddingx: this.drawerData.paddingX ? this.drawerData.paddingX: 0,
					paddingy: this.drawerData.paddingY ? this.drawerData.paddingY: 0,
					letterspacing: this.drawerData.letterSpacing ? this.drawerData.letterSpacing : 0,
					fontsize: this.drawerData.fontSize ? this.drawerData.fontSize : 0,
					fontweight:this.drawerData.fontweight ? this.drawerData.fontweight : 300,
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
			
		}
	}
}
</script>
