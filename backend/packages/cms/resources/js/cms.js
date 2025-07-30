import { createApp } from 'vue';
import CmsExample from './components/CmsExample.vue';
import '../css/cms.css';

const app = createApp({});

app.component('cms-example', CmsExample);

// Opcjonalny hook na dodatkowe komponenty z projektu
if (window.__CMS_PROJECT_COMPONENTS__) {
    window.__CMS_PROJECT_COMPONENTS__(app);
}

app.mount('#app');
