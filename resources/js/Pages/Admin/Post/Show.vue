<template>
  <div>
    <h1 class="p-4 text-2xl">
      {{ post.title }}
    </h1>
    <p class="p-4">
      {{ post.content }}
    </p>
    <p class="p-4">by {{ post.profile_id }}</p>
    <p class="p-4" v-if="post.image_url">
      <img v-for="image_url in post.image_url" :src="image_url" :alt="post.title" />
    </p>
    <p class="p-4 flex">
      {{ post.liked_count }}
      <a href="#" @click.prevent="toggleLike">
        <svg xmlns="http://www.w3.org/2000/svg" :fill="post.is_liked ? '#336cc9' : 'none'" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
        </svg>
      </a>
    </p>
    <div class="p-4">
      <Link :href="route('admin.posts.index')" as="button" type="button" class="bg-blue-500 p-4 text-white">
      Back
      </Link>
    </div>
  </div>
</template>

<script lang="js">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Show',
  props: {
    post: Object
  },
  layout: AdminLayout,
  components: {
    Link
  },
  // data() {
  //   return {
  //     postData: this.post
  //   }
  // },
  methods: {
    toggleLike() {
      console.log('Like!')
      axios.post(route('admin.posts.like.toggle', this.post.id)).then(
        (res) => {
          console.log(res)
          this.post.liked_count = res.data.liked_count
          this.post.is_liked = res.data.is_liked
          //this.post.who_liked_count = res.data.who_liked_count
        }
      )
    }
  },
  beforeMount() {
    console.log(this.post)
  }
});
</script>

<style scoped lang="css"></style>
