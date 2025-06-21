<template>
  <section>
    <header class="flex items-center justify-center h-20 bg-gray-200">
      <div class="text-center">header</div>
    </header>
  </section>
  <section class="flex">
    <aside class="bg-gray-300 w-1/4">
      <Link :href="route('admin.posts.index')" class="block p-4 border-gray-500 bg-gray-700 text-gray-100">
      Posts
      </Link>
      <Link :href="route('admin.categories.index')" class="block p-4 border-gray-500 bg-gray-700 text-gray-100">
      Categories
      </Link>
      <Link :href="route('admin.tags.index')" class="block p-4 border-gray-500 bg-gray-700 text-gray-100">
      Tags
      </Link>
      <Link :href="route('admin.profiles.index')" class="block p-4 border-gray-500 bg-gray-700 text-gray-100">
      Profiles
      </Link>
      <Link :href="route('admin.roles.index')" class="block p-4 border-gray-500 bg-gray-700 text-gray-100">
      Roles
      </Link>
    </aside>
    <article class="p-2 bg-gray-100 w-3/4">
      <slot />
    </article>
  </section>
  <section>
    <footer class="flex items-center justify-center h-32 bg-gray-200">
      <div class="text-center">footer</div>
    </footer>
  </section>
</template>

<script lang='js'>
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'AdminLayout',
  components: {
    Link
  },
  props: {
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