<template>
    <tr class="">
        <td class="">
            <input v-if="editMode" type="text" class="form-control" v-model="temp_name">
            <p v-else class="bg-light">{{role.name}}</p>
        </td>
        <td class="">
            <input v-if="editMode" type="text" class="form-control" v-model="temp_display_name">
            <p v-else>{{role.display_name}}</p>
        </td>
        <td class="text-md-center">
            <button v-if="editMode" class="btn btn-success" v-on:click="onClickUpdate()"><i class="el-icon-success"></i></button>
            <button v-else class="btn btn-secondary" v-on:click="onClickEdit()"><i class="el-icon-edit"></i></button>
            <button v-if="editMode" class="btn btn-danger" v-on:click="onClickCancel()"><i class="el-icon-error"></i></button>
            <button v-else class="btn btn-danger" v-on:click="onClickDelete()"><i class="el-icon-delete"></i></button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['role'],
        data() {
            return {
                temp_name: this.role.name,
                temp_display_name: this.role.display_name,
                editMode: false
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            onClickDelete() {
                this.$confirm('¿Realmente desea eliminar el Rol?','Alerta',{
                    confirmButtonText:'Continuar',
                    cancelButtonText: 'Cancelar',
                    type:'warning'
                }).then(()=> {
                    axios.delete(`/roles/${this.role.id}`).then(() => {
                        this.$emit('delete');
                        this.showSuccessNotification('Rol eliminado', 'El Rol fue eliminado exitosamente');
                    })
                });
            },
            onClickEdit(){
                this.editMode = true;
            },
            onClickCancel(){
                this.editMode = false;
            },
            onClickUpdate(){
                const params = {
                    name: this.temp_name,
                    display_name: this.temp_display_name
                };
                this.role.display_name = this.temp_display_name;
                this.role.name = this.temp_name;
                axios.put(`/roles/${this.role.id}`, params).then((response) => {
                    this.editMode = false;
                    const role = response.data;
                    this.$emit('update', role);
                    this.showSuccessNotification('Role Actualizado','El Rol se actualizo');
                });
            },
            showSuccessNotification(title,text) {
                this.$notify({
                    title: title,
                    message: text,
                    type: 'success'
                });
            }
        }
    }
</script>

