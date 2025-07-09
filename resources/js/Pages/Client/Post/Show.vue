<template>
  <div class="w-1/2 mx-auto bg-white p-4">
    <div class="content mb-4">
      <div class="">
        <NavLink :href="route('dashboard')">
          Back
        </NavLink>
      </div>
      <div class="mb-4">
        <h1 class="text-blue-950 text-xl font-black">{{ postData.title }}</h1>
      </div>
      <div class="flex justify-between mb-4">
        <p class="text-gray-500 text-sm">{{ postData.profile.login }}</p>
        <p class="text-gray-500 text-sm">{{ postData.date_formatted }}</p>
      </div>
      <div v-if="postData.image_urls.length !== 0">
        <div v-for="image in postData.image_urls">
          <img :src="image" class="m-1">
        </div>
      </div>
      <div>
        <p>{{ postData.content }}</p>
      </div>
      <div class="flex justify-end">
        <LikeButton :content="postData" @like="toggleLike"></LikeButton>
      </div>
    </div>
    <div class="comments">
      <template v-if="commentsData.length">
        <CommentForm @submit="storeComment"></CommentForm>
        <div v-for="comment in commentsData" :key="comment.id">
          <CommentBox @submit="storeComment" :comment="comment" v-if="!comment.parent_id">
          </CommentBox>

          <!-- <template v-for="child in commentsData" :key="child.id">
            <CommentBox class="ml-4" :key="child.id" :comment="child" v-if="child && child.parent_id === comment.id">
            </CommentBox>
          </template> -->
        </div>
      </template>
    </div>
    <div class="text-center my-5" v-if="postData.comments_count > 0">

      <PrimaryButton v-if="commentsActive" href="#" @click="loadComments()">Comments ({{
        postData.comments_count }})
      </PrimaryButton>

    </div>
    <div class="text-center my-5">
      <PrimaryButton href="#" v-if="paginationData.last_page > 0 && this.paginationData.next" @click="loadComments()">
        Load
        comments
      </PrimaryButton>
    </div>
  </div>
</template>

<script lang='js'>
import { defineComponent, toHandlers } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';
import CommentBox from '@/Components/Post/CommentBox.vue';
import CommentForm from '@/Components/Post/CommentForm.vue';
import NavLink from '@/Components/NavLink.vue';
import LikeButton from '@/Components/Post/LikeButton.vue';

export default defineComponent({
  name: 'Show',
  components: {
    Link,
    NavLink,
    PrimaryButton,
    CommentBox,
    CommentForm,
    LikeButton
  },
  layout: ClientLayout,
  props: {
    post: Object,
    // comments: Object
  },
  data() {
    return {
      commentContent: '',
      commentsData: [],
      paginationData: { current_page: 1 },
      postData: this.post,
      errors: {},
      commentsActive: true,
    };
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
    //console.log(this.post)
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
    },
    storeComment({ content, parent_id = null, onSuccess = () => { }, onError = () => { } }) {
      axios.post(route('client.posts.comments.store', this.post.id), { content: content, parent_id: parent_id })
        .then(
          res => {
            this.commentsData.unshift(res.data.data)
            onSuccess(res.data.data)
          })
        .catch(
          (err) => {
            onError(err.response.data.errors)
          }
        )
    },
    loadComments() {
      this.commentsActive = false
      axios.get(route('client.posts.comments.index', this.post.id), {
        params: {
          page: this.paginationData.current_page
        }
      }).then((res) => {
        console.log(res)
        this.commentsData = [...this.commentsData, ...res.data.data]
        this.paginationData = res.data.meta
        this.paginationData.next = res.data.links.next
        this.paginationData.current_page++
      })
    }
  }
});
</script>

<style scoped lang="css"></style>