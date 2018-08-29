import Vue from 'vue';

import VerticalTabs from './components/tabs-vertical.vue';
import TabLabel from './components/tab-label.vue';
import TabContent from './components/tab-content.vue';

new Vue({
    el: '#vue-app',

    components: { VerticalTabs, TabLabel, TabContent }
});
