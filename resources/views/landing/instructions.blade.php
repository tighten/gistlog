<div class=" bg-grey-lightest w-full pt-8 pb-6">
    <div class="container mx-auto text-center pt-3 pb-2">
        <h2 class="mt-6 text-blue-darkest">How it works</h2>
        <div class="title-underline"></div>
        <p class="md:w-4/5 mx-auto text-grey leading-normal text-base md:px-8 my-6">In just a few steps&mdash;and just a few seconds&mdash;you can be blogging using nothing but simple GitHub Gists and Markdown.</p>
    </div>

    <div class="container py-1 mx-auto mb-6">
        <div class="flex flex-col md:flex-row justify-around">
            <div class="flex flex-col w-1/2">
                <div :class="{'tab-label--active': isActive(1) }" class="tab-label" @click="changeTab(1)">
                    <span>1</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Create a Gist</h4>
                        <p class="text-grey py-1 text-sm">Create a GitHub Gist with Markdown</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(2) }" class="tab-label" @click="changeTab(2)">
                    <span>2</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Paste the Link</h4>
                        <p class="text-grey py-1 text-sm">Paste your Gist's URL into GistLog</p>
                    </div>
                </div>

                <div :class="{'tab-label--active': isActive(3) }" class="tab-label" @click="changeTab(3)">
                    <span>3</span>
                    <div class="text-left mx-5">
                        <h4 class="text-blue font-bold text-sm">Share your Post</h4>
                        <p class="text-grey py-1 text-sm">Share your GistLog link (and celebrate!)</p>
                    </div>
                </div>
            </div>

            <div class="bg-white flex-col flex items-center p-2 rounded shadow-lg text-center w-2/5">
                <img v-if="currentTab == 1" src="{{ asset('img/step1.png') }}" alt="Step 1 - create Gist">
                <img v-if="currentTab == 2" src="{{ asset('img/step2.png') }}" alt="Step 2 - paste Gist link">
                <img v-if="currentTab == 3" src="{{ asset('img/step3.png') }}" alt="Step 3 - share your post">
            </div>
        </div>
    </div>
</div>
