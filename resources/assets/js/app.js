import Vue from 'vue';

import VerticalTabs from './components/tabs-vertical.vue';
import TabLabel from './components/tab-label.vue';
import TabContent from './components/tab-content.vue';

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
            return this.currentTab == tab;
        }
    }
});
