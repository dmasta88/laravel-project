<template>
  <div>
    <div class="flex justify-between p-4">
      <h1 class="text-2xl"> Profiles</h1>

      <div>
        <Link :href="route('admin.profiles.create')" class="p-4 bg-blue-800 text-white">Create</Link>
      </div>
    </div>
    <table class="border-collapse border border-gray-200 table-auto w-full text-sm">
      <thead class="bg-gray-100 dark:bg-slate-800">
        <tr>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            ID</th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Login</th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white dark:bg-slate-800">
        <tr v-for="profile in profiles" class="border-b border-gray-200">
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            {{ profile.id }}
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <Link :href="route('admin.profiles.show', profile.id)">{{ profile.login }}</Link>
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
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
  components: {
    Link
  },
  layout: AdminLayout,
  props: {
    // v-model
    profiles: Array,
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