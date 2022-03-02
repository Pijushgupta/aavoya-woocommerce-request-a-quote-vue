<template>
	<!-- Shortcode row -->
	<div>
		<Row v-for="row in rows" v-bind:key="row.id" v-bind:row="row"/>
		<New/>
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
		openDrawer:function(){

		},
	},
	data: function(){
		return {
			rows:[]
		}
	},
	created:function(){
		this.rows = [
			{
				id:1,
				title:'Hello world',
				sc:'[awraq id="1"]',
				sop:{selected:'one',options:{one:'one',two:'two',three:'three',four:'four'}},
				drawer:{corners:24,paddingX:15,paddingY:7,fontWeight:300,backgroundColor:"#FF0000", hoverBackgroundColor:"#FF0000",textColor:"#FFFFFF",hoverTextColor:'#FFFFFF',buttonText:"Button",letterSpacing:1,fontSize:16,cssClass:"awraq",borderTab:false,borderType:"None",borderWidth:2,borderColor:"#000000"}

			},
			{
				id:2,
				title:'Hello world',
				sc:'[awraq id="2"]',
				sop:{selected:'one',options:{one:'two',two:'two',three:'three',four:'four'}},
				drawer:{corners:24,paddingX:15,paddingY:7,fontWeight:300,backgroundColor:"#FF0000", hoverBackgroundColor:"#FF0000",textColor:"#ffffff",hoverTextColor:'#ffffff',buttonText:"Button",letterSpacing:1,fontSize:16,cssClass:"awraq",borderTab:true,borderType:"Solid",borderWidth:2,borderColor:"#000000"}

			}

		]
	}
}
</script>