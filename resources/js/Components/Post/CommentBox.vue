<template>
    <div class="bg-cyan-100 p-4 mb-4">
        <div class="flex justify-start w-2/4 mb-4">
            <div class="text-black text-sm">{{ commentData.profile.login }}</div>
            <div class="text-gray-500 text-sm pl-4">{{ commentData.formatted_date }}</div>
        </div>
        <div class="mb-4">{{ commentData.content }}</div>
        <div class="flex justify-between mb-4">
            <div>

                <a href="#" class="text-blue-600 text-sm  mr-2" v-if="commentData.children.length > 0"
                    @click.prevent="activateReply">{{ commentData.children.length }} replies
                </a>
                <a href="#" class="text-blue-600 text-sm" v-if="!commentData.parent_id && !activeReplay"
                    @click.prevent="activeReplay = true">Reply</a>
            </div>
            <div class="flex">
                <LikeButton :content="commentData" @like="toggleLike"></LikeButton>
            </div>
        </div>

        <div class="text-center">

        </div>
    </div>
    <div class="children ml-4">
        <div v-if="commentData.children">
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
            <CommentBox v-if="commentsRepliesActive" v-for="child in commentData.children" :key="child.id"
                :comment="child">
            </CommentBox>
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
    },
    components: {
        InputError,
        CommentForm,
        PrimaryButton,
        LikeButton
    },
    emits: ['submit'],
    data() {
        return {
            commentContent: '',
            activeReplay: false,
            commentsRepliesActive: false,
            errors: {},
            commentData: this.comment
        }
    }
    ,
    methods: {
        activateReply() {
            this.commentsRepliesActive = !this.commentsRepliesActive
            this.activeReplay = !this.activeReplay
        },
        commentReply() {
            const onSuccess = (commentData) => {
                this.commentContent = ''
                this.commentData.children.unshift(commentData)
                this.commentsRepliesActive = true
                this.activeReplay = true
            }
            const onError = (errors) => this.errors = errors
            this.$emit('submit', { content: this.commentContent, parent_id: this.comment.id, onSuccess, onError })
            //console.log(this.commentData)

        },
        toggleLike({ likedContent, onSuccess = () => { } }) {
            console.log('Like!')
            axios.post(route('client.comments.like.toggle', likedContent.id)).then(
                (res) => {
                    this.commentData = res.data
                    onSuccess(res.data)
                    //this.post.who_liked_count = res.data.who_liked_count
                }
            )
        }
    },

});
</script>