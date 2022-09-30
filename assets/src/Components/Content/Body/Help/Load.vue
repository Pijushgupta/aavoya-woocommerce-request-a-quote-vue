<template>
	<div class=" bg-white border rounded-lg ">
		<div class="container mx-auto md:w-7/12 flex lg:flex-row flex-col flex-wrap   ">
			<template v-for="faq in faqs" v-bind:key="faq.id">
				<div class="w-full py-1 first:pt-4 last:pb-4 ">
					<div class="border rounded ">
						<div class="flex flex-row justify-between items-center p-2">
							<div class="font-medium">{{faq.question}}</div>
							<div @click="activeAccordion == faq.id ? activeAccordion = null : activeAccordion = faq.id"><svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-5 w-5 stroke-gray-500" v-bind:class="activeAccordion == faq.id ? 'transform rotate-90':''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg>
							</div>
						</div>
						<div style="display:none" v-show="activeAccordion == faq.id" class="border-t p-2">
							<div v-html="faq.answer"></div>
							
						</div>
						
					</div>
				</div>
			</template>
			
			
		</div>
	</div>
</template>
<script setup>
import { ref } from 'vue';
const activeAccordion = ref(null);
const assetsPath = ref(assetPath);
let faqs = [
	{
		"id": 0,
		"question": "How to create a Form",
		"answer": " <p class='py-2 font-medium '>Click on <span class='rounded-full bg-gray-200 px-2'>forms Tab</span> then on the <span class='rounded-full bg-gray-200 px-2'>create Button</span> <img class='border border-gray-600 my-2 w-full' src='" + assetsPath.value + "/image/help1-1.png'> </p> <p class='py-2 font-medium '>Now we have a \"untitled form \". Click on the <span class='rounded-full bg-gray-200 px-2'>arrow icon</span> on right side of the row. <img class='border border-gray-600 my-2 w-full' src='"+assetsPath.value+"/image/help1-2.png'></p> <p class='py-2 font-medium '>It will open form tools. <img src='"+assetsPath.value+"/image/help1-3.png' class='border border-gray-600 my-2 w-full' ></p> <p class='py-2 font-medium '>Its required to provide a <span class='rounded-full bg-gray-200 px-2'>name/title</span> for the form.</p> <p class='py-2 font-medium '>Now we need to add form elements from the left to blank area. We can drag element from left to blank area to add element to the form.  <img src='"+assetsPath.value+"/image/help1-4.png' class='border border-gray-600 my-2 w-full'> Now click on <span class='rounded-full bg-gray-200 px-2'>save</span> button on bottom right.</p>"
	},
	{
		"id": 1,
		"question": "How to create a Button",
		"answer":""
	}
	
]


</script>
