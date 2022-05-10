<template>
	<div>
		<div v-if="editor" class="border border-b-0 rounded-t p-1 flex flex-row flex-wrap items-center">
   <div class="basic-group inline-block ">
	  <button class="font-bold " @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">B</button>
    <button class="italic " @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">I</button>
		<button class="underline" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('strike') }">U</button>
    <button class="line-through " @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">S</button>
		
		</div>
    
    
		<div class="basic-group inline-block">
			<button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">P</button>
    <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
      h1
    </button>
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
  <editor-content :editor="editor" class="border p-4 rounded-b prose xs:prose-xs sm:prose-sm lg:prose-lg prose-slate w-full"/>
	</div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';


export default {
  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      // JSON
      // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

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
      ],
      content: this.modelValue,
      onUpdate: () => {
        // HTML
        this.$emit('update:modelValue', this.editor.getHTML())

        // JSON
        // this.$emit('update:modelValue', this.editor.getJSON())
      },
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>
<style language="postcss" scoped>
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