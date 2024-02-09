<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import TextArea from "@/Components/TextArea.vue";

const form = useForm({
    title: '',
    body: '',
});

const createPost = () => form.post(route('posts.store'));
</script>

<template>
    <AppLayout title="Create a post">
        <container>
            <h2 class="text-2xl font-bold">Create a Post</h2>

            <div>
                <form @submit.prevent="createPost">
                    <div class="mt-3">
                        <InputLabel for="title">Title</InputLabel>
                        <TextInput class="w-full" id="title" v-model="form.title" placeholder="Enter title here..."/>
                        <InputError :message="form.errors.title"/>
                    </div>
                    <div class="mt-3">
                        <InputLabel for="body">Body</InputLabel>
                        <TextArea id="body" v-model="form.body" rows="8" class="w-full rounded"></TextArea>
                        <InputError :message="form.errors.body"/>
                    </div>

                    <PrimaryButton type="submit" :disabled="form.processing" class="mt-3">Submit</PrimaryButton>
                </form>

            </div>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
