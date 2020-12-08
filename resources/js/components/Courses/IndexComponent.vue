<template>
    <div class="container-fluid">
        <h2 class="text-dark mb-4">Cursos</h2>
        <div id="" class="card shadow">
            <div class="m-19">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Listado</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 m-0 p-0">
                        <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
                            <button class="btn btn-success col-12 m-0 pl-0 pr-0" @click="setAddView()"><i class="el-icon-plus"></i>Añadir</button>
                        </div>
                        <div class="text-right col-sm-9 col-lg-10 col-xl-11 m-0 p-0">
                            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
                            <!-- <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click="searching(1)"><i class="el-icon-search"></i></button> -->
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" role="grid">
                        <table class="table my-0">
                            <thead>
                                <tr class="text-center">
                                    <th @click="sortTable('id')">ID</th>
                                    <th @click="sortTable('name')">NOMBRE</th>
                                    <th @click="sortTable('discipline')">DISCIPLINA</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in courses" :key="index" class="text-center">
                                    <td>{{item.id}}</td>
                                    <td class="w-50">{{item.name}}</td>
                                    <td class="w-25">{{item.discipline.name}}</td>
                                    <td class="m-0 p-0">
                                        <div class="col-12 m-0">
                                            <button class="btn btn-info m-1 col-xl-3 col-xs-12" @click="setDetailsView(item)"><i class="el-icon-view"></i></button>

                                            <button class="btn btn-secondary m-1 col-xl-3 col-xs-12" @click="setEditView(item)"><i class="el-icon-edit"></i></button>

                                            <button class="btn btn-danger m-1 col-xl-3 col-xs-12" @click="deletecourse(item,index)"><i class="el-icon-delete"></i></button>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th @click="sortTable('id')">ID</th>
                                    <th @click="sortTable('name')">NOMBRE</th>
                                    <th @click="sortTable('discipline')">DISCIPLINA</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <h3 class="bg-red" v-if="selectedCourses.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                    <div class="pagination col-12 p-0">
                        <div class="text-left col-8">
                            <span class="text-black">Mostrando {{courses.length}} de {{selectedCourses.length}}</span>
                        </div>
                        <div class="text-right col-4 p-0">
                            <!-- <button class="btn btn-default p-0 mr-1" @click="updateTable(-1)" :disabled="actualPage==0"><i class="el-icon-arrow-left"></i></button>
                            <span class="">{{actualPage+1}} de {{totalPages}}</span>
                            <button class="btn btn-default p-0 ml-1" @click="updateTable(1)" :disabled="actualPage+1==totalPages"><i class="el-icon-arrow-right"></i></button> -->
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item" v-if="actualPage+1 > 1"><a class="page-link" @click="updateTable(-1)" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item disabled" v-else><a class="page-link" @click="updateTable(-1)" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item" v-if="actualPage+1==totalPages && actualPage>=2"><a class="page-link" @click="updateTable(-2)">{{actualPage-1}}</a></li>
                                    <li class="page-item" v-if="actualPage+1>1"><a class="page-link" @click="updateTable(-1)">{{actualPage}}</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">{{actualPage+1}}</a></li>
                                    <li class="page-item" v-if="totalPages>actualPage+1"><a class="page-link" @click="updateTable(1)">{{actualPage+2}}</a></li>
                                    <li class="page-item" v-if="actualPage==0 && totalPages>=actualPage+3"><a class="page-link" @click="updateTable(2)">{{actualPage+3}}</a></li>
                                    <li class="page-item" v-if="actualPage+1 < totalPages"><a class="page-link" @click="updateTable(1)" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    <li class="page-item disabled" v-else><a class="page-link" @click="updateTable(1)" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                courses:[],
                order:0,
                allCourses:[],
                pagination:10.0,
                selectedCourses:[],
                course:{id:-1,name: '',id_discipline:-1,id_course:-1,date_start:null,date_end:null,cost:0.0},
                actualPage:0,
                totalPages:0,
                search:''
            }
        },
        mounted:function(){
            axios.get('/admin/cursos').then(res=>{
                this.allCourses=res.data["courses"];
                console.log(this.allCourses);
                this.selectedCourses=this.allCourses;
                this.totalPages=Math.ceil(this.selectedCourses.length/this.pagination);
                this.searching(2);
            });

        },
        methods:{
            reloadPage(){
                window.location.reload(true);
            },
            searching(value){
                if(this.search.trim() === ''){
                    if(value==1){
                        this.actualPage=0;
                    }
                    this.selectedCourses=this.allCourses;
                    this.updateTotalPages();
                    this.updateTable(0);
                }else{
                    this.selectedCourses=[];
                    for(let l of this.allCourses){
                        if(l.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedCourses.push(l);
                        }else if(l.discipline.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedCourses.push(l);
                        }else if(l.id.toString().indexOf(this.search.trim())>-1){
                            this.selectedCourses.push(l);
                        }
                    }
                    if(value === 1){
                        this.actualPage=0;
                    }
                    this.updateTotalPages();
                    this.updateTable(0);
                }
            },
            updateTable(change){
                this.actualPage+=change;
                if(this.totalPages<this.actualPage+1){
                    this.actualPage--;
                }
                this.courses=this.selectedCourses.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
            },
            updateTotalPages(){
                this.totalPages = Math.ceil(this.selectedCourses.length/this.pagination);
            },
            deletecourse(item,index){
                this.$confirm('Realmente desea eliminar el nivel','Alerta',{
                    confirmButtonText:'Continuar',
                    cancelButtonText: 'Cancelar',
                    type:'warning'
                }).then(()=>{
                    axios.delete(`/admin/cursos/${item.id}`).then(res=>{
                        if(res.data["information"] === 'good'){
                            this.allCourses.splice(this.allCourses.findIndex(a=>a.id === item.id),1);
                            this.searching(2);
                            this.showSuccessNotification('Curso eliminado','El curso fue eliminado exitosamente');
                        }else{
                            this.showErrorNotification('Error al eliminar','El curso se encuentra asignado en un horario');
                        }

                    });

                }).catch(()=>{
                    this.$notify({
                        type: 'info',
                        title: 'Eliminacion cancelada',
                        message: 'La eliminación ha sido cancelada'
                    });
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
            setAddView(){
                window.location.href="/admin/cursos/agregar";
            },
            setDetailsView(item){
                window.location.href="/admin/cursos/"+item.id;

            },
            setEditView(item){
                window.location.href="/admin/cursos/editar/"+item.id;
            },
            sortTable(value){
                if(this.order === 1){
                    this.order=2;
                }else{
                    this.order=1;
                }
                if(value ==='id'){
                    if(this.order===1){
                        this.selectedCourses.sort(function(a,b){return a.id<b.id?-1:a.id>b.id});
                    }else{
                        this.selectedCourses.sort(function(a,b){return a.id>b.id?-1:a.id<b.id});
                    }
                }else if(value === 'name'){
                    if(this.order===1){
                        this.selectedCourses.sort(function(a,b){return a.name<b.name?-1:a.name>b.name});
                    }else{
                        this.selectedCourses.sort(function(a,b){return a.name>b.name?-1:a.name<b.name});
                    }
                }else if(value === 'discipline'){
                    if(this.order===1){
                        this.selectedCourses.sort(function(a,b){return a.discipline.name<b.discipline.name?-1:a.discipline.name>b.discipline.name});
                    }else{
                        this.selectedCourses.sort(function(a,b){return a.discipline.name>b.discipline.name?-1:a.discipline.name<b.discipline.name});
                    }
                }
                this.updateTable(0);
            }
        }

    }
</script>