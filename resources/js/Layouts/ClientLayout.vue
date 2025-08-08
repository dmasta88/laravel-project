<template>
  <section>
    <header class="flex items-center justify-between h-20 bg-gray-200 px-6">
      <div class="text-xl font-semibold">BookFace</div>

      <div class="flex items-center space-x-3">
        <div class="w-full">
          <div class="notifications-section">
            <span class="absolute bg-red-500 text-white rounded-full w-4 h-4 text-xs text-center left-3 bottom-3 z-10"
              v-if="myProfile.notificationsnotread_count > 0">{{ myProfile.notificationsnotread_count }}</span>
            <svg @click="openNotifications" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor" class="size-5 cursor-pointer relative">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

            <div class="notification-content relative max-h-[400px] overflow-y-auto pr-2 pb-16"
              v-if="isActiveNotification">
              <div v-if="notifications.length > 0" class="divide-y divide-gray-200">
                <div v-for="notification in notifications" :key="notification.id"
                  class="p-4 hover:bg-gray-50 transition">
                  <a :href="route('client.notifications.show', notification.id)"
                    class="block text-sm text-gray-800 hover:text-blue-600 font-medium">
                    {{ notification.content }}
                  </a>
                  <p class="text-xs text-gray-500 mt-1">
                    {{ new Date(notification.created_at).toLocaleString() }}
                  </p>
                </div>

                <div class="flex flex-col items-center space-y-3 mt-6">
                  <button @click.prevent="loadMoreNotifications" v-if="meta.to > 0"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">
                    Load more
                  </button>
                  <div>
                    <a :href="route('client.notifications.index')"
                      class="text-center p-3 bg-gray-100 text-gray-800 hover:bg-gray-200 transition shadow">
                      Show all notifications
                    </a>
                  </div>
                </div>

              </div>

              <div v-else class="p-4 text-sm text-gray-500 text-center">
                There are not a new notifications.
              </div>
            </div>

          </div>
        </div>
        <Link :href="route('client.profiles.self')" class="flex space-x-3 items-center">
        <span class="text-gray-800 font-medium">{{ myProfile.login }}</span>

        <div class="w-5 h-5 rounded-full bg-gray-300 overflow-hidden flex items-center justify-center">
          <img v-if="myProfile.avatar" :src="myProfile.avatar" alt="User avatar" class="w-full h-full object-cover" />
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A13.937 13.937 0 0112 15c2.636 0 5.068.76 7.121 2.062M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        </Link>

      </div>
    </header>
  </section>
  <section class="flex">
    <aside class="w-1/4">
      <a :href="route('dashboard')" class="w-full text-center bg-slate-500 inline-block p-4 text-cyan-50">Posts</a>
      <a :href="route('client.profiles.index')"
        class="w-full text-center bg-slate-500 inline-block p-4 text-cyan-50">Profiles</a>
      <a :href="route('client.chats.index')"
        class="w-full text-center bg-slate-500 inline-block p-4 text-cyan-50">Chats</a>
    </aside>
    <article class="flex justify-center w-3/4 p-2 bg-gray-100">
      <slot />
    </article>
  </section>
  <section>
    <footer class="flex items-center justify-center h-32 bg-gray-200">
      <div class="text-center">footer</div>
    </footer>
  </section>
</template>

<script lang='js'>
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'ClientLayout',
  components: {
    Link
  },
  props: {
    // v-model
    modelValue: {
      default: '',
    },
  },
  emits: {
    // v-model event with validation
    'update:modelValue': (value) => value !== null,
  },
  data() {
    return {
      myProfile: this.$page.props.auth.user.profile,
      isActiveNotification: false,
      firstPageNotificationsLoaded: false,
      current_page: 1,
      notifications: [],
      meta: {}
    };
  },
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      },
    },
  },
  watch: {
    modelValue: {
      async handler(_newValue, _oldValue) {
        // do something
      },
      immediate: true
    },
  },
  beforeMount() {

  },
  mounted() {
    //this.notifications.current_page = 1
  },
  updated() {
  },
  beforeUnmount() {
    // stop the wacher on modelValue
    this.$watch('modelValue', () => { }, {});
  },
  methods: {
    openNotifications() {
      this.isActiveNotification = !this.isActiveNotification
      if (!this.firstPageNotificationsLoaded) {
        this.getNotifications()
      }
    },
    getNotifications() {
      axios.get(route('client.notifications.index')).then(res => {
        console.log(res)
        this.notifications = res.data.data
        this.meta = res.data.meta
        this.current_page += 1
        this.firstPageNotificationsLoaded = true
      })
      // }
    },
    loadMoreNotifications() {
      axios.get(route('client.notifications.index'), {
        params: {
          page: this.current_page
        }
      }).then(res => {
        console.log(res)
        this.notifications = [...this.notifications, ...res.data.data]
        this.meta = res.data.meta
        this.current_page += 1
      })
    }
  },
});
</script>

<style scoped lang="css">
.notifications-section {
  position: relative;
}

.notification-content {
  margin-top: 5px;
  padding: 5px;
  right: 0;
  position: absolute;
  width: 200px;
  min-height: 80px;
  max-height: 240px;
  overflow-y: auto;
  background-color: rgb(255, 255, 255);
  border: grey 1px solid;
}
</style>