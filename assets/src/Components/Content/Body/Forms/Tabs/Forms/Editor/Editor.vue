<template>
	<div>
		<div v-if="editor" class="border border-b-0 rounded-t-lg p-1 flex flex-row flex-wrap items-center">
   <div class="basic-group inline-block ">
	  <button class="font-bold " @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">B</button>
    <button class="italic " @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">I</button>
		<button class="underline" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('strike') }">U</button>
    <button class="line-through " @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">S</button>
		
		</div>
    
    
		<div class="basic-group inline-block">
			<button 
				@click="editor.chain().focus().setParagraph().run()" 
				:class="{ 'is-active': editor.isActive('paragraph') }"
			>P</button>
    	<button 
				@click="editor.chain().focus().toggleHeading({ level: 1 }).run()" 
				:class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
			>h1</button>
    <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
      h2
    </button>
    <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
      h3
    </button>
    <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
      h4
    </button>
    <button @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
      h5
    </button>
    <button @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
      h6
    </button>
		</div>	
		<div class="basic-group inline-block">
    <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
      ul
    </button>
    <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
      ol
    </button>
		</div>
    
    <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
      <span>&#8220;</span>
    </button>
    <button @click="editor.chain().focus().setHorizontalRule().run()">
      hr
    </button>
		<div class="basic-group inline-block">
			<button @click="setLink">
      <svg class="w-3 " style="height:1.2rem;" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>insert-link</title> <desc>Created with sketchtool.</desc> <g id="text-edit" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="insert-link" fill="#000000" fill-rule="nonzero"> <path d="M11,9 L7,9 C5.34314575,9 4,10.3431458 4,12 C4,13.6568542 5.34314575,15 7,15 L11,15 L11,17 L7,17 C4.23857625,17 2,14.7614237 2,12 C2,9.23857625 4.23857625,7 7,7 L11,7 L11,9 Z M13,15 L17,15 C18.6568542,15 20,13.6568542 20,12 C20,10.3431458 18.6568542,9 17,9 L13,9 L13,7 L17,7 C19.7614237,7 22,9.23857625 22,12 C22,14.7614237 19.7614237,17 17,17 L13,17 L13,15 Z M9,11 L15,11 C15.5522847,11 16,11.4477153 16,12 C16,12.5522847 15.5522847,13 15,13 L9,13 C8.44771525,13 8,12.5522847 8,12 C8,11.4477153 8.44771525,11 9,11 Z" id="Shape"></path> </g> </g> </svg>
    </button>
		<button @click="editor.chain().focus().unsetLink().run()" :disabled="!editor.isActive('link')">
      <svg class="w-3 " style="height:1.2rem;" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <path fill="#444" d="M8 0h1v4h-1v-4z"></path> <path fill="#444" d="M8 12h1v4h-1v-4z"></path> <path fill="#444" d="M7 9h-4c-0.552 0-1-0.448-1-1s0.448-1 1-1h4v-2h-4c-1.657 0-3 1.343-3 3s1.343 3 3 3h4v-2z"></path> <path fill="#444" d="M13 5h-4v2h4c0.552 0 1 0.448 1 1s-0.448 1-1 1h-4v2h4c1.657 0 3-1.343 3-3s-1.343-3-3-3z"></path> <path fill="#444" d="M4.51 15.44l2.49-3.44h-1.23l-2.080 2.88 0.82 0.56z"></path> <path fill="#444" d="M12.49 15.44l-2.49-3.44h1.23l2.080 2.88-0.82 0.56z"></path> <path fill="#444" d="M12.49 0.99l-2.49 3.010h1.23l2.080-2.66-0.82-0.35z"></path> <path fill="#444" d="M4.51 0.99l2.49 3.010h-1.23l-2.080-2.66 0.82-0.35z"></path> </svg>
    </button>
		</div>
		
    <button @click="editor.chain().focus().setHardBreak().run()">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-3 " style="height:1.2rem;" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M3 7a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 13a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /> </svg>
    </button>
		<div class="basic-group inline-block"> 
    <button @click="editor.chain().focus().undo().run()">
      <svg fill="none" style="width: 11px; height: 11px;" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
    </button>
    <button @click="editor.chain().focus().redo().run()">
      <svg fill="none" style="transform:scaleX(-1);-webkit-transform: scaleX(-1); width: 11px; height: 11px;" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
    </button>
		</div>
	
  </div>
  <editor-content 
	:editor="editor" 
	class="border p-4 rounded-b-lg prose xs:prose-xs sm:prose-sm lg:prose-lg prose-slate w-full"
	/>
	</div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Underline from '@tiptap/extension-underline';


export default {
	name: 'Editor',
  components: {
    EditorContent,
  },

  props: {
    modelValue: Object,
  },

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      // HTML
     // const isSame = this.editor.getHTML() === value

      // JSON
      const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },

  mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit,
				Underline,
				Link.configure({
          openOnClick: false,
        }),
      ],
      content:this.modelValue,
		
      onUpdate: () => {
        // HTML
        //this.$emit('update:modelValue', this.editor.getHTML())

        // JSON
        this.$emit('update:modelValue', this.editor.getJSON())
      },
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },

	methods: {
		setLink() {
      const previousUrl = this.editor.getAttributes('link').href
      const url = window.prompt('URL', previousUrl)

      // cancelled
      if (url === null) {
        return
      }

      // empty
      if (url === '') {
        this.editor
          .chain()
          .focus()
          .extendMarkRange('link')
          .unsetLink()
          .run()

        return
      }

      // update link
      this.editor
        .chain()
        .focus()
        .extendMarkRange('link')
        .setLink({ href: url })
        .run()
    }
	},
}
</script>
<style  scoped>
button {
	padding: 5px 10px;
	border: 1px solid #ccc;
	margin: 1px;
	border-radius: 0.25rem;
}
.basic-group button {
	border-right: 0;
	margin: 0;
	border-radius: 0;
	min-height: 31px;
}
.basic-group button:first-child {
	margin-left: 1px;
	border-left: 1px solid #ccc;
	border-top-left-radius: 0.25rem;
	border-bottom-left-radius: 0.25rem;
}
.basic-group button:last-child {
	margin-right: 1px;
	border-right: 1px solid #ccc;
	border-top-right-radius: 0.25rem;
	border-bottom-right-radius: 0.25rem;
}

.is-active {
	background-color: rgb(59 130 246);
	color: #fff;
	border: 1px solid rgb(59 130 246);
}
</style>