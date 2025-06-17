<template>
  <div>
    <h1 class="p-4 text-2xl">
      Create post
    </h1>
    <div class="p-2">
      <input v-model="posts.title" type="text" name="title" placeholder="Title" class="w-1/3">
    </div>
    <div class="p-2">
      <textarea v-model="posts.content" type="text" name="content" placeholder="Content" class="w-1/3"></textarea>
    </div>
    <div class="p-2 block">
      <select name="categories" v-model="posts.category_id" id="categories" class="w-1/3">
        <option value="null" disabled>Select category</option>
        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
      </select>
    </div>
    <div class="p-2">
      <input ref='input_images' multiple @change="setImage" type="file" id="images" name="images[]">
    </div>
    <div class="py-4 px-2">
      <button href="#" @click.prevent="createPost" type="button" class="bg-gray-600 p-4 text-white">Create</button>

      <Link :href="route('admin.posts.index')" as="button" type="button" class="bg-blue-500 ml-4 p-4 text-white">
      Back
      </Link>
    </div>
  </div>
</template>

<script lang='js'>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Create',
  components: {
    Link
  },
  props: {
    categories: Array
  },
  layout: AdminLayout,
  methods: {
    createPost() {

      const formData = new FormData();
      for (const key in this.posts) {
        if (key === 'images' && this.posts.images.length) {
          for (let i = 0; i < this.posts.images.length; i++) {
            formData.append('images[]', this.posts.images[i]);
          }
        } else {
          formData.append(key, this.posts[key]);
        }
      }
      axios.post(route('admin.posts.store'), formData)
        // axios.post(route('admin.posts.store'), this.posts, {
        //   headers: {
        //     'Content-Type': 'multipart/form-data'
        //   }
        // })
        .then(res => {
          console.log(res)
          this.posts = { category_id: null, }
          this.$refs.input_images.value = null
        })
    },
    setImage(e) {
      this.posts.images = e.target.files;
      console.log(this.posts.images);
    }
  },

  data() {
    return {
      posts: {
        category_id: null,
        //profile_id: 1,
        is_active: 1,
        images: []
      }
    };
  }
});
</script>

<style scoped lang="css"></style>