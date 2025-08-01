<template>

  <div class="w-3/4 mx-auto bg-white p-6 rounded-lg shadow">
    <!-- Кнопка создания -->
    <div class="text-center mb-6">
      <Link class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
        :href="route('client.chats.create')">
      Create Chat
      </Link>
    </div>

    <!-- Сетка для всех чатов -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Чаты с участием меня -->
      <div v-if="chats.length > 0">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Chats With Me</h2>
        <div class="space-y-3">
          <a v-for="chat in chats" :key="chat.id" :href="route('client.chats.show', chat.id)"
            class="flex items-center gap-4 p-4 bg-cyan-100 rounded hover:bg-cyan-200 transition text-gray-800">
            <!-- Аватар или заглушка -->
            <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
              <img v-if="chat.avatar" :src="chat.avatar" alt="Avatar" class="w-full h-full object-cover" />
              <svg v-else class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8V22h19.2v-2.8c0-3.2-6.4-4.8-9.6-4.8z" />
              </svg>
            </div>
            <!-- Name of chat -->
            <span class="truncate">{{ chat.title }}</span>
          </a>
        </div>
      </div>

      <!-- My chats -->
      <div v-if="myChats.length > 0">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">My Chats</h2>
        <ul class="space-y-3">
          <li v-for="chat in myChats" :key="chat.id">
            <a :href="route('client.chats.show', chat.id)"
              class="flex items-center gap-4 p-4 bg-blue-100 rounded hover:bg-blue-200 transition text-gray-800">
              <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                <img v-if="chat.avatar" :src="chat.avatar" alt="Avatar" class="w-full h-full object-cover" />
                <svg v-else class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8V22h19.2v-2.8c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
              </div>
              <span class="truncate">{{ chat.title }}</span>
            </a>
          </li>
        </ul>
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

export default defineComponent({
  name: 'Index',
  components: {
    Link,
    NavLink,
    PrimaryButton
  },
  layout: ClientLayout,
  props: {
    chats: {
      type: Array
    },
    myChats: {
      type: Array
    }
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
    console.log(this.chats)
  },
  updated() {
  },
  beforeUnmount() {

  },
  methods: {

  }
});
</script>

<style scoped lang="css"></style>