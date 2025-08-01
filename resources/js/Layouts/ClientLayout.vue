<template>
  <section>
    <header class="flex items-center justify-between h-20 bg-gray-200 px-6">
      <div class="text-xl font-semibold">BookFace</div>

      <div class="flex items-center space-x-3">
        <Link :href="route('client.profiles.self')" class="flex space-x-3 items-center">
        <span class="text-gray-800 font-medium">{{ myProfile.login }}</span>

        <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden flex items-center justify-center">
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
  <section class="">
    <article class="flex justify-center w-full p-2 bg-gray-100">
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
      myProfile: this.$page.props.auth.user.profile
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

  },
  updated() {
  },
  beforeUnmount() {
    // stop the wacher on modelValue
    this.$watch('modelValue', () => { }, {});
  },
  methods: {
  },
});
</script>

<style scoped lang="css"></style>