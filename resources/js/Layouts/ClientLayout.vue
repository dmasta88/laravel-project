<template>
  <section>
    <header class="flex items-center justify-center h-20 bg-gray-200">
      <div class="text-center">header</div>
    </header>
  </section>
  <section class="">
    <article class="flex justify-center w-full p-2 bg-gray-100">
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
  name: 'ClientLayout',
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