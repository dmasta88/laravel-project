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
                <div class="mr-1 text-sm">{{ commentData.liked_count }}</div>
                <a href="#" @click.prevent="toggleLike(commentData.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" :fill="commentData.is_liked ? '#336cc9' : 'none'"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>
                </a>
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
export default defineComponent({
    props: {
        comment: Object,
    },
    components: {
        InputError,
        CommentForm,
        PrimaryButton,
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
        toggleLike(commentId) {
            console.log('Like!')
            axios.post(route('client.comments.like.toggle', commentId)).then(
                (res) => {
                    this.commentData = res.data
                    //this.post.who_liked_count = res.data.who_liked_count
                }
            )
        }
    },

});
</script>