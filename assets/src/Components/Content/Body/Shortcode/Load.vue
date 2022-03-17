<template>
	<!-- Shortcode row -->
	<div>
		<Row 
		v-for="row in rows" 
		v-bind:key="row.id" 
		v-bind:row="row" 
		v-on:save-a-row="saveARow" 
		v-on:delete-row='deletePost' 
		v-on:toggle-state = "toggleState" 
		v-bind:state="state" 
		
		 />
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
	data: function(){
		return {
			rows:[],
			deleteQueue:false,

			/* States */
			state:{
				buttonCornersAndPadding:false,
				buttonText:false,
				buttonShadow:false,
				buttonColor:false,
				buttonBorder:false,
				buttonCssClass:false,
				formCornersAndPadding:false,
				formColor:false,
				formShadow:false,
				formCssClass:false,
				xButton:false,
				xButtonShadow:false,
				xButtonCssClass:false
			}
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
				console.log(response)
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
				
				console.log(response)
			})
			.catch(function(err){console.log(err)});
			
		},

		toggleState: function(statename){
			
			switch(statename){
				case "buttonCornersAndPadding":
					this.state.buttonCornersAndPadding = !this.state.buttonCornersAndPadding;
					break;
				case "buttonText":
					this.state.buttonText = !this.state.buttonText;
					break;
				case "buttonShadow":
					this.state.buttonShadow = !this.state.buttonShadow;
					break;
				case "buttonColor":
					this.state.buttonColor = !this.state.buttonColor;
					break;
				case "buttonBorder":
					this.state.buttonBorder = !this.state.buttonBorder;
					break;
				case "buttonCssClass":
					this.state.buttonCssClass = !this.state.buttonCssClass;
					break;
				case "formCornersAndPadding":
					this.state.formCornersAndPadding = !this.state.formCornersAndPadding;
					break;
				case "formColor":
					this.state.formColor = !this.state.formColor;
					break;
				case "formShadow":
					this.state.formShadow = !this.state.formShadow;
					break;
				case "formCssClass":
					this.state.formCssClass = !this.state.formCssClass;
					break;
				case "xButton":
					this.state.xButton = !this.state.xButton;
					break;
				case "xButtonShadow":
					this.state.xButtonShadow = !this.state.xButtonShadow;
					break;
				case "xButtonCssClass":
					this.state.xButtonCssClass = !this.state.xButtonCssClass;
					break;
				default:
					break;
			}
				
		},
		
	},
	
}
</script>