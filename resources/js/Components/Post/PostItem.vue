<template>
  <div class="bg-white p-4 mb-4">
    <div v-for="image in post.image_urls">
      <img :src="image" class="w-2/5">
    </div>
    <div>
      <Link :href="route('client.posts.show', post.id)">
      <h3 class="text-blue-950">{{ post.title }}</h3>
      </Link>
      <div class="flex justify-end">
        <LikeButton :content="post" @like="toggleLike"></LikeButton>
      </div>
    </div>
  </div>
</template>

<script lang='js'>
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'
import LikeButton from './LikeButton.vue';

export default defineComponent({
  name: 'PostItem',
  components: {
    Link,
    LikeButton
  },
  props: {
    post: Object
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
    toggleLike({ likedContent, onSuccess = () => { } }) {
      console.log('Like!')
      axios.post(route('client.posts.like.toggle', likedContent.id)).then(
        (res) => {
          this.commentData = res.data
          onSuccess(res.data)
          //this.post.who_liked_count = res.data.who_liked_count
        }
      )
    }
  },
});
</script>

<style scoped lang="css"></style>