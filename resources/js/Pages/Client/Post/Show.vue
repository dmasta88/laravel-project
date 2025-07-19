<template>
  <div class="w-1/2 mx-auto bg-white p-4">
    <div class="content mb-4">
      <div class="">
        <NavLink :href="route('dashboard')">
          Back
        </NavLink>
      </div>
      <div class="mb-4">
        <h1 class="text-blue-950 text-xl font-black">{{ post.title }}</h1>
      </div>
      <div class="flex justify-between mb-4">
        <p class="text-gray-500 text-sm">{{ post.profile.login }}</p>
        <p class="text-gray-500 text-sm">{{ post.date_formatted }}</p>
      </div>
      <div v-if="post.image_urls.length !== 0">
        <div v-for="image in post.image_urls">
          <img :src="image" class="m-1">
        </div>
      </div>
      <div>
        <p>{{ post.content }}</p>
      </div>
      <div class="flex justify-end">
        <LikeButton :content="post" @like="toggleLikePost"></LikeButton>
      </div>
    </div>
    <div class="comments">
      <template v-if="comments.data.length">
        <CommentForm @submit="storeComment"></CommentForm>
        <div v-for="comment in comments.data" :key="comment.id">
          <CommentBox @submit="storeComment" @load="loadReplies" :comment="comment"
            :pagination="comments.childrenPagination[comment.id]" v-if="!comment.parent_id">
          </CommentBox>
        </div>
      </template>
    </div>
    <div class="text-center my-5" v-if="post.comments_count > 0">

      <PrimaryButton v-if="comments.active" href="#" @click="loadComments()">Comments ({{
        post.comments_count }})
      </PrimaryButton>

    </div>
    <div class="text-center my-5">
      <PrimaryButton href="#" v-if="comments.pagination.last_page > 0 && comments.pagination.next"
        @click="loadComments()">
        Load comments
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
      comments: {
        data: [],
        pagination: {
          current_page: 1,
          next: null,
          last_page: 1,
        },
        childrenPagination: {
          current_page: 1,
        },
        active: true,
      },
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
    console.log(this.post)
  },
  updated() {
  },
  beforeUnmount() {
    // stop the wacher on modelValue
    this.$watch('modelValue', () => { }, {});
  },
  methods: {
    toggleLikePost({ likedContent }) {
      console.log('Liked post!')
      console.log(likedContent)
      axios.post(route('client.posts.like.toggle', likedContent.id)).then(
        (res) => {
          likedContent.liked_count = res.data.liked_count
          likedContent.is_liked = res.data.is_liked
        }
      )
    },
    storeComment({ content, parent_id = null, onSuccess = () => { }, onError = () => { } }) {
      axios.post(route('client.posts.comments.store', this.post.id), { content: content, parent_id: parent_id })
        .then(
          res => {
            console.log(res)
            this.comments.data.unshift(res.data.data)
            //this.loadReplies(parent_id)
            onSuccess(res.data.data)
          })
        .catch(
          (err) => {
            onError(err.response.data.errors)
          }
        )
    },
    loadComments() {
      this.comments.active = false
      axios.get(route('client.posts.comments.index', this.post.id), {
        params: {
          page: this.comments.pagination.current_page
        }
      }).then((res) => {
        console.log(res)
        this.comments.data = [...this.comments.data, ...res.data.data]
        this.comments.pagination = res.data.meta
        this.comments.pagination.next = res.data.links.next
        this.comments.pagination.current_page++
      })
    },
    loadReplies({ parentComment }) {
      const parentId = parentComment.id
      axios.get(route('client.comments.children', parentComment.id), {
        params: {
          page: this.comments.childrenPagination[parentId]
            ? this.comments.childrenPagination[parentId].current_page
            : 1
        }
      }).then((res) => {
        console.log(res)
        if (res.data.data.length > 0) {
          const index = this.comments.data.findIndex((item) => {
            return item.id == parentId
          })
          this.comments.childrenPagination[parentId] = res.data.meta
          res.data.data.forEach(child => {
            this.comments.data[index].children.push(child)
          })
          this.comments.childrenPagination[parentId].current_page++
          console.log(this.comments.data[index].children)
        }
        else {
          this.comments.childrenPagination[parentId] = null
        }
      })
      //this.commentsRepliesActive = !this.commentsRepliesActive
      // this.activeReplay = !this.activeReplay
    },
  }
});
</script>

<style scoped lang="css"></style>