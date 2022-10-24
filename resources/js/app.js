import './bootstrap';

import { createApp } from 'vue';
const app = createApp({});

import assets from './mixins/assets.js';
import ItemComponent from "./components/ItemComponent.vue";
import FormComponent from "./components/FormComponent";

app.mixin(assets);
app.component('ItemComponent', ItemComponent);
app.component('FormComponent', FormComponent);
app.mount('#app');
