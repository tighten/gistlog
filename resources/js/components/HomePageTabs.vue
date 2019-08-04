<template>
    <div class="container py-1 mx-auto mb-6">
        <div class="hidden md:flex flex-col md:flex-row justify-around -mx-8">
            <div class="flex flex-col w-full md:w-1/3">
                <div :class="{'tab-label--active': isActive(1) }" class="tab-label" @click="changeTab(1)">
                    <span>1</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Create a Gist</h4>
                        <p class="text-grey-darker py-1 text-sm">Create a GitHub Gist with Markdown</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(2) }" class="tab-label" @click="changeTab(2)">
                    <span>2</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Paste the Link</h4>
                        <p class="text-grey-darker py-1 text-sm">Paste your Gist's URL into GistLog</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(3) }" class="tab-label" @click="changeTab(3)">
                    <span>3</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Share your Post</h4>
                        <p class="text-grey-darker py-1 text-sm">Share your GistLog link 🎉</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center md:w-3/5">
                <img v-if="currentTab == 1" src="/img/step1.jpg" alt="Step 1 - create Gist" class="border border-grey-light rounded shadow-lg w-full">
                <img v-if="currentTab == 2" src="/img/step2.jpg" alt="Step 2 - paste Gist link" class="border border-grey-light rounded shadow-lg w-full">
                <img v-if="currentTab == 3" src="/img/step3.jpg" alt="Step 3 - share your post" class="border border-grey-light rounded shadow-lg w-full">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentTab: 1,
            }
        },
        methods: {
            changeTab(tab) {
                this.currentTab = tab;
            },

            isActive(tab) {
                return this.currentTab === tab;
            }
        }
    }
</script>
