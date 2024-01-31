<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {formatDistance, parseISO} from "date-fns";
import {computed} from "vue";

const prop = defineProps(['post'])

const formattedDate = computed(()=>formatDistance(parseISO(prop.post.created_at),new Date()))
</script>

<template>
    <AppLayout>
        <container>
            <h2 class="text-2xl font-bold">{{ post.title}}</h2>
            <span class="text-sm text-gray-500">{{ formattedDate}} ago by <span class="font-bold">{{post.user.name}}</span></span>

            <article class="mt-4">
                <pre class="whitespace-pre-wrap font-sans">
                {{ post.body}}
                </pre>
            </article>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
