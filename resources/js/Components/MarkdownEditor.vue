<script setup>
import {EditorContent, useEditor} from "@tiptap/vue-3";
import {StarterKit} from "@tiptap/starter-kit";
import {watch} from "vue";
import {Markdown} from "tiptap-markdown";
import 'remixicon/fonts/remixicon.css'

const props = defineProps({
    modelValue: ''
})

const emit = defineEmits(['update:modelValue'])
const editor = useEditor({
    extensions: [
        StarterKit,
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
</script>

<template>
    <div class="bg-white rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm mb-3">
        <menu class="flex divide-x border-b">
            <li>
                <button class="px-3 py-2 rounded-tl-md hover:bg-gray-200" type="button">
                    <i class="ri-bold"></i>
                </button>
            </li>
            <li>
                <button class="px-3 py-2 hover:bg-gray-200" type="button">
                    <i class="ri-italic"></i>
                </button>
            </li>
            <li>
                <button class="px-3 py-2 hover:bg-gray-200" type="button">
                    <i class="ri-strikethrough"></i>
                </button>
            </li>
            <li>
                <button class="px-3 py-2 hover:bg-gray-200" type="button">
                    <i class="ri-list-check"></i>
                </button>
            </li>
            <li>
                <button class="px-3 py-2 hover:bg-gray-200" type="button">
                    <i class="ri-list-ordered"></i>
                </button>
            </li>
        </menu>
        <EditorContent :editor="editor"/>
    </div>
</template>

<style scoped>

</style>
