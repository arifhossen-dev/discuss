<script setup>
import {relativeDate} from "@/Utilities/date.js";
import {router, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps(['comment'])

const emit = defineEmits(['delete'])
</script>

<template>
    <div class="flex-1">
        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
            <img :alt="comment.user.name" :src="comment.user.profile_photo_url" class="h-10 wh-10 rounded-full">
        </div>
        <div>
            <p class="mt-1 break-all">{{ comment.body }}</p>
            <span class="text-sm text-gray-500">{{ relativeDate(comment.created_at) }} ago by <span
                class="font-bold">{{ comment.user.name }}</span></span>
            <div v-if="comment.can?.delete" class="mt-1 text-right empty:hidden">
                <form @submit.prevent="$emit('delete',comment.id)">
                    <button class="text-red-500 mr-2 bg-red-200 rounded hover:bg-red-300 hover:text-red-500 px-1 text-sm" type="submit">Delete</button>
                </form>

            </div>
        </div>

    </div>
</template>


<style scoped>

</style>
