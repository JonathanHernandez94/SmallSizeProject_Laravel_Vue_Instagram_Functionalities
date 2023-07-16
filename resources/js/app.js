
require('./bootstrap');

import { createApp } from 'vue'
import FollowButton from './components/FollowButton.vue'

const app = createApp({});
app.component('follow-button', FollowButton);
app.mount('#app');


