<template>
  <div class="w-1/3 mx-auto">
    <h1 class="text-center text-xl my-4 text-black">My profile</h1>
    <img :src="profile.avatar" class="mx-auto rounded-full">

    <h3 class="text-center text-xl my-4 text-black">{{ profile.login }}</h3>
    <PostItem v-for="post in posts" :post="post"></PostItem>
  </div>
</template>

<script lang="js">
import { defineComponent } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import { Link } from '@inertiajs/vue3';
import PostItem from '@/Components/Post/PostItem.vue';

export default defineComponent({
  name: 'Self',
  components: {
    Link,
    PostItem
  },
  layout: ClientLayout,
  props: {
    // v-model
    posts: Array,
    profile: Object
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
