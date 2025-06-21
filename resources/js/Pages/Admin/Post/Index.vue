<template>
  <div>
    <div class="flex justify-between p-2">
      <h1 class="text-2xl">
        Admin Index
      </h1>
      <!-- <a href="#" class="p-4 bg-blue-800 text-white">Create post</a> -->
      <Link :href="route('admin.posts.create')" class="px-4 py-2 bg-blue-800 text-white">Create post</Link>
    </div>
    <table class="border-collapse border border-gray-200 table-auto w-full text-sm">
      <thead class="bg-gray-100 dark:bg-slate-800">
        <tr>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            ID</th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Заголовок</th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Опции</th>
        </tr>
      </thead>
      <tbody class="bg-white dark:bg-slate-800">
        <tr v-for="post in posts" class="border-b border-gray-200">
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            {{ post.id }}
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <Link :href="route('admin.posts.show', post.id)">{{ post.title }}</Link>
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <Link :href="route('admin.posts.edit', post.id)">Edit</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Index',
  props: {
    posts: Array
  },
  layout: AdminLayout,
  components: {
    Link
  }
});
</script>

<style scoped lang="css"></style>