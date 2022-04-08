<template>
	<div class="bg-white border rounded-lg">
		<div class="flex flex-col justify-around items-center py-2 my-10">
		<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">Woocommerce is not Active or Installed</h2>
		<p class="text-md font-semibold text-gray-500">Its not necessary to have Woocommerce to use Aavoya RAQ. <a class="font-bold" href="">Detailed Guide</a> to use Avvoya RAQ without Woocommerce.</p>
		<a href="/wp-admin/plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4"><svg xmlns="http://www.w3.org/2000/svg" class="svg-class fill-current" viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>Install / Activate</a> 
		</div>
	</div>
</template>
<script>
export default {
	name:'Nocommerce'
}
</script>
