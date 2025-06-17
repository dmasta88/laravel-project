<template>
  <div>
    <h1 class="p-4 text-2xl">
      Create profile
    </h1>
    <div class="p-2">
      <input v-model="profiles.second_name" type="text" name="second_name" placeholder="Second name" class="w-1/3">
    </div>
    <div class="p-2">
      <input v-model="profiles.third_name" type="text" name="third_name" placeholder="Third name" class="w-1/3">
    </div>
    <div class="p-2">
      <input v-model="profiles.city" type="text" name="city" placeholder="City" class="w-1/3">
    </div>
    <div class="p-2">
      <input v-model="profiles.login" type="text" name="login" placeholder="Login" class="w-1/3">
    </div>
    <div class="py-4 px-2">
      <button href="#" @click.prevent="createProfile" type="button" class="bg-gray-600 p-4 text-white">Create</button>
    </div>
    <div class="p-2">
      <Link :href="route('admin.profiles.index')" as="button" type="button" class="bg-blue-500 p-4 text-white">
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
  layout: AdminLayout,
  methods: {
    createProfile() {
      axios.post(route('admin.profiles.store'), this.profiles)
        .then(res => {
          console.log(res)
        })
    }
  },

  data() {
    return {
      profiles: {
        user_id: 1
      }
    };
  }
});
</script>

<style scoped lang="css"></style>