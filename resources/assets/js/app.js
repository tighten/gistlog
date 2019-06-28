window.autosize = require('autosize');
import Vue from 'vue';

Vue.config.productionTip = false;

new Vue({
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
}).$mount('#vue-app');
