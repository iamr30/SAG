<template>
    <tr>
        <td class="w-20">
            <p>{{payment.created_at}}</p>
        </td>
        <td class="w-20">
            <p>{{payment.users_cdu.username}}</p>
        </td>
        <td class="w-20">
            <p>{{payment.reference}}</p>
        </td>
        <td class="w-20">
            <p>{{payment.amount}}</p>
        </td>
        <td>
            <div class="col-12 m-0">
                <button class="btn btn-info m-1 col-xl-3 col-xs-12" v-on:click="onClickDetail()"><i class="el-icon-view"></i></button>
                <button class="btn btn-secondary m-1 col-xl-3 col-xs-12 border-dark" v-on:click="onClickEdit()"><i class="el-icon-edit"></i></button>
                <button class="btn btn-danger m-1 col-xl-3 col-xs-12" v-on:click="onClickDelete()"><i class="el-icon-delete"></i></button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['payment', 'route'],
    data() {
        return {
            created_at: this.payment.created_at,
            temp_mail: this.payment.users_cdu.username,
            temp_phone: this.payment.reference,
            editMode: false
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        onClickDetail() {
            window.location.href=this.route+'/'+this.payment.id;
        },
        onClickDelete() {
            this.$confirm('¿Realmente desea eliminar el Pago?','Alerta',{
                confirmButtonText:'Continuar',
                cancelButtonText: 'Cancelar',
                type:'warning'
            }).then(()=> {
                axios.delete(this.route+'/'+`${this.payment.id}`).then(res=>{
                    if(res.data['information'] === 'good'){
                        this.$emit('delete');
                        this.showSuccessNotification('Instructor eliminado', 'El Pago fue eliminado exitosamente');
                    }else{
                        this.showErrorNotification('Error al eliminar','El Pago se encuentra asignado a un curso');
                    }

                });
            });
        },
        onClickEdit(){
            window.location.href=this.route+'/editar/'+this.payment.id;
        },
        // onClickCancel(){
        //     this.editMode = false;
        // },
        // onClickUpdate(){
        //     const params = {
        //         name: this.created_at,
        //         mail: this.username,
        //         phone: this.temp_phone
        //     };
        //     this.payment.created_at = this.created_at;
        //     this.payment.reference = this.temp_phone;
        //     this.payment.users_cdu.username = this.username;
        //     axios.put(this.route+'/'+`${this.instructor.id}`, params).then((response) => {
        //         this.editMode = false;
        //         const instructor = response.data;
        //         this.$emit('update', instructor);
        //         this.showSuccessNotification('Instructor Actualizado','El Instructor se actualizo');
        //     });
        // },
        showSuccessNotification(title,text) {
            this.$notify({
                title: title,
                message: text,
                type: 'success'
            });
        },
        showErrorNotification(title,text){
            this.$notify({
                title:title,
                message: text,
                type: 'error'
            })
        }
    }
}
</script>
