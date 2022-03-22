<template>
	<div>
	<Header/>
	<Content />
	</div> 
</template>
<script>
import Header from './Components/Header'
import Content from './Components/Content'


export default{
	name:'App',
	
	components:{
		Header,
		Content
	},
	methods:{
		confirmpop();
	}
	
}
</script>