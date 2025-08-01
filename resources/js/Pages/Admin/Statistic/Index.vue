<template>
  <div>
    <h1 class="p-4 text-2xl">Statistics</h1>
    <div class="p-4">
      <table class="border-collapse border border-gray-200 table-auto w-full text-sm">
        <thead class="bg-gray-100 dark:bg-slate-800">
          <tr>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Date
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Posts count
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Comments count
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Likes count
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Views count
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Likes/views
            </th>
            <th
              class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
              Likes/comments
            </th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
          <tr v-if="statistics.length === 0">
            <td colspan="100%" class="text-center text-gray-500 py-4">Нет записей</td>
          </tr>
          <tr v-for="statistic in statistics" class="border-b border-gray-200">
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.date }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.posts_count }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.comments_count }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.likes_count }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.views_count }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.likes_views }}
            </td>
            <td
              class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
              {{ statistic.likes_comments }}
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Index',
  components: {
    Link
  },
  layout: AdminLayout,
  props: {
    statistics: Array,
    // v-model
    modelValue: {
      default: '',
    },
  },
  emits: {
    // v-model event with validation
    'update:modelValue': (value) => value !== null,
  },
  data() {
    return {
    };
  },
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      },
    },
  },
  watch: {
    modelValue: {
      async handler(_newValue, _oldValue) {
        // do something
      },
      immediate: true
    },
  },
  beforeMount() {
  },
  mounted() {
  },
  updated() {
  },
  beforeUnmount() {
    // stop the wacher on modelValue
    this.$watch('modelValue', () => { }, {});
  },
  methods: {
  },
});
</script>

<style scoped lang="css"></style>