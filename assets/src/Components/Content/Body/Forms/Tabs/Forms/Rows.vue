<template>
  <li class="border-b last:border-b-0   mb-0">
	  <div class="form-row flex flex-row justify-between items-center px-4 py-2">
			<div class="w-2/12">
			
				<button class="rounded-full border cursor-pointer flex flex-row items-center px-4 py-2 hover:text-blue-500" v-on:click="deleteForm" >
					<svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 cursor-pointer mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
					<span class="font-semibold">Delete Form</span>
					
					</button>

			
			</div>	
		  <div class="w-6/12">
			  <span  class="w-full font-semibold">{{localRow.post_title ? localRow.post_title : 'Untitled Form'}}</span>
		  </div>
		  <div class="w-4/12 flex flex-row justify-end items-center ">
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
				<!-- Left Bar -->
			  <div class="leftbar w-2/12 border-r flex flex-col  p-2 relative bg-white">

				<!-- DRAG AREA -->
					<draggable 
					v-bind:list='inputs' 
					v-bind:group='draggableGroup' 
					animation=100 
					tag="ul" 
					v-bind:clone="onClone" 
					itemKey="index" 
					v-bind:sort="false"
					class="flex flex-wrap justify-start items-center"
					>

						<template #item="{element,index}">

							<li class=" lg:w-1/2 md:w-full p-2 mb-0 " v-on:click.prevent="onClickCopyInput(index)">
								<div class="flex flex-col items-center px-2 py-4 border  shadow-sm cursor-move  rounded  font-semibold bg-white">
									<div v-html="element.svg"></div>
									<span class="text-gray-500 lowercase">{{element.name}}</span>
									
								</div>
							</li>

						</template>

					</draggable>
				<!-- DRAG AREA ENDS -->
					
				</div>
				<!-- Left Bar Ends -->

				<!-- Right Bar -->
			  <div class="rightbar w-10/12 flex flex-col items-center m-4 rounded border items-center relative">

				  	<div class="px-4 py-4 border-b bg-gray-50 w-full">
						<input class="w-full border rounded" type="text" v-model='localRow.post_title' placeholder="Form Title"/>
					</div>

					<div  style="min-height:260px;" v-bind:class="emptyInputs.length == 0 ? 'md:w-6/12 m-2 rounded bg-gray-50 border border-dashed border-4 ':'md:w-6/12 m-2 rounded '">

					<!-- DROP AREA -->
					<draggable v-model='emptyInputs' :group='draggableGroupEmpty' animation=100 tag="ul" class="p-2 min-h-full" itemKey="index" >
						<template #item="{element,index,newIndex}">
							<li class=" border cursor-move mb-2 rounded last:mb-0">
								<ul class="border-b flex flex-row items-center justify-between ">
									<li class="mb-0">
										<ul class="flex flex-row">
											<li class="px-2 py-2 mb-0 font-semibold">
												<span v-html="element.svg"></span>
												{{element.name}}
											</li>
											<li class="px-2 py-2 mb-0 font-semibold text-gray-300"> {{'{'+element.uniqueName+'}'}}</li>
										</ul>
									</li>
									<li class="mb-0">
										<ul class="flex flex-row">
											<li class="close-tab-input mr-2" @click="toggleDetailPane(index)">
												<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-gray-400" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /> </svg>
											</li>
											<li @click='deleteInput(index)' class="close-tab-input">
												<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
											</li>
										</ul>
									</li>
									
									
								</ul>
								
								<div v-show="activePopupId === index" >
									<ul class="border-b flex flex-row items-center">
									<!-- Input tabs -->
									<li  @click="element.tabState = 0 " :class="element.tabState === 0 ? 'tab-input bg-gray-50 text-blue-500':'tab-input'">Basic</li>
									<li  @click="element.tabState = 1" :class="element.tabState === 1 ? 'tab-input bg-gray-50 text-blue-500':'tab-input'">Advance</li>
								
									<!-- input tabs ends  -->
									
								</ul>

								<ul >
									<li  class="mb-0 cursor-default" v-show="element.tabState === 0">
										<!-- Basic -->
										<div v-if="element.type === 'text' || element.type === 'textarea' || element.type === 'email' || element.type === 'phone'">
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
														<div class="flex flex-row flex-wrap">
															<div class="w-5/12 mr-1" ><span class="bg-gray-200 rounded-full px-2 font-semibold ">names</span></div>
															<div class="w-5/12 " ><span class="bg-gray-200 rounded-full px-2 font-semibold">values</span></div>
														</div>
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
													<Datepicker v-model="element.data.dateData[0].range"  range/>
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
										<div v-if="element.type === 'name'">
											<div class="w-full flex flex-col relative">
												<ul class="flex flex-row my-4 justify-center items-center">
													
													<li v-for="(n,i) in element.data.Options" :key="i" @click="element.data.tabState = i" class="cursor-pointer px-4 py-1 border first:border-r-0 first:rounded-l last:border-l-0 last:rounded-r font-semibold" v-bind:class="element.data.tabState == i ? 'text-blue-500 ':''"><a>{{n.name}}</a></li>
												</ul>
												<TransitionGroup  name="list" tag="ul" class="flex flex-row justify-center mb-4">
													
													<li 
													v-for="(o,e) in element.data.Options" 
													v-bind:key="e" 
													class="border rounded-lg  flex-col w-11/12" 
													v-show="element.data.tabState == e" 
												
													>
														<div class="border-b flex flex-row px-4 py-2 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Label
															</div>
															<div class="w-2/4">
																<input class="w-full" type="text" v-model='o.label'/>
															</div>
														</div>
														<div class="border-b flex flex-row px-4 py-2 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Placeholder
															</div>
															<div class="w-2/4">
																<input class="w-full" type="text" v-model='o.placeholder'/>
															</div>
														</div>
														<div class="border-b flex flex-row px-4 py-3 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Required
															</div>
															<div class="w-2/4 flex justify-end">
																<input class="w-full" type="checkbox" v-model='o.required'/>
															</div>
														</div>
														<div class="flex flex-row px-4 py-3 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Enable / Disable
															</div>
															<div class="w-2/4 flex justify-end">
																<input class="w-full" type="checkbox" v-model='o.enabled'/>
															</div>
														</div>
													</li>
													
												</TransitionGroup >
											</div>
											
													
												
										</div> 
										<div v-if="element.type === 'address'">
											<div class="w-full flex flex-col relative">
												<ul class="flex flex-row my-4 justify-center items-center">
													
													<li v-for="(n,i) in element.data.Options" :key="i" @click="element.data.tabState = i" class="cursor-pointer px-4 py-1 border first:border-r-0 first:rounded-l last:border-l-0 last:rounded-r font-semibold" v-bind:class="element.data.tabState == i ? 'text-blue-500 ':''"><a>{{n.name}}</a></li>
												</ul>
												<TransitionGroup  name="list" tag="ul" class="flex flex-row justify-center mb-4">
													
													<li 
													v-for="(o,e) in element.data.Options" 
													v-bind:key="e" 
													class="border rounded-lg  flex-col w-11/12" 
													v-show="element.data.tabState == e" 
												
													>
														<div class="border-b flex flex-row px-4 py-2 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Label
															</div>
															<div class="w-2/4">
																<input class="w-full" type="text" v-model='o.label'/>
															</div>
														</div>
														<div class="border-b flex flex-row px-4 py-2 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Placeholder
															</div>
															<div class="w-2/4">
																
																<input v-if="o.name != 'country'" class="w-full" type="text" v-model='o.placeholder'/>
																<select v-else class="w-full"  v-model='o.placeholder'>
																	<option 
																	v-for="(country,uniqueKey) in countryList" 
																	v-bind:key="uniqueKey" 
																	v-bind:value="country.value"
																	>
																	{{country.name}}
																	</option>
																</select>
															</div>
														</div>

														<div class="border-b flex flex-row px-4 py-3 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Required
															</div>
															<div class="w-2/4 flex justify-end">
																<input class="w-full" type="checkbox" v-model='o.required'/>
															</div>
														</div>
														<div class="flex flex-row px-4 py-3 items-center">
															<div class="w-1/4 flex justify-end pr-4">
																Enable / Disable
															</div>
															<div class="w-2/4 flex justify-end">
																<input class="w-full" type="checkbox" v-model='o.enabled'/>
															</div>
														</div>
													</li>
													
												</TransitionGroup >
											</div>
											
													
												
										</div> 
										<div v-if="element.type == 'content'">
											<div class="p-4">
												<editor v-model="element.data.content" />
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
								</div>
								
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
				<!-- Right Bar Ends -->
		  </div>
	  </div>
  </li>
