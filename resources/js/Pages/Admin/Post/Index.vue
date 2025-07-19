<template>
  <div>
    <div class="flex justify-between p-2">
      <input type="text" placeholder="Title" v-model="filter.title" />
      <input type="text" placeholder="Content" v-model="filter.content" />
      <input type="text" placeholder="Views from" v-model="filter.views_from" />
      <input type="date" placeholder="published_at" v-model="filter.published_at_from" />
      <select name="categories" v-model="filter.category_id" id="categories">
        <option value="null" disabled>Select category</option>
        <option v-for="category in categories" :value="category.id">
          {{ category.title }}
        </option>
      </select>
    </div>
    <div class="flex justify-between p-2">
      <h1 class="text-2xl">Admin Index</h1>
      <!-- <a href="#" class="p-4 bg-blue-800 text-white">Create post</a> -->
      <Link :href="route('admin.posts.create')" class="px-4 py-2 bg-blue-800 text-white">Create post</Link>
    </div>
    <table class="border-collapse border border-gray-200 table-auto w-full text-sm">
      <thead class="bg-gray-100 dark:bg-slate-800">
        <tr>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            ID
          </th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Title
          </th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Views
          </th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Likes
          </th>
          <th
            class="text-center border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white dark:bg-slate-800">
        <tr v-if="postData.length === 0">
          <td colspan="100%" class="text-center text-gray-500 py-4">Нет записей</td>
        </tr>
        <tr v-for="post in postData" class="border-b border-gray-200">
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            {{ post.id }}
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <Link :href="route('admin.posts.show', post.id)">{{ post.title }}</Link>
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            {{ post.views }}
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <div class="flex justify-center">
              <div class="mr-1">{{ post.liked_count }}</div>
              <div>
                <a href="#" @click.prevent="toggleLike(post.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" :fill="post.is_liked ? '#336cc9' : 'none'" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                  </svg>
                </a>
              </div>
            </div>
          </td>
          <td
            class="text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
            <div class="flex justify-center">
              <Link :href="route('admin.posts.edit', post.id)"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
              </Link>
              <a href="#" @click.prevent="deletePost(post.id)"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex m-2 justify-center">
      <ul class="flex">
        <!-- <a v-if="lastPage > 1" v-for="(page, index) in paginationData.links" :key="index" @click.prevent="setPage(page)"
          :class="[
            'border m-2 cursor-pointer bg-slate-300 px-2 py-1',
            page.active ? 'border-black-300 bg-slate-500 text-white' : 'border-slate-100'
          ]" v-html="page.label"></a> -->
        <a v-if="paginationData.last_page > 1" v-for="(page, index) in paginationData.links" :key="index"
          @click.prevent="setPage(page)" :class="[
            'border m-2 cursor-pointer bg-slate-300 px-2 py-1',
            page.active ? 'border-black-300 bg-slate-500 text-white' : 'border-slate-100',
          ]" v-html="page.label"></a>
      </ul>
    </div>
    <div class="flex justify-end">
      <a href="#" @click.prevent="flushCache" class="px-4 py-2 bg-red-800 text-white">Flush cache</a>
    </div>
  </div>
</template>

<script lang="js">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Index',
  props: {
    posts: Object,
    categories: Array
  },
  layout: AdminLayout,
  components: {
    Link
  },
  data() {
    return {
      postData: this.posts.data,
      paginationData: this.posts.meta,
      filter: {},
      filterSnapshot: ''
    }
  },
  methods:
  {
    filterPost() {
      axios.get(route('admin.posts.index'), {
        params: this.filter
      }).then(
        (res) => {
          console.log(res)
          this.postData = res.data.data
          this.paginationData = res.data.meta
        }
      )
    },
    deletePost(post_id) {
      axios.delete(route('admin.posts.destroy', post_id))
        .then((res) => {
          console.log(res)
          this.postData = this.postData.filter(item =>
            item.id != post_id
          )
        })
    },
    toggleLike(post_id) {
      console.log('Like!')
      axios.post(route('admin.posts.like.toggle', post_id)).then(
        (res) => {
          const index = this.postData.findIndex(item => item.id === res.data.id)
          this.postData[index] = res.data
        }
      )
    },
    setPage(page) {
      this.filter.page = page.label
      // axios.get(route('admin.posts.index'), {
      //   params: {
      //     page: page.label
      //   }
      // }).then(
      //   (res) => {
      //     console.log(res.data.meta)
      //     this.paginationData = res.data.meta
      //     this.postData = res.data.data
      //     // this.$nextTick(() => {
      //     //   this.filter.page = 1
      //     // })
      //   }
      // )
    },
    flushCache() {
      axios.get(route('admin.posts.cache.flush')).then(
        res => console.log(res)
      )
    }
  },
  watch: {
    filter: {
      handler(newVal) {
        const keys = ['title', 'content', 'views_from', 'published_at_from', 'category_id']
        const current = JSON.stringify(keys.reduce((acc, key) => {
          acc[key] = newVal[key]
          return acc
        }, {}))

        if (current !== this.filterSnapshot) {
          this.filter.page = 1
          this.filterSnapshot = current
          this.filterPost()
        }
        this.filterPost()
      },
      deep: true,
      // immediate: true
    }
  },
  beforeMount() {
    console.log(this.posts)
  },
  mounted() {
    // this.lastPage = this.posts.meta.last_page
  }
});
</script>

<style scoped lang="css"></style>
