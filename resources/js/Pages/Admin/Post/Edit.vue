<template>
  <div>
    <h1 class="p-4 text-2xl">
      Edit post
    </h1>
    <div class="p-2">
      <input v-model="entries.post.title" type="text" name="title" placeholder="Title" class="w-1/3">
    </div>
    <div class="p-2">
      <textarea v-model="entries.post.content" type="text" name="content" placeholder="Content"
        class="w-1/3"></textarea>
    </div>
    <div class="p-2">
      <label>Is active:</label>
    </div>
    <div class="p-2">
      <select v-model="entries.post.is_active">
        <option :value="true">Active</option>
        <option :value="false">Inactive</option>
      </select>
    </div>
  </div>
  <div class="p-2">
    <label>Published at:</label>
  </div>
  <div class="p-2">
    <input v-model="entries.post.published_at" type="date" name="date" placeholder="Date" class="w-1/3">
  </div>
  <div class="p-2">
    <input v-model="entries.post.tags" type="text" name="text" placeholder="Tags" class="w-1/3">
  </div>
  <div class="p-2 block">
    <select name="categories" v-model="entries.post.category_id" id="categories" class="w-1/3">
      <option value="null" disabled>Select category</option>
      <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
    </select>
  </div>
  <div class="p-2">
    <div class="relative inline-block" v-if="entries.post.image_urls" v-for="image in entries.post.image_urls">
      <img :src="image" class="w-32 h-32 object-cover rounded p-2">
      <button @click.prevent="deleteImg(image)"
        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
        х
      </button>
    </div>
    <div>
      <input ref='input_images' multiple @change="setImage" type="file" id="images" name="images[]">
    </div>
  </div>
  <div class="py-4 px-2">
    <a href="#" @click.prevent="updatePost" type="button" class="bg-gray-600 p-4 text-white">Update</a>
    <Link :href="route('admin.posts.index')" as="button" type="button" class="bg-blue-500 ml-4 p-4 text-white">
    Back
    </Link>
  </div>
  <div class="py-4 px-2">
    <DangerButton @click.prevent="deletePost">Delete</DangerButton>
  </div>

</template>

<script lang='js'>
import DangerButton from '@/Components/DangerButton.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Edit',
  components: {
    Link,
    DangerButton
  },
  props: {
    post: Object,
    categories: Array
  },
  layout: AdminLayout,
  methods: {
    deletePost() {
      axios.delete(route('admin.posts.destroy', this.entries.post.id))
        .then((res) => {
          console.log(res)
        })
    },
    deleteImg(url) {
      console.log(url)
      const index = this.entries.post.image_urls.indexOf(url)
      if (index != -1) {
        this.entries.post.image_urls.splice(index, 1)
        this.entries.post.images_deleted.push(url)
      }
      //this.entries.post.images_url = this.entries.post.images_url.filter()
    },
    updatePost() {
      const formData = new FormData();
      formData.append('_method', 'PATCH');
      for (const key in this.entries.post) {
        if (key === 'images' && this.entries.post.images.length) {
          for (let i = 0; i < this.entries.post.images.length; i++) {
            formData.append('post[images][]', this.entries.post.images[i]);
          }
        }
        else if (key === 'tags') {
          formData.append(key, this.entries.post[key]);
        }
        else if (key == 'images_deleted') {
          this.entries.post.images_deleted.forEach((url, i) => {
            formData.append(`post[images_deleted][${i}]`, url);
          });
        }
        else {
          formData.append('post[' + key + ']', this.entries.post[key]);
        }
      }
      axios.post(route('admin.posts.update', this.entries.post.id), formData)
        // axios.post(route('admin.posts.update', this.entries.post.id), this.entries, {
        //   headers: {
        //     'Content-Type': 'multipart/form-data'
        //   }
        // })
        .then(res => {
          this.entries.post = res.data
        })
    },
    setImage(e) {
      this.entries.post.images = e.target.files;
      console.log(this.entries.post.images);
    }
  },

  data() {
    return {
      entries: {
        post: {
          ...this.post,
          images_deleted: []
        },
        tags: this.post.tags && this.post.tags.length > 0 ? this.post.tags : []
      }
    };
  }
});
</script>

<style scoped lang="css"></style>