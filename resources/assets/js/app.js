import Vue from 'vue';

new Vue({
    el: '#vue-app',

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
});
