<template>
    <div class="col-sm-12 col-md-8 col-lg-5">
        <h2 clas="text-center">Instructor</h2>
        <div class="card shadow">
            <div class="card-header py-3">
                <h5 v-if="selectedView === 'addView'" class="text-primary font-weight-bold">Agregar</h5>
                <h5 v-else class="text-primary font-weight-bold">Editar</h5>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <form @submit.prevent="">
                        <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                            <button class="btn btn-info form-button m-3" @click="goToList()"><i class="el-icon-s-fold"></i></button>
                            <br>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center m-0 p-0">
                                <div class="col-12 m-0 p-0 text-left">
                                    <h3 for="name">Nombre:</h3>
                                    <div class="w-100">
                                        <input type="text" class="form-control mb-2 text-left" name="name" id="name"  v-model="instructor.name">
                                    </div>
                                    <div v-if='!nameFilled'>
                                        <p>Por favor ingresa el nombre.</p>
                                    </div>
                                    <br>
                                    <h3 for="mail">Correo electronico:</h3>
                                    <div class="w-100">
                                        <input type="text" class="form-control mb-2 text-left" name="mail" id="mail" v-model="instructor.mail">
                                    </div>
                                    <div v-if='!emailFilled'>
                                        <p>Por favor ingresa el mail.</p>
                                    </div>
                                    <br>
                                    <h3 for="phone">Telefono:</h3>
                                    <div class="w-100">
                                        <input type="text" class="form-control  mb-2 text-left" name="phone" id="phone" v-model="instructor.phone">
                                    </div>
                                    <div v-if='!phoneFilled'>
                                        <p>Por favor ingresa el telefono.</p>
                                    </div>
                                    <div class="row col-12">
                                        <div class="col-sm-12 text center" v-if="selectedView === 'addView'">
                                            <button v-if='nameFilled && emailFilled && phoneFilled'  class="btn btn-success form-button m-3 col-sm-12 col-lg-6" @click="addInstructor()"><i class="el-icon-finished w-100"></i></button>
                                        </div>
                                        <div class="col-sm-12 text center" v-if="selectedView === 'updateView'">
                                            <button v-if='nameFilled && emailFilled && phoneFilled' class="btn btn-success form-button m-3 col-sm-12 col-lg-6" @click="updateInstructor()"><i class="el-icon-finished w-100"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props:{
            route: '',
            instructor:{}
        },
        data(){
            return{
                selectedView: ''
            }
        },
        created() {
            console.log(this.instructor, this.route);
            if(this.instructor.id === 0){
                this.selectedView = 'addView';
            }else{
                this.selectedView = 'updateView';
            }
        },
        methods: {
            addInstructor(){
                const  params = {
                    name: this.instructor.name,
                    mail: this.instructor.mail,
                    phone: this.instructor.phone,
                };
                axios.post(this.route, params).
                then((response) => {
                    // const instructor = response.data;
                    // this.$emit('new', instructor);
                    this.showSuccessNotification('Instructor Agregado','El Instructor se agrego correctamente');
                });
            },
            showSuccessNotification(title,text){
                this.$notify({
                    title: title,
                    message:text,
                    type: 'success'
                });
            },
            showErrorNotification(title,text){
                this.$notify({
                    title:title,
                    message: text,
                    type: 'error'
                })
            },
            updateInstructor(){
                const params = {
                    name: this.instructor.name,
                    mail: this.instructor.mail,
                    phone: this.instructor.phone
                };
                this.instructor.name = this.temp_name;
                this.instructor.phone = this.temp_phone;
                this.instructor.mail = this.temp_mail;
                axios.put(this.route+'/'+`${this.instructor.id}`, params).then((response) => {
                    // this.editMode = false;
                     const instructor = response.data;
                    // this.$emit('update', instructor);
                    this.showSuccessNotification('Instructor Actualizado','El Instructor se actualizo');
                });
            }
        },
        computed:{
            phoneFilled () {
                return (this.phone !== '')
            },
            emailFilled () {
                return (this.mail !== '')
            },
            nameFilled () {
                return (this.name !== '')
            },
            goToList()
            {
                window.location.href=this.route;
            }
        }
    }
</script>
