<script setup>
import {relativeDate} from "@/Utilities/date.js";

defineProps(['comment'])
</script>

<template>
    <div class="sm:flex">
        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
            <img :src="comment.user.profile_photo_url" class="h-10 wh-10 rounded-full">
        </div>
        <div>
            <p class="mt-1 break-all">{{comment.body}}</p>
            <span class="text-sm text-gray-500">{{ relativeDate(comment.created_at) }} ago by <span
                class="font-bold">{{ comment.user.name }}</span></span>
        </div>

    </div>
</template>


<style scoped>

</style>
