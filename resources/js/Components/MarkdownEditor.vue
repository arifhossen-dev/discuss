<script setup>
import {EditorContent, useEditor} from "@tiptap/vue-3";
import {StarterKit} from "@tiptap/starter-kit";
import {watch} from "vue";
import {Markdown} from "tiptap-markdown";

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
        <EditorContent :editor="editor"/>
    </div>
</template>

<style scoped>

</style>
