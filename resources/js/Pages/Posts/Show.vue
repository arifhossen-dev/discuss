<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {computed} from "vue";
import Pagination from "@/Components/Pagination.vue";
import {relativeDate} from "@/Utilities/date.js";
import Comment from "@/Components/Comment.vue";

const prop = defineProps(['post', 'comments'])

const formattedDate = computed(() => relativeDate(prop.post.created_at));
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

                <ul class="divide-y">
                    <li v-for="(comment, index) in comments.data" :key="index" class="px-2 py-4 flex flex-col">
                        <Comment :comment="comment"/>
                        
                    </li>
                </ul>
                <Pagination :meta="comments.meta"/>
            </div>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
