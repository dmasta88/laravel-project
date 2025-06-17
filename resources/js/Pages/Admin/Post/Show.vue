<template>
  <div>
    <h1 class="p-4 text-2xl">
      {{ post.title }}
    </h1>
    <p class="p-4">
      {{ post.content }}
    </p>
    <p class="p-4">
      by {{ post.profile_id }}
    </p>
    <p class="p-4" v-if="post.image_url">
      <img v-for="image_url in post.image_url" :src="image_url" :alt="post.title">
    </p>
    <div class="p-4">
      <Link :href="route('admin.posts.index')" as="button" type="button" class="bg-blue-500 p-4 text-white">
      Back
      </Link>
    </div>
  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Show',
  props: {
    post: Object
  },
  layout: AdminLayout,
  components: {
    Link
  }
});
</script>

<style scoped lang="css"></style>