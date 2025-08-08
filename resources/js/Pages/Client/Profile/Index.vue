<template>
  <div class="flex  space-x-2">
    <div v-for="profile in profiles" :key="profile.id"
      class="flex items-center justify-between bg-white shadow rounded-lg p-4 hover:shadow-lg transition">

      <div class="flex items-center space-x-4 flex-1">
        <Link :href="route('client.profiles.show', profile.id)" class="flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
          <img v-if="profile.avatar" :src="profile.avatar" alt="avatar" class="w-full h-full object-cover" />
        </div>

        <div class="mr-4 flex-1">
          <div class="text-lg font-semibold text-gray-900">
            {{ profile.second_name }} {{ profile.third_name }}
          </div>
          <div class="text-sm text-gray-500">@{{ profile.login }}</div>
        </div>
        </Link>
      </div>

      <a href="#" @click.prevent="toggleFollow(profile)" :class="[
        profile.is_followed ? 'bg-gray-600 text-white hover:bg-gray-700' : 'bg-green-600 text-white hover:bg-green-700',
        'inline-flex items-center justify-center ml-4 px-2 py-1 rounded-lg shadow transition select-none min-w-[100px]'
      ]">
        <span>{{ profile.is_followed ? 'Unfollow' : 'Follow' }}</span>
      </a>

    </div>
  </div>

</template>

<script lang='js'>
import { defineComponent, toHandlers } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

export default defineComponent({
  name: 'Index',
  components: {
    Link,
    NavLink,
    PrimaryButton
  },
  layout: ClientLayout,
  props: {
    profiles: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
      myProfile: this.$page.props.auth.user.profile
    };
  },
  watch: {

  },
  beforeMount() {
  },
  mounted() {
    console.log(this.profiles)

  },
  updated() {
  },
  beforeUnmount() {

  },
  methods: {
    toggleFollow(profile) {
      axios.post(route('client.profiles.follow.toggle', profile.id)).then(res => {
        const index = this.profiles.findIndex(val => {
          return profile.id === val.id
        })
        console.log(this.profiles[index])
        this.profiles[index].is_followed = res.data.is_followed
        //this.profile.is_followed = res.data.is_followed
      })
    }
  }
});
</script>

<style scoped lang="css"></style>