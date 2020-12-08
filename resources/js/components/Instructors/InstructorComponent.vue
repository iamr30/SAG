<template>
    <tr>
        <td class="w-25">
            <input v-if="editMode" type="text" class="form-control" v-model="temp_name">
            <p v-else>{{instructor.name}}</p>
        </td>
        <td class="w-45">
            <input v-if="editMode" type="text" class="form-control" v-model="temp_mail">
            <p v-else>{{instructor.mail}}</p>
        </td>
        <td class="w-25">
            <input v-if="editMode" type="text" class="form-control" v-model="temp_phone">
            <p v-else>{{instructor.phone}}</p>
        </td>
        <td class="m-0 p-0">
            <div class="col-12 m-0">
                <button v-if="!editMode" class="btn btn-info m-1 col-xl-3 col-xs-12" v-on:click="onClickDetail()"><i class="el-icon-view"></i></button>
                <button v-if="editMode" class="btn btn-success m-1 col-xl-3 col-xs-12" v-on:click="onClickUpdate()"><i class="el-icon-success"></i></button>
                <button v-else class="btn btn-secondary m-1 col-xl-3 col-xs-12" v-on:click="onClickEdit()"><i class="el-icon-edit"></i></button>
                <button v-if="editMode" class="btn btn-danger m-1 col-xl-3 col-xs-12" v-on:click="onClickCancel()"><i class="el-icon-error"></i></button>
                <button v-else class="btn btn-danger m-1 col-xl-3 col-xs-12" v-on:click="onClickDelete()"><i class="el-icon-delete"></i></button>
            </div>


        </td>
    </tr>
</template>

<script>
    export default {
        props: ['instructor', 'route'],
        data() {
            return {
                temp_name: this.instructor.name,
                temp_mail: this.instructor.mail,
                temp_phone: this.instructor.phone,
                editMode: false
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            onClickDetail() {
                window.location.href=this.route+'/'+this.instructor.id;
            },
            onClickDelete() {
                this.$confirm('¿Realmente desea eliminar el Instructor?','Alerta',{
                    confirmButtonText:'Continuar',
                    cancelButtonText: 'Cancelar',
                    type:'warning'
                }).then(()=> {
                    axios.delete(this.route+'/'+`${this.instructor.id}`).then(res=>{
                        if(res.data['information'] === 'good'){
                            this.$emit('delete');
                            this.showSuccessNotification('Instructor eliminado', 'El Instructor fue eliminado exitosamente');
                        }else{
                            this.showErrorNotification('Error al eliminar','El instructor se encuentra asignado a un horario');
                        }

                        });
                });
            },
            onClickEdit(){
                window.location.href=this.route+'/editar/'+this.instructor.id;
            },
            // onClickCancel(){
            //     this.editMode = false;
            // },
            // onClickUpdate(){
            //     const params = {
            //         name: this.temp_name,
            //         mail: this.temp_mail,
            //         phone: this.temp_phone
            //     };
            //     this.instructor.name = this.temp_name;
            //     this.instructor.phone = this.temp_phone;
            //     this.instructor.mail = this.temp_mail;
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
