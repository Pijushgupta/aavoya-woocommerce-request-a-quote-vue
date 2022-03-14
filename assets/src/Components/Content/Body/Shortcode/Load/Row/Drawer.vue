<template>
	<div class="flex md:flex-row flex-wrap ">
		<div class="w-full flex flex-row flex-wrap justify-center py-10">
			<div class="w-1/2 flex flex-col justify-center">
				<div class="flex justify-center">
					<!-- Live Button Css Dump -->
					<div v-html="cssProperties"></div>
					<!-- Live Button Css Dump Ends -->
					<!-- Live Button Html -->
					<button v-bind:id="buttonId">{{drawer.buttonText}}</button>
					<!-- Live Button Html Ends -->
				</div>
			</div>
			<div class="w-1/2 flex justify-center">
				<div class="flex justify-center">
					<!-- Live Form Css Dump -->
						<!-- Form Css -->
						<div v-html="formCssProperties"></div>
						<!-- Form Css ends -->
						<!-- X button Css(<span> - parent) -->
						<div v-html="xButtonCssProperties"></div>
						<!-- X button Css(<span> - parent) Ends -->
						<!-- SVG Css -->
						<div v-html="xButtonSvgCss"></div>
						<!-- SVG css ends -->
					<!-- Live Form Css Dump Ends -->

					<!-- Live Form Html -->
					<div class="h-96 w-64 relative" v-bind:id="formId">
						<!-- X Button html -->
						<span v-bind:id="xCloseId">
							<svg xmlns="http://www.w3.org/2000/svg" v-bind:id="xButtonSvg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
						</span>
						<!-- X button Html ends -->

						<!-- Live Forms Inner Div -->
						<div class="w-full h-full bg-gray-300" >
						</div>
						<!-- Live Forms Inner Div ends -->
					</div>
					<!-- Live Form Html Ends  -->
				</div>
			</div>
		</div>
		<div class="flex w-1/2 pr-2 mt-2">
			<!-- Button controls 1st column  -->
			<div class="w-1/2 pr-2">
				<!-- Buttons Corners and Padding -->
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full ">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold" 
						v-on:click="$emit('toogle-state','buttonCornersAndPadding')"
						>
						Corners and Padding
						</label>
					</div>
					<div v-bind:class="state.buttonCornersAndPadding == false ? 'w-full flex flex-col mt-2 hidden':'w-full flex flex-col mt-2'">
						<div class="flex flex-col flex-wrap w-full mt-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Corners</label>
								<span class="pill">{{drawer.corners}}</span>
							</div>
							
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.corners"
								>
							</div>
						</div>
						<div class="flex flex-col flex-wrap w-full mt-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding X</label>
								<span class="pill">{{drawer.paddingX}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.paddingX"
								>
							</div>
							
						</div>
						<div class="flex flex-col flex-wrap w-full mt-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding Y</label>
								<span class="pill">{{drawer.paddingY}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.paddingY"
								>
							</div>
						</div>
					</div>
					
				</div>
				<!-- Buttons corners and paddings ends -->
				<!-- Buttons Text controls -->
				<div class="flex flex-row flex-wrap w-full rounded mt-2 p-2 shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold" 
						v-on:click="$emit('toogle-state','buttonText')"
						>
						Button Text
						</label>
					</div>
					<div v-bind:class="state.buttonText == false ? 'hidden':'w-full flex flex-col mt-2'">
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Letter Spacing</label>
									<span class="pill">{{drawer.letterSpacing}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100"
								v-model.number="drawer.letterSpacing"
								>
							</div>
						</div>
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Size</label>
									<span class="pill">{{drawer.fontSize}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="8" 
								max="80" 
								v-model.number="drawer.fontSize"
								>
							</div>
						</div>
						<div class="flex flex-col mt-2 w-full  justify-between">
							<label class="label ">Weight</label>
							<select v-model.number="drawer.fontWeight" class="rounded">
								<option 
								v-for="fontWeight in fontWeights" 
								v-bind:key="fontWeight.value" 
								v-bind:value="fontWeight.value" 
								v-bind:selected="drawer.fontWeight"
								>
								{{fontWeight.text}}
								</option>			
							</select>
						</div>
						<div class="flex flex-col w-full mt-2 justify-between">
							<label class="label ">Button Text</label>
							<input 
							type="text" 
							v-model="drawer.buttonText" 
							class="rounded"
							>
						</div>
					</div>
				</div>
				<!-- Buttons text controls ends -->
				<!-- Buttons shadow -->
				<div class="flex flex-row flex-wrap w-full rounded mt-2 p-2 shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','buttonShadow')"
						>
						Button Shadow
						</label>
					</div>
					<div v-bind:class="state.buttonShadow == false ? 'hidden':'w-full flex flex-col mt-2'">
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">H-Offset</label>
									<span class="pill">{{drawer.buttonShadow.hOffset}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.buttonShadow.hOffset"
								>
							</div>
						</div>
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">V-Offset</label>
									<span class="pill">{{drawer.buttonShadow.vOffset}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.buttonShadow.vOffset"
								>
							</div>
						</div>
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Blur</label>
									<span class="pill">{{drawer.buttonShadow.blur}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.buttonShadow.blur"
								>
							</div>
						</div>
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Spread</label>
									<span class="pill">{{drawer.buttonShadow.spread}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.buttonShadow.spread"
								>
							</div>
						</div>
						<div class="flex flex-col w-full mt-2  justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Colour</label>
									<span class="pill">{{drawer.buttonShadow.color}}</span>
							</div>
							<div class="w-full">
								<input type="color" v-model="drawer.buttonShadow.color">
							</div>
						</div>
					</div>
				</div>
				<!-- Buttons shadow ends -->	
			</div>
			<!-- Button controls 1st column ends -->

			<!-- Button controls 2nd column -->
			<div class="w-1/2 ">
				<!-- Buttons Colors -->
				<div class="flex flex-col w-full rounded p-2 mt-2  shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','buttonColor')"
						>
						Button Colours
						</label>
					</div>
					<div v-bind:class="state.buttonColor == false ? 'hidden':'w-full flex-row flex-wrap mt-2'">
						<div class="flex flex-col  justify-between mt-2 ">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Background</label>
								<span class="pill">{{drawer.backgroundColor}}</span>
							</div>
							<div class="w-full">
								<input 
								type="color"  
								v-model="drawer.backgroundColor"
								>
							</div>
						</div>
						<div class="flex flex-col  justify-between mt-2">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Text</label>
								<span class="pill">{{drawer.textColor}}</span>
							</div>
							<div class="w-full">
								<input 
								type="color" 
								v-model="drawer.textColor"
								>
							</div>
						</div>
						<div class="flex flex-col  justify-between mt-2 ">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Background Hover</label>
								<span class="pill">{{drawer.hoverBackgroundColor}}</span>
							</div>
							<div class="w-full">
								<input 
								type="color" 
								v-model="drawer.hoverBackgroundColor"
								>
							</div>
						</div>
						<div class="flex flex-col  justify-between mt-2">
						<div class="w-full flex flex-row flex-wrap justify-between items-center">
							<label class="label ">Text Hover</label>
							<span class="pill">{{drawer.hoverTextColor}}</span>
						</div>
						<div class="w-full">
							<input 
							type="color" 
							v-model="drawer.hoverTextColor"
							/>
						</div>
						</div>
					</div>

				</div>
				<!-- Buttons color ends -->
				<!-- Button Border -->
				<div class="flex flex-col flex-wrap w-full rounded p-2 mt-2  shadow">
					<div class="w-full flex flex-row justify-between items-center">
						
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','buttonBorder')"
						>
						Button Border
						</label>
					
						<div class="w-1/2 flex flex-row justify-end">
							<input 
							type="checkbox" 
							v-model="drawer.borderTab"
							/>
						</div>
					</div>
					<div v-bind:class="state.buttonBorder == false ? 'hidden':'w-full flex flex-row flex-wrap mt-2'">
						<div class="w-full flex flex-col mt-2">
							<div class="w-full flex flex-col mb-2 justify-between">
								<label class="label">Border Type</label>
								<select v-model="drawer.borderType">
									<option 
									v-for="borderType in borderTypes" 
									v-bind:value="borderType.value" 
									v-bind:key="borderType.value" 
									v-bind:selected="drawer.borderType"
									>
									{{borderType.text}}
									</option>
								</select>
							</div>
							<div class="w-1full flex flex-col mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Border</label>
									<span class="pill">{{drawer.borderWidth}}</span>
								</div>
								<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="drawer.borderWidth"
								/>
								</div>
							</div>	
							<div class="w-full flex flex-col justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Border Colour</label>
									<span class="pill">{{drawer.borderColor}}</span>
								</div>
								<div class="w-full">
									<input 
									type="color" 
									v-model="drawer.borderColor"
									/>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col mt-2 ">
							<div class="w-full flex flex-col mb-2 justify-between">
								<label class="label">Hover Border Type</label>
								<select v-model="drawer.hoverBorderType">
									<option 
									v-for="hoverBorderType in hoverBorderTypes" 
									v-bind:value="hoverBorderType.value" 
									v-bind:key="hoverBorderType.value" 
									v-bind:selected="drawer.hoverBorderType" 
									>
									{{hoverBorderType.text}}
									</option>
								</select>
							</div>
							<div class="w-full flex flex-col mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Hover Border</label>
									<span class="pill">{{drawer.hoverBorderWidth}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="drawer.hoverBorderWidth"
									>
								</div>
							</div>	
							<div class="w-full flex flex-col justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Hover Border Colour</label>
									<span class="pill">{{drawer.hoverBorderColor}}</span>
								</div>
								<div class="w-full">
										<input 
										type="color" 
										min="0" 
										max="100" 
										v-model="drawer.hoverBorderColor"
										>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!-- Button Border ends -->
				<!-- Additional css class for Button -->
				<div class="flex flex-col mt-2 p-2 rounded shadow justify-between">
					<div class="w-full flex flex-row justify-between">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','buttonCssClass')"
						>
						Button Css Class(Optional)
						</label>
					</div>
					<div v-bind:class="state.buttonCssClass == false ? 'hidden':'w-full mt-2'" >
						<input 
						type="text" 
						v-model="drawer.cssClass" 
						class="rounded w-full"
						>
					</div>
					
				</div>
				<!-- Additional css class for Button ends -->
			</div>
			<!-- Button controls 2nd column ends -->
		</div>
		<!-- Form and X button control area -->
		<div class="w-1/2 mt-2 flex flex-row flex-wrap">
			<!-- Form Controls -->
			<div class="w-1/2 pr-2">
				<!-- Form Corners and Padding -->
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','formCornersAndPadding')"
						>
						Form Corners and Padding
						</label>
					</div>
					<div v-bind:class="state.formCornersAndPadding == false ? 'hidden':'w-full flex flex-col mt-2'">
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Corners</label>
								<span class="pill">{{formDrawer.corners}}</span>
							</div>
							
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100" 
								v-model.number="formDrawer.corners"
								>
							</div>
						</div>
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding X</label>
								<span class="pill">{{formDrawer.paddingX}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100"  
								v-model.number="formDrawer.paddingX"
								>
							</div>
							
						</div>
						<div class="flex flex-col flex-wrap w-full justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Padding Y</label>
								<span class="pill">{{formDrawer.paddingY}}</span>
							</div>
							<div class="w-full">
								<input 
								type="range" 
								min="0" 
								max="100"  
								v-model.number="formDrawer.paddingY">
							</div>
						</div>
					</div>
					
				</div>
				<!-- Form Corner and Padding ends -->
				<!-- Form Background -->
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','formColor')"
						>
						Form Background Colour
						</label>
						
					</div>
					<div v-bind:class="state.formColor == false ? 'hidden':'w-full flex flex-col mt-2'">
						<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
							<div class="w-full flex flex-row flex-wrap justify-between items-center">
								<label class="label ">Colour</label>
								<span class="pill">{{formDrawer.bgColor}}</span>
							</div>
							
							<div class="w-full">
								<input 
								type="color" 
								v-model="formDrawer.bgColor">
							</div>
						</div>
					</div>
				</div>
				<!-- Form Background ends -->
				<!-- Form Shadow Area -->
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','formShadow')"
						>
						Form Shadows
						</label>
						
					</div>
					<div v-bind:class="state.formShadow == false ? 'hidden':'w-full'">
						<div class="w-full flex flex-col mt-2">
							<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">H-Offset</label>
									<span class="pill">{{formDrawer.formShadow.hOffset}}</span>
								</div>
								
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.formShadow.hOffset"
									/>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col mt-2">
							<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">V-Offset</label>
									<span class="pill">{{formDrawer.formShadow.vOffset}}</span>
								</div>
								
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model="formDrawer.formShadow.vOffset"
									/>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col mt-2">
							<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Blur</label>
									<span class="pill">{{formDrawer.formShadow.blur}}</span>
								</div>
								
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.formShadow.blur"
									/>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col mt-2">
							<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Spread</label>
									<span class="pill">{{formDrawer.formShadow.spread}}</span>
								</div>
								
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.formShadow.spread"
									/>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col mt-2">
							<div class="flex flex-col flex-wrap w-full mb-2 justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Colour</label>
									<span class="pill">{{formDrawer.formShadow.color}}</span>
								</div>
								
								<div class="w-full">
									<input 
									type="color" 
									v-model="formDrawer.formShadow.color"
									/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Form shadow area ends -->
				<!-- Form css class name -->
				<div class="flex flex-col mt-2 p-2 rounded shadow justify-between">
					<div class="w-full flex flex-row justify-between">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','formCssClass')"
						>
						Form Css Class(Optional)
						</label>
					</div>
					<div v-bind:class="state.formCssClass == false ? 'hidden':'w-full mt-2'">
						<input 
						type="text"  
						v-model="formDrawer.formCssClassName" 
						class="rounded w-full"
						/>
					</div>
				</div>
				<!-- Form css class name ends -->
			</div>
			<!-- Form Control Ends -->
			<!-- X button Controls -->
			<div class="w-1/2">
				
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full ">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','xButton')"
						>
						X Button
						</label>
						
					</div>
					<div v-bind:class="state.xButton == false ? 'hidden': 'w-full flex flex-col mt-2'">
						<div class="flex flex-col  w-full mb-2 ">
								<label class="label ">Button Position</label>
								<select v-model="formDrawer.btPosition">
									<option 
									v-for="xButtonLocation in xButtonLocations" v-bind:value="xButtonLocation.value" 
									v-bind:key="xButtonLocation.value" 
									v-bind:selected="formDrawer.btPosition"
									>
									{{xButtonLocation.text}}
									</option>
								</select>
						</div>
						<div class="flex flex-col  w-full mb-2">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Fill Colour</label>
									<span class="pill">{{formDrawer.svgFill}}</span>
								</div>
								<input 
								type="color" 
								v-model="formDrawer.svgFill" 
								/>
						</div>
						<div class="flex flex-col  w-full mb-2">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Stroke Colour</label>
									<span class="pill">{{formDrawer.svgStroke}}</span>
								</div>
								<input 
								type="color" 
								v-model="formDrawer.svgStroke" 
								/>
						</div>
						<div class="flex flex-col  w-full mb-2">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Background Colour</label>
									<span class="pill">{{formDrawer.svgSpanBg}}</span>
								</div>
								<input 
								type="color" 
								v-model="formDrawer.svgSpanBg" 
								/>
						</div>
						<div class="flex flex-col flex-wrap w-full justify-between">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Size</label>
									<span class="pill">{{formDrawer.svgSize}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.svgSize" 
									/>
								</div>
						</div>
						
					</div>
					
				</div>
				<div class="flex flex-row flex-wrap rounded mt-2 p-2 shadow">
					<div class="w-full ">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','xButtonShadow')"
						>
						X Button Shadow
						</label>
					</div>

					<div v-bind:class="state.xButtonShadow == false ? 'hidden': 'w-full flex flex-col mt-2'">

						<div class="flex flex-col  w-full mb-2 ">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">H-Offset</label>
									<span class="pill">{{formDrawer.svgShadow.hOffset}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.svgShadow.hOffset" 
									/>
								</div>
						</div>
						<div class="flex flex-col  w-full mb-2 ">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">V-Offset</label>
									<span class="pill">{{formDrawer.svgShadow.vOffset}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.svgShadow.vOffset" 
									/>
								</div>
						</div>
						<div class="flex flex-col  w-full mb-2 ">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Blur</label>
									<span class="pill">{{formDrawer.svgShadow.blur}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.svgShadow.blur" 
									/>
								</div>
						</div>
						<div class="flex flex-col  w-full mb-2 ">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Spread</label>
									<span class="pill">{{formDrawer.svgShadow.spread}}</span>
								</div>
								<div class="w-full">
									<input 
									type="range" 
									min="0" 
									max="100" 
									v-model.number="formDrawer.svgShadow.spread" 
									/>
								</div>
						</div>
						<div class="flex flex-col  w-full mb-2 ">
								<div class="w-full flex flex-row flex-wrap justify-between items-center">
									<label class="label ">Colour</label>
									<span class="pill">{{formDrawer.svgShadow.color}}</span>
								</div>
								<div class="w-full">
									<input 
									type="color" 
									v-model="formDrawer.svgShadow.color" 
									/>
								</div>
						</div>
					</div>
				</div>
				<div class="flex flex-col mt-2 p-2 rounded shadow justify-between">
					<div class="w-full flex flex-row justify-between">
						<label 
						class="px-4 py-1 bg-gray-200 rounded-full font-semibold"
						v-on:click="$emit('toogle-state','xButtonCssClass')"
						>
						X Button Css Class(Optional)
						</label>
					</div>
					<div v-bind:class="state.xButtonCssClass == false ? 'hidden': 'w-full mt-2'">
						<input 
						type="text"  
						v-model="formDrawer.svgCssClassName" 
						class="rounded w-full">
					</div>
				</div>
			</div>
			<!-- X button controls ends -->
		</div>
		<!-- Form and x button control area ends -->
		<!-- Save and Delete Button -->
		<div class="w-full  flex flex-row justify-end mt-5 ">
			<div class="flex flex-row justify-between">
				<button class="bg-red-700  px-4 py-2 text-white rounded font-semibold capitalize mr-2 flex items-center" v-on:click="$emit('delete-row',drawerId)">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
					Delete
				</button>
				<button class="bg-blue-800 px-4 py-2 text-white rounded font-semibold capitalize flex items-center" v-on:click="sendData">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" /></svg>	
					Save
				</button>
			</div>
		</div> 
		<!-- Save and Delete Button ends -->
	</div>
</template>
<script>


export default{
	name:'Drawer',
	props:{
		drawerData:Object,
		formDrawerData:Object,
		drawerId:Number,
		state:Object,

	},
	data: function(){
		return {
				drawer:{buttonShadow:{}},
				formDrawer:{formShadow:{},svgShadow:{}},

				cssProperties:'',
				formCssProperties:'',
				xButtonCssProperties:'',
				xButtonSvgCss:'',

				buttonId:'liveExample' + this.drawerId,
				formId:'formLiveExample' + this.drawerId,
				xCloseId:'xCloseId' + this.drawerId,
				xButtonSvg:'xButtonSvg' + this.drawerId,
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
				],
				xButtonLocations:[
					{value:"top-right", text:"Top Right"},
					{value:"top-left", text:"Top Left"}
				],
				

			}
	},
	
	created:function(){
		this.drawer = {
			corners: this.drawerData.corners ? this.drawerData.corners : 0,
			paddingX: this.drawerData.paddingX ? this.drawerData.paddingX: 0,
			paddingY: this.drawerData.paddingY ? this.drawerData.paddingY: 0,
			letterSpacing: this.drawerData.letterSpacing ? this.drawerData.letterSpacing : 0,
			fontSize: this.drawerData.fontSize ? this.drawerData.fontSize : 0,
			fontWeight:this.drawerData.fontWeight ? this.drawerData.fontWeight : 300,
			buttonText: this.drawerData.buttonText ? this.drawerData.buttonText : "AWRAQ",
			cssClass: this.drawerData.cssClass ? this.drawerData.cssClass : "aavoya",
			backgroundColor: this.drawerData.backgroundColor ? this.drawerData.backgroundColor : "#FF0000",
			textColor: this.drawerData.textColor ? this.drawerData.textColor : "#ffffff",
			hoverBackgroundColor: this.drawerData.hoverBackgroundColor ? this.drawerData.hoverBackgroundColor : "#e5e7eb",
			hoverTextColor: this.drawerData.hoverTextColor ? this.drawerData.hoverTextColor  : "#ffffff",
			borderTab: this.drawerData.borderTab ? this.drawerData.borderTab : false,
			borderType: this.drawerData.borderType ? this.drawerData.borderType : "none",
			borderWidth: this.drawerData.borderWidth ? this.drawerData.borderWidth : 0,
			borderColor: this.drawerData.borderColor ? this.drawerData.borderColor : '#00FFFFFF',
			hoverBorderType: this.drawerData.hoverBorderType ? this.drawerData.hoverBorderType: "none",
			hoverBorderWidth: this.drawerData.hoverBorderWidth ? this.drawerData.hoverBorderWidth: 0,
			hoverBorderColor: this.drawerData.hoverBorderColor ? this.drawerData.hoverBorderColor : "#00FFFFFF",
			buttonShadow:{
				hOffset:this.drawerData.buttonShadow ? this.drawerData.buttonShadow.hOffset ? this.drawerData.buttonShadow.hOffset: 0 : 0,
				vOffset:this.drawerData.buttonShadow ? this.drawerData.buttonShadow.vOffset ? this.drawerData.buttonShadow.vOffset : 0 : 0,
				blur:this.drawerData.buttonShadow ? this.drawerData.buttonShadow.blur ? this.drawerData.buttonShadow.blur : 3 : 3,
				spread:this.drawerData.buttonShadow ? this.drawerData.buttonShadow.spread ? this.drawerData.buttonShadow.spread : 2 : 2,
				color:this.drawerData.buttonShadow ? this.drawerData.buttonShadow.color ? this.drawerData.buttonShadow.color : "#cfcfcf" : "#cfcfcf"
			},
		}
		this.createButtonCss(this.drawer);
		

		this.formDrawer = {
			corners: this.formDrawerData.corners ? this.formDrawerData.corners:8,
			paddingX:this.formDrawerData.paddingX ? this.formDrawerData.paddingX:4,
			paddingY:this.formDrawerData.paddingY ? this.formDrawerData.paddingY:4,
			bgColor:this.formDrawerData.bgColor ? this.formDrawerData.bgColor:"#ececec",
			formShadow:{
				hOffset:this.formDrawerData.formShadow ? this.formDrawerData.formShadow.hOffset ? this.formDrawerData.formShadow.hOffset:0:0,
				vOffset:this.formDrawerData.formShadow ? this.formDrawerData.formShadow.vOffset ? this.formDrawerData.formShadow.vOffset:0:0,
				blur:this.formDrawerData.formShadow ? this.formDrawerData.formShadow.blur ? this.formDrawerData.formShadow.blur:3:3,
				spread:this.formDrawerData.formShadow ? this.formDrawerData.formShadow.spread ? this.formDrawerData.formShadow.spread:2:2,
				color:this.formDrawerData.formShadow ? this.formDrawerData.formShadow.color ? this.formDrawerData.formShadow.color:"#cfcfcf":"#cfcfcf"
			},
			formCssClassName:this.formDrawerData.formCssClassName ? this.formDrawerData.formCssClassName : "formawraq",
			btPosition:this.formDrawerData.btPosition ? this.formDrawerData.btPosition : "top-right",
			svgFill:this.formDrawerData.svgFill ? this.formDrawerData.svgFill : "#ff0000",
			svgStroke:this.formDrawerData.svgStroke ? this.formDrawerData.svgStroke : "#ffffff",
			svgSpanBg: this.formDrawerData.svgSpanBg ? this.formDrawerData.svgSpanBg : "#ffffff",
			svgSize:this.formDrawerData.svgSize ? this.formDrawerData.svgSize : 20,
			svgShadow: {
				hOffset:this.formDrawerData.svgShadow ? this.formDrawerData.svgShadow.hOffset ? this.formDrawerData.svgShadow.hOffset : 0 : 0,
				vOffset:this.formDrawerData.svgShadow ? this.formDrawerData.svgShadow.vOffset ? this.formDrawerData.svgShadow.vOffset : 0 : 0,
				blur:this.formDrawerData.svgShadow ? this.formDrawerData.svgShadow.blur ? this.formDrawerData.svgShadow.blur : 3 : 3,
				spread:this.formDrawerData.svgShadow ? this.formDrawerData.svgShadow.spread ? this.formDrawerData.svgShadow.spread : 2 : 2,
				color:this.formDrawerData.svgShadow ? this.formDrawerData.svgShadow.color ? this.formDrawerData.svgShadow.color : "#cfcfcf" : "#cfcfcf"
			},
			svgCssClassName: this.formDrawerData.svgCssClassName ? this.formDrawerData.svgCssClassName : "svgwraq"
		}
		this.createFormCss(this.formDrawer);
	},
	watch: {
		drawer : {
			handler: function (oldVal,newVal){
				this.createButtonCss(newVal);
				
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
	methods:{
		createButtonCss: function (css){

			let border = 'none';
			if(css.borderType !== 'none' && css.borderTab !== false){
				border = `${css.borderWidth}px ${css.borderType} ${css.borderColor}`;
			}

			let borderHover = 'none';
			if(css.hoverBorderType !== 'none' && css.borderTab !== false){
				borderHover = `${css.hoverBorderWidth}px ${css.hoverBorderType} ${css.hoverBorderColor}`;
			}

			this.cssProperties = `<style>
			#${this.buttonId}{
				border-radius:${css.corners}px;
				padding:${css.paddingY}px ${css.paddingX}px;
				letter-spacing:${css.letterSpacing}px; 
				font-size:${css.fontSize}px;
				font-weight:${css.fontWeight};
				background-color:${css.backgroundColor}; 
				color:${css.textColor};
				border:${border};
				box-shadow:${css.buttonShadow.hOffset}px ${css.buttonShadow.vOffset}px ${css.buttonShadow.blur}px ${css.buttonShadow.spread}px ${css.buttonShadow.color};
				}
			#${this.buttonId}:hover{
				background-color:${css.hoverBackgroundColor};
				color:${css.hoverTextColor};
				border:${borderHover};
			}	
				</style>`;
			
		},
		createFormCss: function(css){
			/* Form Css */
			this.formCssProperties = `<style>
			#${this.formId}{
				border-radius:${css.corners}px;
				padding:${css.paddingY}px ${css.paddingX}px;
				background-color:${css.bgColor};
				box-shadow:${css.formShadow.hOffset}px ${css.formShadow.vOffset}px ${css.formShadow.blur}px ${css.formShadow.spread}px ${css.formShadow.color};
			}
			</style>`;

			/* X button Css Generator */
			if(css.btPosition == 'top-right'){
				this.xButtonCssProperties = `<style>
				#${this.xCloseId}{	
					position: absolute;
					right: 0;
					top: 0;
					margin-right: -${css.svgSize/2}px;
					margin-top: -${css.svgSize/2}px;
					background: #fff;
					border-radius: 9999px;
					background-color:${css.svgSpanbg};
					box-shadow:${css.svgShadow.hOffset}px ${css.svgShadow.vOffset}px ${css.svgShadow.blur}px ${css.svgShadow.spread}px ${css.svgShadow.color};
				}
				</style>`;
			} 

			/* X button Css Generator */
			if(css.btPosition == 'top-left'){
				this.xButtonCssProperties = `<style>
				#${this.xCloseId}{
					
					position: absolute;
					left: 0;
					top: 0;
					margin-left: -${css.svgSize/2}px;
					margin-top: -${css.svgSize/2}px;
					background: #fff;
					border-radius: 9999px;
					background-color:${css.svgSpanbg};
					box-shadow:${css.svgShadow.hOffset}px ${css.svgShadow.vOffset}px ${css.svgShadow.blur}px ${css.svgShadow.spread}px ${css.svgShadow.color};

				}
				</style>`;
			}

			/* X button Svg  Css Generator */
			this.xButtonSvgCss = `<style>
			#${this.xButtonSvg}{
				fill:${css.svgFill};
				stroke:${css.svgStroke};
				width:${css.svgSize}px;
				height:${css.svgSize}px;
				
			}
			</style>`;

			
		},
		sendData:function(){
			this.$emit('send-data',this.drawerId,this.drawer,this.formDrawer);
		}
	}
}
</script>
