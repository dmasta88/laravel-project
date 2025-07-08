<template>
  <div>
    <div>
      <p v-if="isCreated" class="m-2 p-4 bg-green-500 text-white w-1/2">
        Post was created
      </p>
    </div>
    <h1 class="p-4 text-2xl">
      Create post
    </h1>
    <div class="p-2">
      <input v-model="entries.post.title" type="text" name="title" placeholder="Title" class="w-1/3">
    </div>
    <div v-if="errors['post.title']">
      <p v-for="error in errors['post.title']" class="m-2 p-4 bg-red-500 text-white w-1/2">
        {{ error }}
      </p>
    </div>
    <div class="p-2">
      <textarea v-model="entries.post.content" type="text" name="content" placeholder="Content"
        class="w-1/3"></textarea>
    </div>
    <div v-if="errors['post.content']">
      <p v-for="error in errors['post.content']" class="m-2 p-4 bg-red-500 text-white w-1/2">
        {{ error }}
      </p>
    </div>

    <div class="p-2">
      <label>Published at:</label>
    </div>
    <div class="p-2">
      <input v-model="entries.post.published_at" type="date" name="date" placeholder="Date" class="w-1/3">
    </div>
    <div>
      <p v-if="errors['post.published_at']" v-for="error in errors['post.published_at']"
        class="m-2 p-4 bg-red-500 text-white w-1/2">
        {{ error }}
      </p>
    </div>
    <div class="p-2">
      <input v-model="entries.tags" type="text" name="text" placeholder="Tags" class="w-1/3">
    </div>
    <div class="p-2 block">
      <select name="categories" v-model="entries.post.category_id" id="categories" class="w-1/3">
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
      for (const key in this.entries.post) {
        if (key === 'images' && this.entries.post.images.length) {
          for (let i = 0; i < this.entries.post.images.length; i++) {
            formData.append('images[]', this.entries.post.images[i]);
          }
        } else {
          formData.append(key, this.entries.post[key]);
        }
      }
      //axios.post(route('admin.posts.store'), formData)
      axios.post(route('admin.posts.store'), this.entries, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(res => {
          console.log(res)
          this.entries.post = { category_id: null, is_active: null }
          this.entries.tags = '';
          this.$refs.input_images.value = null
          this.$nextTick(() => {
            this.isCreated = true
          })
        }).catch(errors => {
          console.log(errors)
          this.errors = errors.response.data.errors
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
          category_id: null,
          is_active: 1,
          images: []
        },
        tags: ''
      },
      errors: {},
      isCreated: false
    };
  },
  watch: {
    entries: {
      handler(newValue) {
        this.isCreated = false
        this.errors = {}
      },
      deep: true
    }
  }
});

</script>

<style scoped lang="css"></style>