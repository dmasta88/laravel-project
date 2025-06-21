<template>
  <div>
    <div class="flex justify-between p-4">
      <h1 class="text-2xl">Tags Index</h1>
      <div>
        <Link :href="route('admin.tags.create')" class="p-4 bg-blue-800 text-white">Create</Link>
      </div>
    </div>
    <div v-for="tag in tags" class="border p-4">
      <Link :href="route('admin.tags.show', tag.id)">{{ tag.title }}</Link>
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
  components: {
    Link
  },
  props: {
    tags: Array
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