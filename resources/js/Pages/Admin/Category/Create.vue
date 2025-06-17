<template>
  <div>
    <h1 class="p-4 text-2xl">
      Create category
    </h1>
    <div class="p-2">
      <input v-model="categories.title" type="text" name="title" placeholder="Title" class="w-1/3">
    </div>
    <div class="py-4 px-2">
      <button href="#" @click.prevent="createCategory" type="button" class="bg-gray-600 p-4 text-white">Create</button>
    </div>
    <div class="p-2">
      <Link :href="route('admin.categories.index')" as="button" type="button" class="bg-blue-500 p-4 text-white">
      Back
      </Link>
    </div>
  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Create',
  components: {
    Link
  },
  layout: AdminLayout,
  methods: {
    createCategory() {
      axios.post(route('admin.categories.store'), this.categories)
        .then(res => {
          console.log(res)
        })
    }
  },

  data() {
    return {
      categories: {
      }
    };
  }
});
</script>

<style scoped lang="css"></style>