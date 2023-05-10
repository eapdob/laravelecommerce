import './bootstrap';

import InstantSearch from 'vue-instantsearch';
import Vue from 'vue/dist/vue.js';

Vue.use(InstantSearch);

import AlgoliaAutocomplete from "@vuecustomcomponents/AlgoliaAutocomplete.vue";

Vue.component('algolia-autocomplete', AlgoliaAutocomplete);

const app = new Vue({
    el: '#app'
});
