<template>
	<!-- Shortcode row -->
	<div>
		<Row 
		v-for="row in rows" 
		v-bind:key="row.id" 
		v-bind:row="row" 
		v-on:save-a-row="saveARow" 
		v-on:delete-row='deletePost' 
		
		/>
		
		<New v-on:create-post='createPost' />
	</div>
	<!-- Shortcode row ends-->
</template>
<script>
import Row from './Load/Row'
import New from './Load/New'
import { useToast } from 'vue-toastification'
export default{
	name:'Load',
	components:{
		Row,
		New
	},
	data: function(){
		return {
			rows:[],
			deleteQueue:false,

			
		}
	},
	created:function(){
		this.getRows();	
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
				this.rows.unshift(response[0])
				const toast = useToast();
				toast("Button Added");
				
				
			})
			.catch(err => console.log(err));
		},
		/*Delete Post from database*/
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
						const toast = useToast();
						toast.error("Button Deleted");
					}
				})
				.catch(err => console.log(err));
			}
		},
		/* Delete a post form View/DOM */
		deleteARow: function(drawerId){
			this.rows = this.rows.filter((row) =>{
				if(row.id != drawerId){
					return row;
				}
			});
		},
		/* Getting all the rows */
		getRows: function(){
			const data = new FormData();
			data.append('action','awraqLoadPost');
			data.append('awraq_nonce',awraq_nonce);
			fetch(awraq_ajax_path,{
				method:"POST",
				credentials:"same-origin",
				body: data
			})
			.then((response) => {
				if(response.ok){
					return response.json();
				}else{
					return null;
				}
				
			})
			.then((response) => {
				if(response !== null){
					console.log(response)
					this.rows = response
				}
			})
			.catch(err => console.log(err));
		},

		saveARow: function(drawerId,title, fs , drawer, formDrawer){

			const data = new FormData();
			data.append('action','awraqSavePost');
			data.append('awraq_nonce',awraq_nonce);

			data.append('drawerId',drawerId);
			data.append('title',title);
			data.append('fs',fs);
			data.append('drawer',JSON.stringify(drawer));
			data.append('formDrawer',JSON.stringify(formDrawer));

			fetch(awraq_ajax_path,{
				method:"POST",
				credentials:"same-origin",
				body: data,
				
			})
			.then(function(response){ return response.json()})
			.then(function(response){ 
				
				if(response === true ) {
					 const toast = useToast(); 
					 toast("Button Updated");
				}
				if(response === false){
					const toast = useToast(); 
					toast.error("Nothing to Update");
				}
				console.log(response);	
				
			})
			.catch(function(err){console.log(err)});
			
		},

		
		
	},
	
}
</script>