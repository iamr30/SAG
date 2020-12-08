require('./bootstrap');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'
window.Vue = require('vue');
Vue.use(ElementUI,{locale});
import {EagleModal} from 'vue-eagle-modal'
Vue.use(EagleModal);

Vue.component('top-menu-component', require('./components/Menus/TopBarMenu.vue').default);
Vue.component('top-menu-component-guest', require('./components/Menus/TopBarMenuGuest.vue').default);
Vue.component('sidebar-menu-component', require('./components/Menus/SideBarMenu.vue').default);
Vue.component('sidebar-menu-component-guest', require('./components/Menus/SideBarMenuGuest.vue').default);

Vue.component('form-instructor-component', require('./components/Instructors/FormInstructorComponent.vue').default);
Vue.component('instructor-component', require('./components/Instructors/InstructorComponent.vue').default);
Vue.component('my-instructors-component', require('./components/Instructors/MyInstructorsComponent.vue').default);
Vue.component('detail-instructor-component', require('./components/Instructors/DetailComponent').default);

const app = new Vue({
    el: '#app',
});