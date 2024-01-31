<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Container from '@/Components/Container.vue';
import Pagination from '@/Components/Pagination.vue';
import {Link} from '@inertiajs/vue3';
import {formatDistance, parseISO} from "date-fns";

defineProps(['posts'])
const formattedDate = (post) => formatDistance(parseISO(post.created_at), new Date())
</script>

<template>
    <AppLayout>
        <Container>
            <ul class="divide-y">
                <li v-for="(post, index) in posts.data" :key="index" class="px-2 py-4">
                    <Link class="flex flex-col group" :href="route('posts.show', post.id)">
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
