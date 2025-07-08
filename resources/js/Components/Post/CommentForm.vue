<template>
  <div>
    <textarea v-model="commentContent" placeholder="Write comment" class="w-full" name="commentContent"></textarea>
    <div v-if="errors && errors.content">
      <InputError v-for="error in errors['content']" :message="error"></InputError>
    </div>
    <PrimaryButton @click.prevent="commentReply" class="my-2">Send</PrimaryButton>
  </div>
</template>

<script lang='js'>
import { defineComponent } from 'vue'
import PrimaryButton from '../PrimaryButton.vue';
import InputError from '../InputError.vue';

export default defineComponent({
  name: 'CommentForm',
  components: {
    PrimaryButton,
    InputError
  },
  props: {
    // v-model
    modelValue: {
      default: '',
    },
  },
  emits: ['submit'],
  data() {
    return {
      commentContent: '',
      errors: {}
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
  methods: {
    commentReply() {
      const onSuccess = () => this.commentContent = ''
      const onError = (errors) => this.errors = errors
      this.$emit('submit', { content: this.commentContent, onSuccess, onError })
    }
  },
});
</script>

<style scoped lang="css"></style>