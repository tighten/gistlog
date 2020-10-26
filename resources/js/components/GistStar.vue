<template>
    <div>
        <a
            @click="toggleStar"
            class="shadow rounded px-2 py-3 sm:py-1 flex flex-row justify-center text-sm text-grey-darker w-100 mb-3 sm:mb-auto cursor-pointer"
        >
            <svg
                :class="{
                    'text-blue-dark': isStarred,
                    'text-grey-light': !isStarred,
                }"
                class="fill-current w-4 mr-1 sm:bg-white"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
            >
                <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                />
            </svg>
            <span v-if="isStarred">Unstar</span>
            <span v-else>Star</span>
        </a>
    </div>
</template>

<script>
export default {
    props: {
        isStarredForUser: Boolean,
        gistId: String,
    },
    data: function () {
        return {
            isStarred: !!this.isStarredForUser,
            starRoute: route('post.star', { gistId: this.gistId }),
            unstarRoute: route('post.unstar', { gistId: this.gistId }),
        };
    },
    methods: {
        toggleStar() {
            axios({
                withCredentials: true,
                method: this.isStarred ? 'delete' : 'put',
                url: this.toggleRoute(),
            }).then((response) =>
                this.isStarred
                    ? (this.isStarred = false)
                    : (this.isStarred = true)
            );
        },
        toggleRoute() {
            return this.isStarred ? this.unstarRoute : this.starRoute;
        },
    },
};
</script>
