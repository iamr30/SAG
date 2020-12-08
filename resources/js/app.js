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

Vue.component('tableareas-component', require('./components/Areas/TableComponent.vue').default);
Vue.component('addareas-component', require('./components/Areas/AddComponent.vue').default);
Vue.component('detailsareas-component', require('./components/Areas/DetailsComponent.vue').default);

Vue.component('tablediscipline-component', require('./components/Discipline/TableComponent.vue').default);
Vue.component('adddiscipline-component', require('./components/Discipline/AddComponent.vue').default);
Vue.component('detailsdiscipline-component', require('./components/Discipline/DetailsComponent.vue').default);

Vue.component('levels-index', require('./components/Levels/IndexComponent.vue').default);
Vue.component('levels-details', require('./components/Levels/DetailsComponent.vue').default);
Vue.component('levels-create-edit', require('./components/Levels/CreateEditComponent.vue').default);

Vue.component('courses-index', require('./components/Courses/IndexComponent.vue').default);
Vue.component('courses-details', require('./components/Courses/DetailsComponent.vue').default);
Vue.component('courses-create-edit', require('./components/Courses/CreateEditComponent.vue').default);

Vue.component('schedules-index', require('./components/Schedules/IndexComponent.vue').default);
Vue.component('schedules-details', require('./components/Schedules/DetailsComponent.vue').default);
Vue.component('schedules-create-edit', require('./components/Schedules/CreateEditComponent.vue').default);

Vue.component('form-role-component', require('./components/Roles/FormRoleComponent.vue').default);
Vue.component('role-component', require('./components/Roles/RoleComponent.vue').default);
Vue.component('my-roles-component', require('./components/Roles/MyRolesComponent.vue').default);


const app = new Vue({
    el: '#app',
});