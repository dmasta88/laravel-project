<template>
  <div>
    <h1 class="p-4 text-2xl">
      {{ category.title }}
    </h1>
    <div class="p-4">
      <Link :href="route('admin.categories.index')">
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
  layout: AdminLayout,
  props: {
    category: Object
  },
  components:
  {
    Link
  }
});
</script>

<style scoped lang="css"></style>