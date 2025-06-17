<template>
  <div>
    <div class="flex justify-between p-4">
      <h1 class="text-2xl">
        Category Index
      </h1>
      <div>
        <Link :href="route('admin.categories.create')" class="p-4 bg-blue-800 text-white">Create</Link>
      </div>
    </div>
    <div v-for="category in categories" class="p-4 border border-gray-50">
      <Link :href="route('admin.categories.show', category.id)">
      {{ category.title }}
      </Link>
    </div>

  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Index',
  layout: AdminLayout,
  props: {
    categories: Array
  },
  components: {
    Link
  }
});
</script>

<style scoped lang="css"></style>