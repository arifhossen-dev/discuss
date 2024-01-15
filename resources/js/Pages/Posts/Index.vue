<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Container from '@/Components/Container.vue';

defineProps(['posts'])
</script>

<template>
  <AppLayout>
    <Container>
      <ul class="divide-y">
        <li v-for="(post, index) in posts" :key="index" class="px-2 py-4">
          <span class="font-bold text-large">{{ post.title }}</span>
        </li>
      </ul>
    </Container>
  </AppLayout>
</template>