<template>
  <div class="w-1/3 mx-auto">
    <h1 class="text-center">Dashboard</h1>
    <div v-for="post in posts" class="bg-white p-4 mb-4">
      <div v-for="image in post.image_urls">
        <img :src="image" class="w-2/5">
      </div>
      <div>
        <Link :href="route('client.posts.show', post.id)">
        <h3 class="text-blue-950">{{ post.title }}</h3>
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang='js'>
import { defineComponent } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import { Link } from '@inertiajs/vue3';

export default defineComponent({
  name: 'Index',
  components: {
    Link
  },
  layout: ClientLayout,
  props: {
    // v-model
    posts: Array,
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