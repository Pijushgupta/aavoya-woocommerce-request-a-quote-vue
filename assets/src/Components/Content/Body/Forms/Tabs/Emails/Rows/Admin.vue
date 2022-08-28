<template>
	<div >
		<div class="input-group">
			<label>Sent to</label>
			<input type="text" class="w-full" placeholder="default <admin>">
		</div>
		<div class="input-group">
			<label>From name</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label>From email</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label>Reply to</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label>BCC</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label>Subject</label>
			<input type="text" class="w-full">
		</div>
		<div class="input-group">
			<label>Message</label>
			<textarea class="w-full"> </textarea>
		</div>
	</div>
</template>
<script setup>
const props = defineProps({
	id: Number
});

const getFormMeta = (function () {
	const data = new FormData();
	data.append('awraq_nonce', awraq_nonce);
	data.append('action', 'awraqGetFormMeta');
	data.append('id', props.id);
	fetch(awraq_ajax_path, {
		method: 'POST',
		credentials: 'same-origin',
		body: data
	})
		.then(res => res.json())
		.then(res => {
			console.log(res);
		})
		.catch(err => console.log(err));

}());

</script>