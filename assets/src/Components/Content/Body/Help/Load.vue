<template>
	<div class="w-full flex lg:flex-row flex-col flex-wrap bg-white border rounded-lg p-2 ">
		<template v-for="faq in faqs" v-bind:key="faq.id">
			<div class="w-full lg:w-1/2 p-2">
				<div class="border rounded-lg p-2">
					<div class="flex flex-row justify-between items-center">
						<div>{{faq.question}}</div>
						<div><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg>
						</div>
					</div>
					<div style="display:none">
						{{faq.answer}}
					</div>
					
				</div>
			</div>
		</template>
		
		
	</div>
</template>
<script setup>
let faqs = [
	{ "id": 0, "question": "How to create a Button", "answer": "hejek" },
	{ "id":1, "question": "How to create a Button", "answer": "hejek" }
	
]
</script>