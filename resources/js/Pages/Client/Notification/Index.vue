<template>
  <div class="flex flex-col gap-5">
    <h1 class="text-5xl my-5">Notifications</h1>
    <div v-for="notification in notifications.data" :key="notification.id"
      class="flex items-center justify-between bg-white shadow-sm hover:shadow-md transition rounded-xl p-4">
      <a :href="route('client.notifications.show', notification.id)"
        class="text-gray-800 hover:text-blue-600 transition-colors duration-200">
        {{ notification.content }}
      </a>
    </div>

    <a href="#" @click.prevent="markAllAsRead" v-if="notifications.data.length > 0"
      class="inline-block w-fit mx-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
      Mark all as read
    </a>

    <p v-else class="text-center text-gray-500 my-10">
      There are no new notifications.
    </p>
  </div>


</template>

<script lang='js'>
import { defineComponent, toHandlers } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import axios from 'axios';

export default defineComponent({
  name: 'Index',
  components: {
    Link,
    NavLink,
    PrimaryButton
  },
  layout: ClientLayout,
  props: {
    notifications: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
    };
  },
  watch: {

  },
  beforeMount() {
  },
  mounted() {
    console.log(this.notifications)
  },
  updated() {
  },
  beforeUnmount() {

  },
  methods: {
    markAllAsRead() {
      axios.post(route('client.notifications.markallasread')).then(res => console.log(res))
    }
  }
});
</script>

<style scoped lang="css"></style>