<template>
<tr class="">
    <td v-on:click="goto(attendance.id_userscdu)">
        <p>{{attendance.id_userscdu}}</p>
    </td>
    <td v-on:click="goto(attendance.id_userscdu)"  >
        <p >{{attendance.users_cdu.username}}</p>
    </td>
    <td>
        <p>{{attendance.date}}</p>
    </td>
    <td class="text-md-center">
        <button v-on:click="goto(attendance.id_userscdu)" class="btn btn-info"><i class="el-icon-view"></i></button>
    </td>
</tr>
</template>

<script>
export default {
    props: ['attendance'],
    data() {
        return {
            temp_id_userscdu: this.attendance.id_userscdu,
            temp_date: this.attendance.date,
            editMode: false
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        showSuccessNotification(title,text) {
            this.$notify({
                title: title,
                message: text,
                type: 'success'
            });
        },
        goto(id){
            window.location.href="/admin/usuarioscdu/" + id;
        }
    }
}
</script>
