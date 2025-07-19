<template>
  <div class="modal-shadow w-full fixed h-screen" v-if="modalIsActive" @click="modalIsActive = !modalIsActive">
    <div class="modal-wrapper flex justify-center items-center h-full">
      <div class="modal-body w-1/2 bg-white min-h-36" @click.stop>
        <div class="modal-content p-4">Body modal</div>
      </div>
    </div>
  </div>
  <div class="bg-white p-4 mb-4">
    <div v-for="image in post.image_urls">
      <img :src="image" class="w-2/5" />
    </div>
    <div>
      <div>
        <Link :href="route('client.posts.show', post.id)">
        <h3 class="text-blue-950">{{ post.title }}</h3>
        </Link>
      </div>
      <div class="flex justify-between item-footer my-3">
        <LikeButton :content="post" @like="toggleLike"></LikeButton>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-5">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-5 cursor-pointer" @click="modalActive">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
        </svg>
      </div>
    </div>
  </div>
</template>

<script lang="js">
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
      modalIsActive: false
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
    modalActive() {
      this.modalIsActive = !this.modalIsActive

    },

    toggleLike({ likedContent, onSuccess = () => { } }) {
      console.log('Like post item!')
      axios.post(route('client.posts.like.toggle', likedContent.id)).then(
        (res) => {
          this.post.is_liked = res.data.is_liked
          this.post.liked_count = res.data.liked_count
          onSuccess(res.data)
          //this.post.who_liked_count = res.data.who_liked_count
        }
      )
    }
  },
});
</script>

<style scoped lang="css">
.modal-shadow {
  background-color: rgba(128, 128, 128, 0.403);
  position: absolute;
  top: 0;
  left: 0;
}
</style>
