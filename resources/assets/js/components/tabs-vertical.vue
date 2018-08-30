<template>
    <div class="flex">
        <div class="flex-col">
            <slot name="tabs"></slot>
        </div>

        <slot name="tab-content"></slot>
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
        onChangeTab: function (tab) {
            alert('here');
            this.currentTab = tab;
        }
    }
}
</script>

