<template>
    <div class="col-sm-12 col-md-8 col-lg-5">
        <h2 class="text-dark mb-4">Cursos</h2>
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
                                    <h3>Nombre</h3>
                                    <input type="text" placeholder="Nombre" class="form-control mb-2 text-left" v-model="course.name" disabled>
                                    
                                    <div>
                                        <h3>Disciplina</h3>
                                        <input type="text" placeholder="Disciplina" class="form-control mb-2 text-left " v-model="course.discipline.name" disabled>
                                        <a href="javascript:void(0)" @click="disciplineDetails()">Ver detalles de la disciplina</a>
                                    </div>
                                    <div>
                                        <h3>Nivel</h3>
                                        <input type="text" placeholder="Nivel" class="form-control mb-2 text-left " v-model="course.level.name" disabled>
                                        <a href="javascript:void(0)" @click="levelDetails()">Ver detalles del nivel</a>
                                    </div>
                                    <h3>Costo</h3>
                                    <input type="number" placeholder="Costo" class="form-control mb-2 text-left " v-model="course.cost" disabled>
                                    <h3>Referencia</h3>
                                    <input type="text" placeholder="Referencia" class="form-control mb-2 text-left " v-model="course.reference" disabled>
                                    <h3>Fecha de inicio</h3>
                                    <input type="text" placeholder="Fecha inicio" class="form-control mb-2 text-left " v-model="course.date_start" disabled>
                                    <h3>Fecha de fin</h3>
                                    <input type="text" placeholder="Fecha fin" class="form-control mb-2 text-left " v-model="course.date_end" disabled>
                                    <div class="row" v-if="user.role_id!=3">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark" @click="setEditView()"><i class="el-icon-edit"></i></button>
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
    export default{
        props:{
            course:{}
        },
        data(){
            return {
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
                window.location.href="/admin/cursos/editar/"+this.course.id;
            },
            showList(){
                window.location.href="/admin/cursos/";
            },
            levelDetails(){
                window.location.href="/admin/niveles/"+this.course.id_level;
            },
            disciplineDetails(){
                window.location.href="/admin/disciplinas/"+this.course.discipline.id;
            }
        }
        
    }
</script>