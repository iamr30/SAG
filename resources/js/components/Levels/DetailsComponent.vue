<template>
    <div class="col-sm-12 col-md-8 col-lg-5">
        <h2 class="text-dark mb-4">Niveles</h2>
        <div id="" class="card shadow">
            <div class="col-12 m-0 p-0">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Detalles</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="">
                        <div class="col-12">
                            <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                                <button class="btn btn-info form-button mr-0" @click="showList()"><i class="el-icon-s-fold"></i></button>
                                <br>
                                <br>
                            </div>
                            <div class="row justify-content-center m-0 p-0">
                                <div class="col-12 text-left m-0 p-0">
                                    <h3>ID</h3>
                                    <input type="text" placeholder="Nombre" class="form-control mb-2 text-left" v-model="this.level.id" disabled>
                                    <h3>Nombre</h3>
                                    <input type="text" placeholder="Nombre" class="form-control mb-2 text-left" v-model="this.level.name" disabled>
                                    <br>
                                    <div>
                                        <h3>Disciplina</h3>
                                        <input type="text" class="form-control mb-2 text-left " v-model="discipline.name" disabled>
                                        <a href="javascript:void(0)" @click="disciplineDetails()">Ver detalles de la disciplina</a>
                                    </div>
                                    <div class="row col-12" v-if="user.role_id!=3">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark" @click="setEditView()"><i class="el-icon-edit"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            level:{},
            discipline:{}
            
        },
        data(){
            return {
                disciplineText:'',
                user:{}
            }
        },
        created(){
            axios.get('/admin/authuser').then((response)=>{
                this.user=response.data;
            });
        },
        methods:{
            setEditView(){
                window.location.href="/admin/niveles/editar/"+this.level.id;
            },
            showList(){
                window.location.href="/admin/niveles/";
            },
            disciplineDetails(){
                window.location.href="/admin/disciplinas/"+this.discipline.id;
            }

        }
        
    }
</script>