<template>
	<!-- Shortcode row -->
	<div>
		<ul v-if="rows.length != 0">
		<Row 
		v-for="row in rows" 
		v-bind:key="row.id" 
		v-bind:row="row" 
		v-on:save-a-row="saveARow" 
		v-on:delete-row='deletePost' 
		
		/>
		</ul>
		<div  v-else class="bg-white rounded-lg ">
			<div class="container mx-auto md:w-7/12 py-10 flex flex-col items-center">
				<h2 class="inline text-2xl font-semibold text-gray-600  tracking-wide mb-4">RAQ Button</h2>
				<p class="text-md font-semibold text-gray-500"> Create button(s) by clicking the button below.</p>
				<a v-on:click.prevent="createPost" class="bg-white border px-4 py-2 rounded-full text-gray-500 font-semibold capitalize mt-4 cursor-pointer">
				<svg xmlns="http://www.w3.org/2000/svg" class="inline fill-current w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>Create</a> 
			</div>
		 </div>
		<New v-if="rows.length != 0" v-on:create-post='createPost' />
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

				this.rows.unshift(response[0]);
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
						toast("Button Deleted");
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
					this.rows = response;
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
					toast("Nothing to Update");
				}
					
				
			})
			.catch(function(err){console.log(err)});
			
		},

		
		
	},
	
}
</script>