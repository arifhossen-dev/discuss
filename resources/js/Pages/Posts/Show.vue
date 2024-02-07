<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {computed, ref} from "vue";
import Pagination from "@/Components/Pagination.vue";
import {relativeDate} from "@/Utilities/date.js";
import Comment from "@/Components/Comment.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps(['post', 'comments'])

const formattedDate = computed(() => relativeDate(props.post.created_at));

const commentForm = useForm({
    body: '',
});

const commentTextareaRef = ref(null)

const commentIdBeingEdited = ref(null)

const commentBeingEdit = computed(() => props.comments.data.find(comment => comment.id === commentIdBeingEdited.value))

const editComment = (commentId) => {
    commentIdBeingEdited.value = commentId;
    commentForm.body = commentBeingEdit.value?.body
    commentTextareaRef.value?.focus();
}

const cancelEdit = () => {
    commentIdBeingEdited.value = null
    commentForm.reset()
}

const addComment = () => commentForm.post(route('posts.comments.store', props.post.id), {
    preserveScroll: true,
    onSuccess: () => commentForm.reset(),
});

const updateComment = () => commentForm.put(route('comments.update', {
    comment: commentIdBeingEdited.value,
    page: props.comments.meta.current_page,
}), {
    preserveScroll: true,
    onSuccess: cancelEdit
})

const deleteComment = (commentId) => router.delete(route('comments.destroy', {
    comment: commentId,
    page: props.comments.meta.current_page
}), {
    preserveScroll: true,
})
</script>

<template>
    <AppLayout>
        <container>
            <h2 class="text-2xl font-bold">{{ post.title }}</h2>
            <span class="text-sm text-gray-500">{{ formattedDate }} ago by <span
                class="font-bold">{{ post.user.name }}</span></span>

            <article class="mt-4">
                <pre class="whitespace-pre-wrap font-sans">
                {{ post.body }}
                </pre>
            </article>

            <div>
                <h2 class="border-b-4 font-bold text-2xl">Comments</h2>

                <form v-if="$page.props.auth.user"
                      @submit.prevent="()=>commentIdBeingEdited?updateComment():addComment()">
                    <div class="mt-3">
                        <InputLabel for="body" class="sr-only">Comment</InputLabel>
                        <TextArea ref="commentTextareaRef" id="body" rows="4" placeholder="Type your comment..."
                                  v-model="commentForm.body"></TextArea>
                        <InputError :message="commentForm.errors.body"/>
                    </div>

                    <PrimaryButton type="submit" :disabled="commentForm.processing" class="mt-3"
                                   v-text="commentIdBeingEdited?'Update comment':'Add comment'"></PrimaryButton>
                    <SecondaryButton v-if="commentIdBeingEdited" @click="cancelEdit" class="ml-2">Cancel
                    </SecondaryButton>
                </form>

                <ul class="divide-y">
                    <li v-for="(comment, index) in comments.data" :key="index" class="px-2 py-4 flex flex-col">
                        <Comment @edit="editComment" @delete="deleteComment" :comment="comment"/>

                    </li>
                </ul>
                <Pagination :meta="comments.meta" :only="['comments']"/>
            </div>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
