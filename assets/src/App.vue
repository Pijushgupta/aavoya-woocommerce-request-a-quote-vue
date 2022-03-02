<template>
	<div>
	<Header/>
	<Content />
	</div> 
</template>
<script>
import Header from './components/Header'
import Content from './components/Content'


export default{
	name:'App',
	
	components:{
		Header,
		Content
	},
	
}
</script>