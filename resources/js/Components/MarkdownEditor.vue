<script setup>
import {EditorContent, useEditor} from "@tiptap/vue-3";
import {StarterKit} from "@tiptap/starter-kit";
import {watch} from "vue";
import {Markdown} from "tiptap-markdown";
import 'remixicon/fonts/remixicon.css';
import Link from '@tiptap/extension-link';

const props = defineProps({
    modelValue: ''
})

const emit = defineEmits(['update:modelValue'])
const editor = useEditor({
    extensions: [
        StarterKit.configure({
            heading: {
                levels: [2, 3, 4],
            },
        }),
        Link,
        Markdown
    ],
    editorProps: {
        attributes: {
            class: 'prose prose-sm max-w-none py-1.5 border px-3 min-h-[200px]',
        },
    },
    onUpdate: () => emit('update:modelValue', editor.value?.storage.markdown.getMarkdown()),
})

watch(() => props.modelValue, (value) => {
    if (value === editor.value?.storage.markdown.getMarkdown()) {
        return
    }
    editor.value?.commands.setContent(value);
}, {immediate: true})

const promptUserForHref = () => {
    if (editor.value?.isActive('link')) {
        return editor.value?.chain().unsetLink().run();
    }
    const href = prompt('Whre do you want to link to?');

    if (!href) {
        return editor.value.chain().focus().run();
    }

    return editor.value?.chain().focus().setLink({href}).run();
}
</script>

<template>
    <div v-if="editor"
         class="bg-white rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm mb-3">
        <menu class="flex divide-x border-b">
            <li>
                <button
                    :class="[editor.isActive('bold')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2 rounded-tl-md "
                    type="button"
                    @click="()=> editor.chain().focus().toggleBold().run()"
                >
                    <i class="ri-bold"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('italic')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="()=> editor.chain().focus().toggleItalic().run()"
                >
                    <i class="ri-italic"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('stick')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="()=> editor.chain().focus().toggleStrike().run()"
                >
                    <i class="ri-strikethrough"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('bulletList')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="()=> editor.chain().focus().toggleBulletList().run()"
                >
                    <i class="ri-list-check"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('orderedList')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="()=> editor.chain().focus().toggleOrderedList().run()"
                >
                    <i class="ri-list-ordered"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('link')?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="promptUserForHref"
                >
                    <i class="ri-link"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('heading', { level: 2 })?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                >
                    <i class="ri-h-1"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('heading', { level: 3 })?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                >
                    <i class="ri-h-2"></i>
                </button>
            </li>
            <li>
                <button
                    :class="[editor.isActive('heading', { level: 4 })?'bg-indigo-500 text-white': 'hover:bg-gray-200']"
                    class="px-3 py-2"
                    type="button"
                    @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                >
                    <i class="ri-h-3"></i>
                </button>
            </li>
        </menu>
        <EditorContent :editor="editor"/>
    </div>
</template>

<style scoped>

</style>
