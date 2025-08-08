<template>
  <div class="max-w-4xl mx-auto px-4 py-8">
    {{ notification.content }}
  </div>
</template>

<script lang="js">
import { defineComponent } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import { Link } from '@inertiajs/vue3';
import PostItem from '@/Components/Post/PostItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

export default defineComponent({
  name: 'Show',
  components: {
    Link
  },
  layout: ClientLayout,
  props: {
    notification: Object
  },
  data() {
    return {
    };
  },
  beforeMount() {
  },
  mounted() {
    this.readNotification()
  },
  methods: {
    readNotification() {
      if (!this.notification.read_at) {
        axios.post(route('client.notifications.markasread', this.notification.id)).then((res) => {
          console.log(res)
          this.$page.props.auth.user.profile.notificationsnotread_count = this.$page.props.auth.user.profile.notificationsnotread_count - 1
        })
      }

    }
  },
});
</script>

<style scoped lang="css"></style>
