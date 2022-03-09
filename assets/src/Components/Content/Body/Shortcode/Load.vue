<template>
	<!-- Shortcode row -->
	<div>
		<Row v-for="row in rows" v-bind:key="row.id" v-bind:row="row" v-on:save-drawer="saveDrawer" v-on:delete-row='deletePost'/>
		<New v-on:create-post='createPost' />
	</div>
	<!-- Shortcode row ends-->
</template>
<script>
import Row from './Load/Row'
import New from './Load/New'
export default{
	name:'Load',
	components:{
		Row,
		New
	},
	methods:{
		/* Create Post*/
		createPost:function(){
			const data = new FormData();
			data.append('action','awraqCreatePost');
			data.append('awraq_nonce',awraq_nonce);
			fetch(awraq_ajax_path,{
				method:"POST",
				credentials: 'same-origin',
				body:data
				})
			.then((response) => response.json())
			.then(response => {
				console.log(response)
			})
			.catch(err => console.log(err));
		},
		/*Delete Post*/
		deletePost: function (drawerId){
			if(this.deleteQueue === false){
				this.deleteQueue === true;

				const data =  new FormData();
				data.append('action','awraqDeletePost');
				data.append('awraq_nonce',awraq_nonce);
				data.append('post_id',drawerId);
				
				fetch(awraq_ajax_path,{
					method:"POST",
					credentials:"same-origin",
					body:data
				})
				.then(response => response.json())
				.then(response => {
					if(response === true){
						this.deleteARow(drawerId);
					}
				})
				.catch(err => console.log(err));
			}
		},
		deleteARow: function(drawerId){
			this.rows = this.rows.filter((row) =>{
				if(row.id != drawerId){
					return row;
				}
			});
		},
		getRows: function(){
			const data = new FormData();
			data.append('action','awraqLoadPost');
			data.append('awraq_nonce',awraq_nonce);
			fetch(awraq_ajax_path,{
				method:"POST",
				credentials:"same-origin",
				body: data
			})
			.then((response) => response.json())
			.then((response) => {
				if(response !== null){
					console.log(response)
					this.rows = response
				}
			})
			.catch(err => console.log(err));
		},

		saveDrawer: function(drawer,drawerId){
			const data = new FormData();
			data.append('action','awraqtest');
			fetch(awraq_ajax_path,{
				method:'POST',
				credentials:'same-origin',
				body:data
			})
			.then(response => response.json())
			.then(response =>{
				console.log(response)
			})
			.catch(err=>console.log(err));
		}
	},
	data: function(){
		return {
			rows:[],
			deleteQueue:false,
		}
	},
	created:function(){
		this.getRows();
		
	}
}
</script>