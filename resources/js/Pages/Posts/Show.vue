<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {computed} from "vue";
import Pagination from "@/Components/Pagination.vue";
import {relativeDate} from "@/Utilities/date.js";
import Comment from "@/Components/Comment.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";

const prop = defineProps(['post', 'comments'])

const formattedDate = computed(() => relativeDate(prop.post.created_at));

const commentForm = useForm({
    body: '',
});
const addComment = () => commentForm.post(route('posts.comments.store', prop.post.id), {
    preserveScroll: true,
    onSuccess: () => commentForm.reset(),
});

const deleteComment = (commentId) => router.delete(route('comments.destroy', {comment: commentId, page: prop.comments.meta.current_page}), {
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

                <form v-if="$page.props.auth.user" @submit.prevent="addComment">
                    <div class="mt-3">
                        <InputLabel for="body" class="sr-only">Comment</InputLabel>
                        <TextArea id="body" rows="4" placeholder="Type your comment..."
                                  v-model="commentForm.body"></TextArea>
                        <InputError :message="commentForm.errors.body"/>
                    </div>

                    <PrimaryButton type="submit" :disabled="commentForm.processing" class="mt-3">Add Comment
                    </PrimaryButton>
                </form>

                <ul class="divide-y">
                    <li v-for="(comment, index) in comments.data" :key="index" class="px-2 py-4 flex flex-col">
                        <Comment @delete="deleteComment" :comment="comment"/>

                    </li>
                </ul>
                <Pagination :meta="comments.meta" :only="['comments']"/>
            </div>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