</template>

<script>
import draggable from "vuedraggable";
import Editor from './Editor/Editor.vue'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useToast } from 'vue-toastification'
export default {
	name:'Rows',
	components:{
		draggable,
		Datepicker,
		Editor,
	},
	props:{
		row:Object
	},
	data: function(){
		return {
			localRow : this.row,
			drawerIconPosition: false,
			drawerOpen: false,
			draggableGroup:{
				name:'drag',
				pull:'clone',
				put:false

			},
		
			draggableGroupEmpty:{
				name:'drop',
				put	:['drag','special']
			},

			/* this to determine which input popup to show */
			activePopupId:false,	
			/* ends */

			countryList: this.getCountryList(),
			
			/* DRAGGABLE ITEMS */

			inputs:[
					{name:'Text',type:'text',uniqueName:'',dataType:'string',tabState:0,
							data:{
								label:'',
								placeholder:'',
								required:false,
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /> <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /> </svg>',
					},
					{name:'Name',type:'name',uniqueName:'',dataType:'string',tabState:0,
							data:{
								tabState:0,
								Options:[
									{name:'first name', label:'First Name',value:'',enabled:true, required:false, placeholder:''},
									{name:'middle name', label:'Middle Name',value:'',enabled:true, required:false, placeholder:''},
									{name:'last name',label:'Last Name',value:'',enabled:true, required:false, placeholder:''},
								],
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" /> </svg>',
					},
					{name:'Address',type:'address',uniqueName:'',dataType:'string',tabState:0,
							data:{
							tabState:0,
								Options:[
									{name:'address', label:'Address',value:'',enabled:true, required:false, placeholder:''},
									{name:'apartment', label:'Apartment',value:'',enabled:true, required:false, placeholder:''},
									{name:'city',label:'City',value:'',enabled:true, required:false, placeholder:''},
									{name:'state',label:'State',value:'',enabled:true, required:false, placeholder:''},
									{name:'zip',label:'ZIP',value:'',enabled:true, required:false, placeholder:''},
									{name:'country',label:'Country',value:'',enabled:true, required:false, placeholder:''},
								],
								
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /> </svg>',
					},
					{name:'Content',type:'content',uniqueName:'',dataType:'string',tabState:0,
							data:{
								content:'<p>Sample text</p>',
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /> </svg>',
					},
					{name:'Phone',type:'phone',uniqueName:'',dataType:'string',tabState:0,
							data:{
								label:'Phone',
								placeholder:'',
								required:false,
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /> </svg>',
					},			
					{name:'Textbox',type:'textarea',uniqueName:'',dataType:'string',tabState:0,
							data:{
								label:'',
								placeholder:'',
								required:false,
								cssClass:''
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>',
					},
					{name:'Email',type:'email',uniqueName:'',dataType:'string',tabState:0,
						data:{
							label:'Email',
							placeholder:'',
							required:false,
							cssClass:''
						},
						svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z" clip-rule="evenodd" /> </svg>'
					},
					{name:'Checkbox',type:'checkbox',uniqueName:'',dataType:'boolean',tabState:0,
						data:{
							label:'',
							required:false,
							cssClass:'',
							Options:[{id:0, name:'Option 1',value:'Option 1'},{id:1,name:'Option 2',value:'Option 2'}],
						},
						svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" fill="currentColor"> <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /> </svg>'
					},
					{name:'Radio',type:'radio',uniqueName:'',dataType:'boolean',tabState:0,
						data:{
							label:'',
							required:false,
							cssClass:'',
							Options:[{id:0, name:'Option 1',value:'Option 1'},{id:1,name:'Option 2',value:'Option 2'}],
						},
						svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd" /> </svg>'
					},
					{name:'File Upload',type:'file',uniqueName:'',dataType:'string',tabState:0,
							data:{
								label:'File',
								required:false,
								cssClass:'',
								selectedFileType:[],
								maxFileSize:3,
								supportedFileTypes:[
									{key:0,name:'Image(.jpg,.png,.gif)',type:'image'},
									{key:1,name:'Video(.mp4,.avi,.mov)',type:'video'},
									{key:2,name:'Audio(.mp3,.wav,.ogg)',type:'audio'},
									{key:3,name:'Document(.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx)',type:'document'},
									{key:4,name:'Archive(.zip,.rar,.7z,.tar,.gz)',type:'archive'},
									{key:5,name:'All',type:'all'},
									]
							},
							svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg>'
					},
					{name:'Date',type:'date',uniqueName:'',dataType:'string',tabState:0,
						data:{
							label:'Select date',
							required:false,
							cssClass:'',
							dateType: 0,
							dateData:[
								{key:0, name:'Simple',range : { startDate:'' ,endDate:''}},
								{key:1,name:'Range',range : {startDate:'' ,endDate : ''}},
							],
						},
						svg:'<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-300 inline mb-1" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /> </svg>',
					},
				],

			/* DROPPED ITEMS */
			emptyInputs:[],

		}
	},
	watch:{
		emptyInputs:{
			handler:function(oldVal,newVal){
				/* Making sure that follow codes only executes when an item gets added  */
				if( newVal.length >= oldVal.length){return;}
				/*ends*/
				this.setUniqueName();	
			}
		},
	},
	created: function(){},
	methods:{
		setUniqueName: function(){
			this.emptyInputs.forEach(function(item){
				if(item.uniqueName == ''){
					let suffix = 0;
					while(1){
						let uniqueName = item.type + '-' + suffix;
						if(this.emptyInputs.findIndex(e => e.uniqueName == uniqueName) == -1){
							item.uniqueName = uniqueName;
							break;
						};
						suffix++;
					}
				}
			}.bind(this));
		},
		rotateIcon: function(){
			this.drawerIconPosition = !this.drawerIconPosition;
		},
		openDrawer: function(){
			this.drawerOpen =! this.drawerOpen;
		},
		changeDynamicItemIcon: function(){
			this.dynamicItemIcon = !this.dynamicItemIcon;
		},

		/* Delete Input */
		deleteInput(index){
			this.emptyInputs.splice(index,1);
		},
		/* Ends */

		/* Way around of vue-Draggable when cloning multiple copies of same element */
		onClone(e){
			return JSON.parse(JSON.stringify(e));
		},
		/* Ends */

		/* Adding Options to Radio/Checkbox */
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
		/* Ends */

		/* Delete Options from Radio/Checkbox */
		deleteRadioCheck: function (index,id){
			if(this.emptyInputs[index].data.Options.length > 1){
				this.emptyInputs[index].data.Options.splice(id,1);
			}else{
				const toast = useToast();
				toast("Cannot delete last option");
			}
			
		},
		/* Ends */

		/* This to save form fields */
		saveFormData: function(){
			if(this.localRow.post_title == '' || this.localRow.title == 'Untitled Form'){
				alert('Please enter a title for the form');
				return;
			}
			const data = new FormData();
			data.append('awraq_nonce',awraq_nonce);
			data.append('action','awraqSaveFormData');
			data.append('id',this.row.ID);
			
			data.append('title',this.localRow.post_title);
			data.append('formdata',JSON.stringify(this.emptyInputs));
	
			fetch(awraq_ajax_path,{
				method:"POST",
				credentials: 'same-origin',
				body:data
			})
			.then(response => response.json())
			.then(response => {
				console.log(response);

				if(response == 0){
					const toast = useToast();
					toast("Form Saved!");
				}
			})
			.catch(err => console.log(err));
		},
		/* Ends */

		/* Getting saved form field from post(form) id and assigning to emptyInput array of vue-Draggable */
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
					console.log(response);
					this.emptyInputs = response;
				}
			
			})
			.catch(err => console.log(err));

		},
		/* Ends */

		/* Copy To ClipBoard */
		copyToClipBoard: function (){
			let toClipBoard = '[awraqf id="'+ this.localRow.ID +'"]';
			if(!navigator.clipboard){
				toClipBoard.select();
				document.execCommand("copy");
			}
			else{
				navigator.clipboard.writeText(toClipBoard).then(()=>{
					
					const toast = useToast();
					toast("Copied to Clipboard");
				})
				.catch(err => console.log(err));
			}
		},
		/* Ends */

		/* Delete From */
		deleteForm: function(){
			if(confirm('Form will get deleted Permanently')){
				const data = new FormData();
				data.append('awraq_nonce',awraq_nonce);
				data.append('action','awraqDeleteForm');
				data.append('id',this.row.ID);

				fetch(awraq_ajax_path,{
					method:"POST",
					credentials: 'same-origin',
					body:data
				})
				.then(response => response.json())
				.then(response => {
					if(response === true){
						this.$emit('removeRow',this.row.ID);
					}
				})
				.catch(err => console.log(err));

			 }
		},
		/* Ends */
		
		/* Toggling Detail Pane */
		toggleDetailPane: function(i){
			this.activePopupId === i ? this.activePopupId = false : this.activePopupId = i;
		},
		/* Ends */
		

		/* 
		 * Alternative to dran and drop
		 * It will add input to drop area from drag area 
		 */
		onClickCopyInput: function(index){
			// this.emptyInputs.unshift(this.inputs[index]);
			// this.setUniqueName();
		},
		/* Ends */

		getCountryList:function(){
			return [
							{value:'Afghanistan',name:'Afghanistan'},
							{value:'Albania',name:'Albania'},
							{value:'Algeria',name:'Algeria'},
							{value:'American Samoa',name:'American Samoa'},
							{value:'Andorra',name:'Andorra'},
							{value:'Angola',name:'Angola'},
							{value:'Anguilla',name:'Anguilla'},
							{value:'Antarctica',name:'Antarctica'},
							{value:'Antigua and Barbuda',name:'Antigua and Barbuda'},
							{value:'Argentina',name:'Argentina'},
							{value:'Armenia',name:'Armenia'},
							{value:'Australia',name:'Australia'},
							{value:'Aruba',name:'Aruba'},
							{value:'Austria',name:'Austria'},
							{value:'Azerbaijan',name:'Azerbaijan'},
							{value:'Bahamas',name:'Bahamas'},
							{value:'Bahrain',name:'Bahrain'},
							{value:'Bangladesh',name:'Bangladesh'},
							{value:'Barbados',name:'Barbados'},
							{value:'Belarus',name:'Belarus'},
							{value:'Belgium',name:'Belgium'},
							{value:'Belize',name:'Belize'},
							{value:'Benin',name:'Benin'},
							{value:'Bermuda',name:'Bermuda'},
							{value:'Bhutan',name:'Bhutan'},
							{value:'Bolivia',name:'Bolivia'},
							{value:'Bosnia and Herzegovina',name:'Bosnia and Herzegovina'},
							{value:'Botswana',name:'Botswana'},
							{value:'Bouvet Island',name:'Bouvet Island'},
							{value:'Brazil',name:'Brazil'},
							{value:'British Indian Ocean Territory',name:'British Indian Ocean Territory'},
							{value:'Brunei',name:'Brunei'},
							{value:'Bulgaria',name:'Bulgaria'},
							{value:'Burkina Faso',name:'Burkina Faso'},
							{value:'Burundi',name:'Burundi'},
							{value:'Cambodia',name:'Cambodia'},
							{value:'Cameroon',name:'Cameroon'},
							{value:'Canada',name:'Canada'},
							{value:'Cabo Verde',name:'Cabo Verde'},
							{value:'Cayman Islands',name:'Cayman Islands'},
							{value:'Central African Republic',name:'Central African Republic'},
							{value:'Chad',name:'Chad'},
							{value:'Chile',name:'Chile'},
							{value:'China, People\'s Republic of',name:'China, People\'s Republic of'},
							{value:'Christmas Island',name:'Christmas Island'},
							{value:'Cocos Islands',name:'Cocos Islands'},
							{value:'Colombia',name:'Colombia'},
							{value:'Comoros',name:'Comoros'},
							{value:'Congo, Democratic Republic of the',name:'Congo, Democratic Republic of the'},
							{value:'Congo, Republic of the',name:'Congo, Republic of the'},
							{value:'Cook Islands',name:'Cook Islands'},
							{value:'Costa Rica',name:'Costa Rica'},
							{value:'Côte d\'Ivoire',name:'Côte d\'Ivoire'},
							{value:'Croatia',name:'Croatia'},
							{value:'Cuba',name:'Cuba'},
							{value:'Curaçao',name:'Curaçao'},
							{value:'Cyprus',name:'Cyprus'},
							{value:'Czech Republic',name:'Czech Republic'},
							{value:'Denmark',name:'Denmark'},
							{value:'Djibouti',name:'Djibouti'},
							{value:'Dominica',name:'Dominica'},
							{value:'Dominican Republic',name:'Dominican Republic'},
							{value:'East Timor',name:'East Timor'},
							{value:'Ecuador',name:'Ecuador'},
							{value:'Egypt',name:'Egypt'},
							{value:'El Salvador',name:'El Salvador'},
							{value:'Equatorial Guinea',name:'Equatorial Guinea'},
							{value:'Eritrea',name:'Eritrea'},
							{value:'Estonia',name:'Estonia'},
							{value:'Ethiopia',name:'Ethiopia'},
							{value:'Falkland Islands',name:'Falkland Islands'},
							{value:'Faroe Islands',name:'Faroe Islands'},
							{value:'Fiji',name:'Fiji'},
							{value:'Finland',name:'Finland'},
							{value:'France',name:'France'},
							{value:'France, Metropolitan',name:'France, Metropolitan'},
							{value:'French Guiana',name:'French Guiana'},
							{value:'French Polynesia',name:'French Polynesia'},
							{value:'French South Territories',name:'French South Territories'},
							{value:'Gabon',name:'Gabon'},
							{value:'Gambia',name:'Gambia'},
							{value:'Georgia',name:'Georgia'},
							{value:'Germany',name:'Germany'},
							{value:'Guernsey',name:'Guernsey'},
							{value:'Ghana',name:'Ghana'},
							{value:'Gibraltar',name:'Gibraltar'},
							{value:'Greece',name:'Greece'},
							{value:'Greenland',name:'Greenland'},
							{value:'Grenada',name:'Grenada'},
							{value:'Guadeloupe',name:'Guadeloupe'},
							{value:'Guam',name:'Guam'},
							{value:'Guatemala',name:'Guatemala'},
							{value:'Guinea',name:'Guinea'},
							{value:'Guinea-Bissau',name:'Guinea-Bissau'},
							{value:'Guyana',name:'Guyana'},
							{value:'Haiti',name:'Haiti'},
							{value:'Heard Island And Mcdonald Island',name:'Heard Island And Mcdonald Island'},
							{value:'Honduras',name:'Honduras'},
							{value:'Hong Kong',name:'Hong Kong'},
							{value:'Hungary',name:'Hungary'},
							{value:'Iceland',name:'Iceland'},
							{value:'India',name:'India'},
							{value:'Indonesia',name:'Indonesia'},
							{value:'Iran',name:'Iran'},
							{value:'Iraq',name:'Iraq'},
							{value:'Ireland',name:'Ireland'},
							{value:'Israel',name:'Israel'},
							{value:'Italy',name:'Italy'},
							{value:'Jamaica',name:'Jamaica'},
							{value:'Japan',name:'Japan'},
							{value:'Jersey',name:'Jersey'},
							{value:'Johnston Island',name:'Johnston Island'},
							{value:'Jordan',name:'Jordan'},
							{value:'Kazakhstan',name:'Kazakhstan'},
							{value:'Kenya',name:'Kenya'},
							{value:'Kiribati',name:'Kiribati'},
							{value:'Korea, Democratic People\'s Republic of',name:'Korea, Democratic People\'s Republic of'},
							{value:'Korea, Republic of',name:'Korea, Republic of'},
							{value:'Kosovo',name:'Kosovo'},
							{value:'Kuwait',name:'Kuwait'},
							{value:'Kyrgyzstan',name:'Kyrgyzstan'},
							{value:'Lao People\'s Democratic Republic',name:'Lao People\'s Democratic Republic'},
							{value:'Latvia',name:'Latvia'},
							{value:'Lebanon',name:'Lebanon'},
							{value:'Lesotho',name:'Lesotho'},
							{value:'Liberia',name:'Liberia'},
							{value:'Libya',name:'Libya'},
							{value:'Liechtenstein',name:'Liechtenstein'},
							{value:'Lithuania',name:'Lithuania'},
							{value:'Luxembourg',name:'Luxembourg'},
							{value:'Macau',name:'Macau'},
							{value:'North Macedonia',name:'North Macedonia'},
							{value:'Madagascar',name:'Madagascar'},
							{value:'Malawi',name:'Malawi'},
							{value:'Malaysia',name:'Malaysia'},
							{value:'Maldives',name:'Maldives'},
							{value:'Mali',name:'Mali'},
							{value:'Malta',name:'Malta'},
							{value:'Marshall Islands',name:'Marshall Islands'},
							{value:'Martinique',name:'Martinique'},
							{value:'Mauritania',name:'Mauritania'},
							{value:'Mauritius',name:'Mauritius'},
							{value:'Mayotte',name:'Mayotte'},
							{value:'Mexico',name:'Mexico'},
							{value:'Micronesia',name:'Micronesia'},
							{value:'Moldova',name:'Moldova'},
							{value:'Monaco',name:'Monaco'},
							{value:'Mongolia',name:'Mongolia'},
							{value:'Montserrat',name:'Montserrat'},
							{value:'Montenegro',name:'Montenegro'},
							{value:'Morocco',name:'Morocco'},
							{value:'Mozambique',name:'Mozambique'},
							{value:'Myanmar',name:'Myanmar'},
							{value:'Namibia',name:'Namibia'},
							{value:'Nauru',name:'Nauru'},
							{value:'Nepal',name:'Nepal'},
							{value:'Netherlands',name:'Netherlands'},
							{value:'Netherlands Antilles',name:'Netherlands Antilles'},
							{value:'New Caledonia',name:'New Caledonia'},
							{value:'New Zealand',name:'New Zealand'},
							{value:'Nicaragua',name:'Nicaragua'},
							{value:'Niger',name:'Niger'},
							{value:'Nigeria',name:'Nigeria'},
							{value:'Niue',name:'Niue'},
							{value:'Norfolk Island',name:'Norfolk Island'},
							{value:'Northern Mariana Islands',name:'Northern Mariana Islands'},
							{value:'Norway',name:'Norway'},
							{value:'Oman',name:'Oman'},
							{value:'Pakistan',name:'Pakistan'},
							{value:'Palau',name:'Palau'},
							{value:'Palestine, State of',name:'Palestine, State of'},
							{value:'Panama',name:'Panama'},
							{value:'Papua New Guinea',name:'Papua New Guinea'},
							{value:'Paraguay',name:'Paraguay'},
							{value:'Peru',name:'Peru'},
							{value:'Philippines',name:'Philippines'},
							{value:'Pitcairn Islands',name:'Pitcairn Islands'},
							{value:'Poland',name:'Poland'},
							{value:'Portugal',name:'Portugal'},
							{value:'Puerto Rico',name:'Puerto Rico'},
							{value:'Qatar',name:'Qatar'},
							{value:'Reunion Island',name:'Reunion Island'},
							{value:'Romania',name:'Romania'},
							{value:'Russia',name:'Russia'},
							{value:'Rwanda',name:'Rwanda'},
							{value:'Saint Kitts and Nevis',name:'Saint Kitts and Nevis'},
							{value:'Saint Lucia',name:'Saint Lucia'},
							{value:'Saint Vincent and the Grenadines',name:'Saint Vincent and the Grenadines'},
							{value:'Samoa',name:'Samoa'},
							{value:'Saint Helena',name:'Saint Helena'},
							{value:'Saint Pierre &amp; Miquelon',name:'Saint Pierre &amp; Miquelon'},
							{value:'San Marino',name:'San Marino'},
							{value:'Sao Tome and Principe',name:'Sao Tome and Principe'},
							{value:'Saudi Arabia',name:'Saudi Arabia'},
							{value:'Senegal',name:'Senegal'},
							{value:'Serbia',name:'Serbia'},
							{value:'Seychelles',name:'Seychelles'},
							{value:'Sierra Leone',name:'Sierra Leone'},
							{value:'Singapore',name:'Singapore'},
							{value:'Sint Maarten',name:'Sint Maarten'},
							{value:'Slovakia',name:'Slovakia'},
							{value:'Slovenia',name:'Slovenia'},
							{value:'Solomon Islands',name:'Solomon Islands'},
							{value:'Somalia',name:'Somalia'},
							{value:'South Africa',name:'South Africa'},
							{value:'South Georgia and South Sandwich',name:'South Georgia and South Sandwich'},
							{value:'Spain',name:'Spain'},
							{value:'Sri Lanka',name:'Sri Lanka'},
							{value:'Stateless Persons',name:'Stateless Persons'},
							{value:'Sudan',name:'Sudan'},
							{value:'Sudan, South',name:'Sudan, South'},
							{value:'Suriname',name:'Suriname'},
							{value:'Svalbard and Jan Mayen',name:'Svalbard and Jan Mayen'},
							{value:'Swaziland',name:'Swaziland'},
							{value:'Sweden',name:'Sweden'},
							{value:'Switzerland',name:'Switzerland'},
							{value:'Syria',name:'Syria'},
							{value:'Taiwan, Republic of China',name:'Taiwan, Republic of China'},
							{value:'Tajikistan',name:'Tajikistan'},
							{value:'Tanzania',name:'Tanzania'},
							{value:'Thailand',name:'Thailand'},
							{value:'Togo',name:'Togo'},
							{value:'Tokelau',name:'Tokelau'},
							{value:'Tonga',name:'Tonga'},
							{value:'Trinidad and Tobago',name:'Trinidad and Tobago'},
							{value:'Tunisia',name:'Tunisia'},
							{value:'Turkey',name:'Turkey'},
							{value:'Turkmenistan',name:'Turkmenistan'},
							{value:'Turks And Caicos Islands',name:'Turks And Caicos Islands'},
							{value:'Tuvalu',name:'Tuvalu'},
							{value:'Uganda',name:'Uganda'},
							{value:'Ukraine',name:'Ukraine'},
							{value:'United Arab Emirates',name:'United Arab Emirates'},
							{value:'United Kingdom',name:'United Kingdom'},
							{value:'US Minor Outlying Islands',name:'US Minor Outlying Islands'},
							{value:'United States of America (USA)',name:'United States of America (USA)'},
							{value:'Uruguay',name:'Uruguay'},
							{value:'Uzbekistan',name:'Uzbekistan'},
							{value:'Vanuatu',name:'Vanuatu'},
							{value:'Vatican City',name:'Vatican City'},
							{value:'Venezuela',name:'Venezuela'},
							{value:'Vietnam',name:'Vietnam'},
							{value:'Virgin Islands, British',name:'Virgin Islands, British'},
							{value:'Virgin Islands, U.S.',name:'Virgin Islands, U.S.'},
							{value:'Wallis And Futuna Islands',name:'Wallis And Futuna Islands'},
							{value:'Western Sahara',name:'Western Sahara'},
							{value:'Yemen Arab Rep.',name:'Yemen Arab Rep.'},
							{value:'Yemen Democratic',name:'Yemen Democratic'},
							{value:'Zambia',name:'Zambia'},
							{value:'Zimbabwe',name:'Zimbabwe'}
						];

		}

	},
	created: function(){
		this.getFormMeta();
	}
}
</script>
