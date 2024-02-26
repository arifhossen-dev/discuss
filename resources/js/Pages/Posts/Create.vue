<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import TextArea from "@/Components/TextArea.vue";
import MarkdownEditor from "@/Components/MarkdownEditor.vue";

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
                        <TextInput id="title" v-model="form.title" class="w-full" placeholder="Enter title here..."/>
                        <InputError :message="form.errors.title"/>
                    </div>
                    <div class="mt-3">
                        <InputLabel for="body">Body</InputLabel>
                        <MarkdownEditor v-model="form.body"/>
                        <TextArea id="body" v-model="form.body" class="w-full rounded" rows="8"></TextArea>
                        <InputError :message="form.errors.body"/>
                    </div>

                    <PrimaryButton :disabled="form.processing" class="mt-3" type="submit">Submit</PrimaryButton>
                </form>

            </div>
        </container>
    </AppLayout>
</template>

<style scoped>

</style>
