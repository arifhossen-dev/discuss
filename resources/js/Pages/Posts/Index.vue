<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Container from '@/Components/Container.vue';
import Pagination from '@/Components/Pagination.vue';
import {Link} from '@inertiajs/vue3';
import {relativeDate} from "@/Utilities/date.js";

defineProps(['posts'])
const formattedDate = (post) => relativeDate(post.created_at)
</script>

<template>
    <AppLayout>
        <Container>
            <ul class="divide-y">
                <li v-for="(post, index) in posts.data" :key="index" class="px-2 py-4">
                    <Link :href="post.route.show" class="flex flex-col group">
                        <span class="font-bold group-hover:text-indigo-500 text-large">{{ post.title }}</span>
                        <span class="text-sm text-gray-500">{{ formattedDate(post) }} ago by <span
                            class="font-bold">{{ post.user.name }}</span></span>
                    </Link>
                </li>
            </ul>
            <Pagination :meta="posts.meta"/>
        </Container>
    </AppLayout>
</template>
