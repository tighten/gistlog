<template>
    <div class="flex my-6">
        <div class="w-12 h-12 rounded-full overflow-hidden">
            <img
                :src="comment.user.avatar_url"
                :alt="`${comment.user.login} - GistLog`"
            />
        </div>
        <div class="flex-1 flex flex-col px-2 sm:pl-4 sm:p-0 max-w-full break-words">
            <span class="text-blue-darker text-sm font-normal">
                <a
                    :href="comment.user.html_url"
                    target="_blank"
                    class="no-underline"
                    >{{ comment.user.login }}</a
                >
                &bull;
                <a
                    :href="`https://gist.github.com/${gistId}#gistcomment-${comment.id}`"
                    class="no-underline"
                    >{{ friendlyFormattedTimestamp }}</a
                >
            </span>
            <span
                class="font-normal text-sm leading-normal text-justify"
                v-html="comment.body_html"
            >
            </span>
        </div>
    </div>
</template>

<script>
import Moment from 'moment';

export default {
    props: {
        gistId: String,
        comment: Object,
    },
    computed: {
        friendlyFormattedTimestamp() {
            return Moment(this.comment.updated_at).fromNow();
        },
    },
};
</script>
