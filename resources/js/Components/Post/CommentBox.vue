<template>
    <div class="bg-cyan-100 p-4 mb-4">
        <div class="flex justify-start w-2/4 mb-4">
            <div class="text-black text-sm">{{ comment.profile.login }}</div>
            <div class="text-gray-500 text-sm pl-4">{{ comment.formatted_date }}</div>
        </div>
        <div class="mb-4">{{ comment.content }}</div>
        <div class="flex justify-between mb-4">
            <div>

                <a href="#" class="text-blue-600 text-sm  mr-2" v-if="comment.children_count > 0"
                    @click.prevent="handleReplies">{{ comment.children_count }} replies
                </a>
                <a href="#" class="text-blue-600 text-sm" v-if="!comment.parent_id && !activeReplay"
                    @click.prevent="handleReplies">Reply</a>
            </div>
            <div class="flex">
                <LikeButton :content="comment" @like="toggleLike"></LikeButton>
            </div>
        </div>

        <div class="text-center">

        </div>
    </div>
    <div class="children ml-4">
        <div v-if="comment.children">
            <div class="mb-4" v-if="activeReplay">
                <div>
                    <textarea placeholder="Type comment" name="commentReplyContent" v-model="commentContent"
                        class="border border-blue-200 w-full"></textarea>
                </div>
                <div v-if="errors && errors.content">
                    <InputError v-for="error in errors['content']" :message="error"></InputError>
                </div>
                <PrimaryButton @click.prevent="commentReply" class="my-2">Reply</PrimaryButton>
            </div>
            <CommentBox v-if="activeReplay" v-for="child in comment.children" :key="child.id" :comment="child">
            </CommentBox>
            <div class="text-center my-5">

                <PrimaryButton href="#" v-if="pagination && pagination.current_page <= pagination.last_page"
                    @click="handleReplies">
                    Load replies
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
<script lang='js'>
import { defineComponent } from 'vue'
import InputError from '../InputError.vue';
import CommentForm from './CommentForm.vue';
import PrimaryButton from '../PrimaryButton.vue';
import LikeButton from './LikeButton.vue';
export default defineComponent({
    props: {
        comment: Object,
        pagination: Object
    },
    components: {
        InputError,
        CommentForm,
        PrimaryButton,
        LikeButton
    },
    emits: ['submit', 'load'],
    data() {
        return {
            commentContent: '',
            activeReplay: false,
            commentsRepliesActive: false,
            errors: {},
            commentData: this.comment,
        }
    }
    ,
    methods: {
        handleReplies() {
            this.$emit('load', { parentComment: this.comment })
            this.activeReplay = true

        },
        commentReply() {
            const onSuccess = (commentData) => {
                this.commentContent = ''
                this.comment.children.unshift(commentData)
                this.commentsRepliesActive = true
                this.activeReplay = true
            }
            const onError = (errors) => this.errors = errors
            this.$emit('submit', { content: this.commentContent, parent_id: this.comment.id, onSuccess, onError })
            //console.log(this.comment)
        },
        toggleLike({ likedContent, onSuccess = () => { } }) {
            console.log('Like!')
            axios.post(route('client.comments.like.toggle', likedContent.id)).then(
                (res) => {
                    console.log(res.data)
                    this.comment.is_liked = res.data.is_liked
                    this.comment.liked_count = res.data.liked_count
                }
            )
        }
    },

});
</script>