<script setup>
import {relativeDate} from "@/Utilities/date.js";

const props = defineProps(['comment'])

const emit = defineEmits(['edit', 'delete'])
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
            <div class="flex items-center justify-end">
                <div v-if="comment.can?.update" class="mt-1 text-right empty:hidden">
                    <form @submit.prevent="$emit('edit',comment.id)">
                        <button class="mr-2 rounded border hover:font-bold hover:bg-gray-200 px-1 text-sm"
                                type="submit">Edit
                        </button>
                    </form>
                </div>

                <div v-if="comment.can?.delete" class="mt-1 text-right empty:hidden">
                    <form @submit.prevent="$emit('delete',comment.id)">
                        <button
                            class="text-red-500 mr-2 bg-red-200 hover:font-bold rounded hover:bg-red-300 hover:text-red-500 px-1 text-sm"
                            type="submit"> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>


<style scoped>

</style>
