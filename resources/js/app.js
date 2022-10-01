import './bootstrap';

import { createApp } from 'vue';
const app = createApp({});

import assets from './mixins/assets.js';
import ItemComponent from "./components/ItemComponent.vue";
import AppComponent from "./components/AppComponent";

app.mixin(assets);
app.component('ItemComponent', ItemComponent);
app.component('AppComponent', AppComponent)
app.mount('#app');
