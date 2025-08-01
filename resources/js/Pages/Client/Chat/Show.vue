<template>
  <div class="w-3/4 bg-white p-4">
    <NavLink :href="route('client.chats.index')">Back to chats
    </NavLink>
    <h1 class="text-xl mb-4 text-center">{{ chat.title }}</h1>
    <div class="flex w-full flex-col mr-96">
      <div v-for="messageData in messages" v-if="messages"
        :class="[messageData.is_owner ? 'bg-lime-100 self-end text-right' : 'bg-gray-200 self-start', 'my-2 p-2 min-w-96 w-3/4 rounded-lg']">
        <div :class="[messageData.is_owner ? 'justify-end' : '', 'flex items-center my-1']">
          <img :src="messageData.profile.avatar" class="h-5 mr-0.5 rounded-full">
          <span class="text-gray-600">{{ messageData.profile.login }}</span>
        </div>
        <div class="text-gray-700">{{ messageData.content }}</div>
        <div class="text-sm text-gray-400 mt-1">{{ messageData.published_at }}</div>

      </div>
    </div>
    <div class="mt-4 w-full flex justify-center items-center flex-col">
      <div><textarea v-model="content" @keydown.enter="storeMessage" name="content" placeholder="Type your message"
          class="rounded-lg min-w-96 min-h-24"></textarea>
      </div>
      <div class="mt-2">
        <PrimaryButton @click="storeMessage">
          Send
        </PrimaryButton>
      </div>
    </div>

  </div>
</template>

<script lang='js'>
import { defineComponent, toHandlers } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

export default defineComponent({
  name: 'Show',
  components: {
    Link,
    NavLink,
    PrimaryButton,
  },
  layout: ClientLayout,
  props: {
    chat: Object,
    messages: Array
    // comments: Object
  },
  data() {
    return {
      content: ''
    };
  },
  watch: {

  },
  beforeMount() {
  },
  mounted() {
    console.log(this.post)
  },
  updated() {
  },
  beforeUnmount() {

  },
  methods: {
    storeMessage() {
      axios.post(route('client.chats.messages.store', this.chat.id), { content: this.content }).then(
        res => {
          console.log(res.data)
          this.messages.push(res.data)
          this.content = ''
        }
      )
    }
  }
});
</script>

<style scoped lang="css"></style>