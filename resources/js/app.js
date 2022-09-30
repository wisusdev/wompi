import './bootstrap';

import { createApp } from 'vue';
import assets from './mixins/assets.js';
import ItemComponent from "./components/ItemComponent.vue";

const app = createApp({});
app.mixin(assets);
app.component('ItemComponent', ItemComponent);
app.mount('#app');
