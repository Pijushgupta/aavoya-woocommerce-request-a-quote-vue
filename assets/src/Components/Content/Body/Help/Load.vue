<template>
	<div class=" bg-white border rounded-lg ">
		<div class="container mx-auto md:w-7/12 flex lg:flex-row flex-col flex-wrap   ">
			<template v-for="faq in faqs" v-bind:key="faq.id">
				<div class="w-full py-1 first:pt-4 last:pb-4 ">
					<div class="border rounded ">
						<div class="flex flex-row justify-between items-center p-2">
							<div class="font-medium">{{faq.question}}</div>
							<div @click="activeAccordion == faq.id ? activeAccordion = null : activeAccordion = faq.id"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-gray-500" v-bind:class="activeAccordion == faq.id ? 'transform rotate-90':''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg>
							</div>
						</div>
						<div style="display:none" v-show="activeAccordion == faq.id" class="border-t p-2">
							{{faq.answer}}
						</div>
						
					</div>
				</div>
			</template>
			
			
		</div>
	</div>
</template>
<script setup>
import { ref } from 'vue';
let faqs = [
	{
		"id": 0,
		"question": "How to create a Form for a Button",
		"answer": ""
	},
	
	
]
const activeAccordion = ref(null);
const assetPath = ref(assetPath);

</script>