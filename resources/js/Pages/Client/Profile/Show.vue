<template>

  <div class="w-1/3 mx-auto">
    <div>
      My user:{{ myProfile.login }}
    </div>
    <div>
      <div class="text-center">
        <Link :href="route('client.chats.store')" method="post" :data="{ profile_ids: [profile.id] }"
          class="px-3 py-2 bg-blue-600 text-white" v-if="profile.id != myProfile.id">Send message</Link>
      </div>
      <InputError class="text-center mt-2" v-if="errors" :message="errors.title"></InputError>
    </div>
    <h1 class="text-center text-xl my-4 text-black">{{ profile.login }}</h1>
    <PostItem v-for="post in posts" :post="post"></PostItem>
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
    // v-model
    posts: Array,
    profile: Object,
    myProfile: Object,
    errors: Object
  },
  emits: {
    // v-model event with validation
    'update:modelValue': (value) => value !== null,
  },
  data() {
    return {
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
    console.log(this.profile)

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
