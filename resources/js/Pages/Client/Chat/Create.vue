<template>
  <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Create Chat</h1>

    <label class="block text-left text-sm font-medium text-gray-700 mb-2">
      Choose Profiles:
    </label>
    <div class="mb-6">
      <select v-model="selectedIds" multiple
        class="block w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-200"
        size="6">
        <option v-for="profile in profiles" :key="profile.id" :value="profile.id">
          {{ profile.second_name }} {{ profile.third_name }} ({{ profile.login }})
        </option>
      </select>
      <p class="mt-2 text-sm text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple profiles.</p>
    </div>

    <PrimaryButton @click="storeChat" class="w-full justify-center">
      Create
    </PrimaryButton>
  </div>
</template>


<script lang='js'>
import { defineComponent, toHandlers } from 'vue'
import ClientLayout from '@/Layouts/ClientLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Multiselect from 'vue-multiselect';

export default defineComponent({
  name: 'Create',
  components: {
    Link,
    NavLink,
    PrimaryButton,
    Multiselect
  },
  layout: ClientLayout,
  props: {
    profiles: {
      type: Array
    }
    // comments: Object
  },
  data() {
    return {
      selectedIds: []
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
    storeChat() {
      this.$inertia.post(route('client.chats.store'), {
        profile_ids: this.selectedIds
      });
    }
  }
});
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped lang="css"></style>