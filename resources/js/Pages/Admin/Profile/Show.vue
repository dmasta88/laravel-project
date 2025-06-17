<template>
  <div>
    <div>
      <h1 class="p-4 text-2xl">{{ profile.login }}</h1>
      <p>{{ profile.second_name }}</p>
      <p>{{ profile.third_name }}</p>
      <p>{{ profile.avatar }}</p>
      <p>{{ profile.city }}</p>
      <Link :href="route('admin.profiles.index')">
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
  components: {
    Link
  },
  layout: AdminLayout,
  props: {
    // v-model
    profile: Object,
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