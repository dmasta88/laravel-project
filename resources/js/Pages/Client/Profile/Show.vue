<template>
  <div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Профиль -->
    <div class="flex flex-col items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ profile.login }}</h1>
      <img :src="profile.avatar" class="mx-auto rounded-full">
      <div class="flex flex-col sm:flex-row sm:items-center gap-4 mt-4">
        <Link :href="route('client.chats.store')" method="post" :data="{ profile_ids: [profile.id] }"
          class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition"
          v-if="profile.id != myProfile.id">
        Send Message
        </Link>
        <a href="#">

        </a>
        <a href="#" @click.prevent="toggleFollow"
          :class="[profile.is_followed ? ' bg-gray-600 text-white  hover:bg-gray-700 ' : ' bg-green-600 text-white  hover:bg-green-700 ', 'inline-flex items-center justify-center px-5 py-2.5 rounded-lg shadow transition']"
          v-if="profile.id != myProfile.id">
          <span>{{ profile.is_followed ? 'Unfollow' : 'Follow' }}</span>

        </a>
      </div>

      <InputError class="mt-2 text-red-600" v-if="errors" :message="errors.title" />
    </div>

    <!-- Posts -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <PostItem v-for="post in posts" :key="post.id" :post="post" />
    </div>
  </div>
</template>

<script lang="js">
import { defineComponent } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import { Link } from '@inertiajs/vue3';
import PostItem from '@/Components/Post/PostItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

export default defineComponent({
  name: 'Show',
  components: {
    Link,
    PostItem,
    PrimaryButton,
    InputError
  },
  layout: ClientLayout,
  props: {
    posts: Array,
    profile: Object,
    errors: Object
  },
  data() {
    return {
      myProfile: this.$page.props.auth.user.profile,
    };
  },
  beforeMount() {
  },
  methods: {
    toggleFollow() {
      axios.post(route('client.profiles.follow.toggle', this.profile.id)).then(res => {
        this.profile.is_followed = res.data.is_followed

      })
    }
  },
});
</script>

<style scoped lang="css"></style>
