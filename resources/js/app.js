require('./bootstrap');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'
window.Vue = require('vue');
Vue.use(ElementUI,{locale});
import {EagleModal} from 'vue-eagle-modal'
Vue.use(EagleModal);

Vue.component('form-user-component', require('./components/Users/FormUserComponent.vue').default);
Vue.component('user-component', require('./components/Users/UserComponent.vue').default);
Vue.component('my-users-component', require('./components/Users/MyUsersComponent.vue').default);
Vue.component('users-create-edit', require('./components/Users/CreateEditUserComponent.vue').default);

Vue.component('table-component', require('./components/UsersCdu/TableComponent.vue').default);
Vue.component('add-component', require('./components/UsersCdu/AddComponent.vue').default);
Vue.component('details-component', require('./components/UsersCdu/DetailsComponent.vue').default);
Vue.component('assignschedule-component', require('./components/UsersCdu/AssignSchedule.vue').default);
Vue.component('manageuser-component', require('./components/UsersCdu/ManageUser.vue').default);
Vue.component('paymenttable-component', require('./components/UsersCdu/PaymentsTable.vue').default);
Vue.component('condonationtable-component', require('./components/UsersCdu/CondonationTable.vue').default);
Vue.component('cardtable-component', require('./components/UsersCdu/CardTable.vue').default);
Vue.component('assigned_schedules_edit-component', require('./components/Assigned/AssignedEdit.vue').default);
Vue.component('camera-component', require('./components/UsersCdu/Camera.vue').default);
Vue.component('dashboard-component', require('./components/Dashboard/index.vue').default);
Vue.component('cardinfo-component', require('./components/Dashboard/cardInf.vue').default);

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

Vue.component('top-menu-component', require('./components/Menus/TopBarMenu.vue').default);
Vue.component('top-menu-component-guest', require('./components/Menus/TopBarMenuGuest.vue').default);
Vue.component('sidebar-menu-component', require('./components/Menus/SideBarMenu.vue').default);
Vue.component('sidebar-menu-component-guest', require('./components/Menus/SideBarMenuGuest.vue').default);

Vue.component('attendancerecord-component', require('./components/AttendancesRecord/AttendanceRecordComponent.vue').default);
Vue.component('my-attendancesrecord-component', require('./components/AttendancesRecord/MyAttendancesRecordComponent.vue').default);

Vue.component('form-payment-component', require('./components/Payments/FormPaymentComponent.vue').default);
Vue.component('payment-component', require('./components/Payments/PaymentComponent.vue').default);
Vue.component('my-payments-component', require('./components/Payments/MyPaymentsComponent.vue').default);
Vue.component('payments-create-edit', require('./components/Payments/CreateEditPaymentComponent.vue').default);
Vue.component('detail-payment-component', require('./components/Payments/DetailPaymentComponent.vue').default);

const app = new Vue({
    el: '#app',
});