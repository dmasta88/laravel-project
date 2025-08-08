<template>
  <div class="modal-shadow w-full fixed h-screen" v-if="modalIsActive" @click="modalIsActive = !modalIsActive">
    <div class="modal-wrapper flex justify-center items-center h-full">
      <div class="modal-body w-1/2 bg-white" @click.stop>
        <div class="modal-content p-4">
          <h2>Repost</h2>
          <div class="p-2">
            <input v-model="entries.post.title" type="text" name="title" placeholder="Title" class="w-full">
          </div>
          <div v-if="errors['post.title']">
            <p v-for="error in errors['post.title']" class="m-2 p-4 bg-red-500 text-white w-full">
              {{ error }}
            </p>
          </div>
          <div class="p-2">
            <textarea v-model="entries.post.content" type="text" name="content" placeholder="Content"
              class="w-full"></textarea>
          </div>
          <h5 class="text-xl my-4">{{ post.title }}</h5>
          <div class="flex justify-between mb-4">
            <p class="text-gray-500 text-sm">{{ post.profile.login }}</p>
            <p class="text-gray-500 text-sm">{{ post.date_formatted }}</p>
          </div>
          <div class="flex justify-center">
            <PrimaryButton @click="repost">Repost</PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white p-4 mb-4">
    <div v-for="image in post.image_urls">
      <img :src="image" class="w-2/5" />
    </div>
    <div>
      <div class="text-gray-400">
        {{ post.profile.login }}
      </div>
      <div class="mb-4 text-sm text-gray-500">
        {{ post.date_formatted }}
      </div>
      <div class="title-item" v-if="!post.parent_id">
        <Link :href="route('client.posts.show', post.id)">
        <h3 class="text-blue-950">{{ post.title }}</h3>
        </Link>
      </div>
      <div class="title-item" v-else>
        <h3 class="text-blue-950">{{ post.title }}</h3>
      </div>
      <div v-if="post.parent_id">
        <div class="ml-4 my-4 border border-cyan-300">
          <PostItem :post="post.parent.data" v-if="post.parent.data"></PostItem>
          <PostItem :post="post.parent" v-else></PostItem>
        </div>
      </div>
      <div class="flex justify-between item-footer mt-3">
        <a href="#" @click.prevent="destroyPost(post.id)" v-if="myProfile.id === post.profile.id">Delete</a>
        <LikeButton :content="post" @like="toggleLike"></LikeButton>
        <a :href="route('client.posts.show', post.id)">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
          </svg>
        </a>
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
import PrimaryButton from '../PrimaryButton.vue';
import axios from 'axios';

export default defineComponent({
  name: 'PostItem',
  components: {
    Link,
    LikeButton,
    PrimaryButton
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
      myProfile: this.$page.props.auth.user.profile,
      modalIsActive: false,
      entries: {
        post: {
          parent_id: this.post.id,
          category_id: this.post.category_id,
          is_active: 1,
          images: []
        },
        tags: ''
      },
      errors: {},
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
    destroyPost(postId) {
      axios.delete(route('client.posts.destroy', postId)).then(res => {
        console.log(res)
      })
    },
    repost() {
      axios.post(route('client.posts.repost'), this.entries).then(
        (res) => {
          console.log(res)
        }
      )
    },
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
