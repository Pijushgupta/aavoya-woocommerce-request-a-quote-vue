<template>
  <li class="border-b last:border-b-0   mb-0">
	  <div class="form-row flex flex-row justify-between items-center px-4 py-2">

		  <div class="w-6/12">
			  <span  class="w-full font-semibold">{{localRow.title ? localRow.title : 'Untitled Form'}}</span>
		  </div>
		  <div class="w-6/12 flex flex-row justify-end items-center ">
		  	<div class="border rounded inline px-1 py-1 mr-4">
				<div class="flex flex-row justify-center items-center ">
			  		<span class="px-6 font-semibold">[awraqf id="{{localRow.ID}}"]</span>
					<span class="bg-gray-100 px-1 rounded shadow "><svg xmlns="http://www.w3.org/2000/svg" class="inline  w-5 h-6 cursor-pointer " v-on:click="copyToClipBoard" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg></span>
				</div>

			</div>
			<div class="flex flex-row justify-center items-center">
			  <div class="rounded-full border  cursor-pointer  px-1 py-1 ">
				<svg xmlns="http://www.w3.org/2000/svg" v-bind:class="drawerIconPosition !== false ? 'hover:cursor-pointer transform rotate-90   w-4 h-4':'hover:cursor-pointer w-4 h-4'"  v-on:click="openDrawer(); rotateIcon();" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
			</div>
		  </div>
		</div>


	  </div>
	  <div class="form-row-opened border-t   flex flex-row" v-show="drawerOpen">
		  <div class="w-full flex flex-row">
			  <div class="leftbar w-2/12 border-r flex flex-col p-4">

				<!-- DRAG AREA -->
				<draggable v-bind:list='inputs' v-bind:group='draggableGroup' animation=100 tag="ul" v-bind:clone="onClone">

					<template #item="{element}">

						<li class="px-2 py-2 border cursor-move mb-2 rounded last:mb-0 font-semibold ">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline" viewBox="0 0 20 20" fill="currentColor"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" /></svg>
							{{element.name}}
						</li>

					</template>

				</draggable>
				<!-- DRAG AREA ENDS -->
			  </div>
			  <div class="rightbar w-10/12 flex flex-col items-center m-4 rounded border items-center relative">

				  	<div class="px-4 py-4 border-b bg-gray-50 w-full">
						<input class="w-full border rounded" type="text" v-model='localRow.title'/>
					</div>

					<div  style="min-height:260px;" v-bind:class="emptyInputs.length == 0 ? 'md:w-6/12 m-2 rounded bg-gray-50 border border-dashed border-4 ':'md:w-6/12 m-2 rounded '">

					<!-- DROP AREA -->
					<draggable v-model='emptyInputs' :group='draggableGroupEmpty' animation=100 tag="ul" class="p-2 min-h-full" >
						<template #item="{element,index,newIndex}">
							<li class=" border cursor-move mb-2 rounded last:mb-0">
								<ul class="border-b flex flex-row items-center">
									<li class="px-2 py-2 mb-0 font-semibold">{{element.name}} Input</li>
									<li @click='deleteInput(index)' class="close-tab-input">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
									</li>
								</ul>
								<ul class="border-b flex flex-row items-center">
									<!-- Input tabs -->
									<li  @click="element.tabState = 0 " :class="element.tabState === 0 ? 'tab-input bg-gray-50 text-blue-500':'tab-input'">Basic</li>
									<li  @click="element.tabState = 1" :class="element.tabState === 1 ? 'tab-input bg-gray-50 text-blue-500':'tab-input'">Advance</li>
									<!-- input tabs ends  -->
								</ul>

								<ul >
									<li  class="mb-0 cursor-default" v-show="element.tabState === 0">
										<!-- Basic -->
										<div v-if="element.type === 'text' || element.type === 'textarea' || element.type === 'email'">
											<div class="w-full flex flex-col">
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Label
													</div>
													<div class="w-2/4">
														<input class="w-full" type="text" v-model='element.data.label'/>
													</div>

												</div>
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Placeholder
													</div>
													<div class="w-2/4">
														<input class="w-full" type="text" v-model='element.data.placeholder'/>
													</div>

												</div>
												<div class=" flex items-center flex-row py-3 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Required
													</div>
													<div class="w-2/4 flex justify-end">
														<input type="checkbox" v-model="element.data.required" />
													</div>
												</div>
											</div>
										</div>
										<div v-if="element.type === 'checkbox' || element.type === 'radio'">
											<div class="w-full flex flex-col">
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Label
													</div>
													<div class="w-2/4">
														<input class="w-full" type="text" v-model='element.data.label'/>
													</div>

												</div>

												<div class=" flex items-center flex-row py-3 px-2 border-b">
													<div class="w-1/4 flex justify-end pr-4">
														Required
													</div>
													<div class="w-2/4 flex justify-end">
														<input type="checkbox" v-model="element.data.required" />
													</div>
												</div>

												<div class=" w-full flex flex-row py-3 px-2" >
													<div class="w-1/4 flex justify-end pr-4">
														Option(s)
													</div>
													<div class="flex flex-col w-2/4">

														<div class=" flex flex-row flex-wrap  mb-1  rounded items-center" v-for="option in element.data.Options" :key="option.id">
															<div class="w-5/12" >
																<input class="w-full mr-1" type="text" v-model="option.name" />
															</div>
															<div class="w-5/12">
																<input class="w-full ml-1" type="text" v-model="option.value" />
															</div>
															<div class="w-2/12 flex items-center justify-end p-2">
																<a class="rounded-full cursor-pointer" @click.prevent = 'deleteRadioCheck(index,option.id)'><svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 fill-current" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg></a>
															</div>

														</div>
														<div class="flex justify-center items-center w-full mt-4">
															<a class="border bg-white p-2 rounded-full text-gray-500 font-semibold capitalize cursor-pointer" @click.prevent="addRadioCheck(index)"><svg xmlns="http://www.w3.org/2000/svg" class="svg-class" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>Add New</a>
														</div>

													</div>
												</div>

											</div>
										</div>
										<div v-if="element.type === 'date'">
											<div class="w-full flex flex-col">
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Date Type
													</div>
													<div class="w-2/4">
														<select v-model="element.data.dateType" class="w-full text-center">
															<option v-for="option in element.data.dateData" v-bind:key="option.key" v-bind:value="option.key">{{option.name}}</option>

														</select>
													</div>

												</div>
											</div>
											<div class="w-full p-4 flex justify-center items-center">
												
												<div v-show="element.data.dateType == 0" class="w-4/6">
													<Datepicker v-model="element.data.dateData[0].range"  />
												</div>
												
												<div v-show="element.data.dateType == 1" class="w-4/6">
													<Datepicker  v-model="element.data.dateData[1].range" range />
												</div>

											</div>


										</div>
										<div v-if="element.type === 'file'">
											<div class="w-full flex flex-col">
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Label
													</div>
													<div class="w-2/4">
														<input class="w-full" type="text" v-model='element.data.label'/>
													</div>

												</div>

												<div class=" flex items-center flex-row py-3 px-2 border-b">
													<div class="w-1/4 flex justify-end pr-4">
														Required
													</div>
													<div class="w-2/4 flex justify-end">
														<input type="checkbox" v-model="element.data.required" />
													</div>
												</div>
												<div class="border-b flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														File Type
													</div>
													<div class="w-2/4">
														<select v-model="element.data.selectedFileType" class="w-full text-center" multiple>
															<option v-for="option in element.data.supportedFileTypes" v-bind:key="option.key" v-bind:value="option.type">{{option.name}}</option>

														</select>
													</div>
												</div>
											</div>
										</div>
										<!-- Basic Ends -->
									</li>
									<li  class="mb-0 px-2 py-2 shadow" v-show="element.tabState === 1">
										<!-- Advance  -->
										<div>
											<div class="w-full flex flex-col">
												<div class=" flex items-center flex-row py-2 px-2">
													<div class="w-1/4 flex justify-end pr-4">
														Css Class
													</div>
													<div class="w-2/4">
														<input class="w-full" type="text" v-model='element.data.cssClass'/>
													</div>
												</div>
											</div>
										</div>
										<!-- Advance Ends -->
									</li>
								</ul>
							</li>
						</template>
					</draggable>
					<!-- DROP AREA ENDS -->
					</div>
					<div v-if="emptyInputs.length != 0 " class="px-4 py-4 flex flex-row justify-end bg-gray-50 w-full ">
						<a
						class="border bg-white px-4 py-2 rounded-full text-gray-500 font-semibold capitalize cursor-pointer flex items-center"
						@click="saveFormData"
						><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /> </svg>Save</a>
					</div>

			  </div>
		  </div>
	  </div>
  </li>
</template>

<script>
import draggable from "vuedraggable";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
export default {
	name:'Rows',
	components:{
		draggable,
		Datepicker,
	},
	props:{
		row:Object
	},
	data: function(){
		return {
			localRow : this.row,
			draggableGroup:{
				name:'drag',
				pull:'clone',
				put:false

			},
			specialDragableGroup:{
				name:'special',
				pull:'clone',
				put:false
			},
			draggableGroupEmpty:{
				name:'drop',
				put	:['drag','special']
			},

			drawerOpen: false,
			/* DRAGGABLE ITEMS */

			inputs:[
					{name:'Text',type:'text',dataType:'string',tabState:0,
							data:{
								label:'',
								placeholder:'',
								required:false,
								cssClass:''
							}
					},			
					{name:'Textbox',type:'textarea',dataType:'string',tabState:0,
							data:{
								label:'',
								placeholder:'',
								required:false,
								cssClass:''
							}
					},
					{name:'Email',type:'email',dataType:'string',tabState:0,
						data:{
							label:'',
							placeholder:'',
							required:false,
							cssClass:''
						}
					},
					{name:'Checkbox',type:'checkbox',dataType:'boolean',tabState:0,
						data:{
							label:'',
							required:false,
							cssClass:'',
							Options:[{id:0, name:'Option 1',value:'Option 1'},{id:1,name:'Option 2',value:'Option 2'}],
						}
					},
					{name:'Radio',type:'radio',dataType:'boolean',tabState:0,
						data:{
							label:'',
							required:false,
							cssClass:'',
							Options:[{id:0, name:'Option 1',value:'Option 1'},{id:1,name:'Option 2',value:'Option 2'}],
						}
					},
					{name:'File Upload',type:'file',dataType:'string',tabState:0,
							data:{
								label:'',
								required:false,
								cssClass:'',
								selectedFileType:[],
								maxFileSize:3,
								supportedFileTypes:[
									{key:0,name:'Image(.jpg,.png,.gif)',type:'image'},
									{key:1,name:'Video(.mp4,.avi,.mov)',type:'video'},
									{key:2,name:'Audio(.mp3,.wav,.ogg)',type:'audio'},
									{key:3,name:'Document(.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx)',type:'document'},
									{key:4,name:'Archive(.zip,.rar)',type:'archive'},
									{key:5,name:'All',type:'all'},
									]
							}
					},
					{name:'Date',type:'date',dataType:'string',tabState:0,
						data:{
							label:'',
							required:false,
							cssClass:'',
							dateType: 0,
							dateData:[
								{key:0, name:'Simple',range : { startDate:'' ,endDate:''}},
								{key:1,name:'Range',range : {startDate:'' ,endDate : ''}},
							],
						}
					},
				],

			/* DROPPED ITEMS */
			emptyInputs:[],

		}
	},
	watch:{},
	created: function(){},
	methods:{
		rotateIcon: function(){
			this.drawerIconPosition = !this.drawerIconPosition;
		},
		openDrawer: function(){
			this.drawerOpen =! this.drawerOpen;
		},
		changeDynamicItemIcon: function(){
			this.dynamicItemIcon = !this.dynamicItemIcon;
		},
		deleteInput(index){
			this.emptyInputs.splice(index,1);
		},
		onClone(e){
			return JSON.parse(JSON.stringify(e));
		},
		addRadioCheck: function (index){
			//Array of Objects
			const options = this.emptyInputs[index].data.Options;

			// Getting the Object with highest ID value the array
			if(options.length != 0){
				const heighest = options.reduce((prev, curr) => {
				return (prev.id > curr.id) ? prev : curr;
				});
				var nextId = heighest.id + 1;
			}else{
				var nextId = 0;
			}


			 this.emptyInputs[index].data.Options.push({id:nextId,name:'Option '+ (nextId+1),value:'Option  '+(nextId+1)});
		},
		deleteRadioCheck: function (index,id){
			this.emptyInputs[index].data.Options.splice(id,1);
		},
		saveFormData: function(){
			const data = new FormData();
			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awraqSaveFormData');
			data.append('id',this.row.ID);
			data.append('formdata',JSON.stringify(this.emptyInputs));
	
			fetch(awraq_ajax_path,{
				method:"POST",
				credentials: 'same-origin',
				body:data
			})
			.then(response => response.json())
			.then(response => {
				console.log(response);
			})
			.catch(error => console.log(error));
		},
		getFormMeta: function(){
			const data = new FormData();
			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awraqGetFormMeta');
			data.append('id',this.row.ID);

			fetch(awraq_ajax_path,{
				method:"POST",
				credentials: 'same-origin',
				body:data
			})
			.then(response => response.json())
			.then(response => {
				if(response !== false){
					this.emptyInputs = response;
					console.log(this.emptyInputs);
				}
			
			})
			.catch(err => console.log(err));

		}

	},
	created: function(){
		this.getFormMeta();
	}
}
</script>