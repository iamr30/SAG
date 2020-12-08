<template>
    <div class="container-fluid">
        <h2 class="text-dark mb-4">Horarios</h2>
        <div id="" class="card shadow">
            <div class="m-19">
                <div class="card-header py3">
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
                                    <th @click="sortTable('course')">CURSO</th>
                                    <th @click="sortTable('instructor')">INSTRUCTOR</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in schedules" :key="index" class="text-center">
                                    <td>{{item.id}}</td>
                                    <td class="w-50">{{item.course!=null?item.course.name:"No asignado"}}</td>
                                    <td class="w-25">{{item.instructor!=null?item.instructor.name:"No asignado"}}</td>
                                    <td class="m-0 p-0">
                                        <div class="col-12 m-0">
                                            <button class="btn btn-info m-1 col-xl-3 col-xs-12" @click="setDetailsView(item)"><i class="el-icon-view"></i></button>

                                            <button class="btn btn-secondary m-1 col-xl-3 col-xs-12 border-dark" @click="setEditView(item)"><i class="el-icon-edit"></i></button>

                                            <button class="btn btn-danger m-1 col-xl-3 col-xs-12" @click="deleteschedule(item,index)"><i class="el-icon-delete"></i></button>
                                        </div>
                                            
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th @click="sortTable('id')">ID</th>
                                    <th @click="sortTable('course')">CURSO</th>
                                    <th @click="sortTable('instructor')">INSTRUCTOR</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <h3 class="bg-red" v-if="selectedSchedules.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                    <div class="pagination col-12 p-0">
                        <div class="text-left col-8">
                            <span class="text-black">Mostrando {{schedules.length}} de {{selectedSchedules.length}}</span>
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
                schedules:[],
                order:0,
                allSchedules:[],
                pagination:10.0,
                selectedSchedules:[],
                schedule:{id:-1,id_course:-1,id_instructor:-1,capacity: 0},
                actualPage:0,
                totalPages:0,
                search:''
            }
        },
        mounted:function(){
            axios.get('/admin/horarios').then(res=>{
                this.allSchedules=res.data["schedules"];
                console.log(this.allSchedules);  
                for(let s of this.allSchedules){
                    if(s.course==null){
                        s.course = {name:"No asignado"};
                    }
                    if(s.instructor==null){
                        s.instructor={name:"No asignado"};
                    }
                }
                this.selectedSchedules=this.allSchedules;
                this.totalPages=Math.ceil(this.selectedSchedules.length/this.pagination);
                this.searching(2);
            });
            
        },
        methods:{
            searching(value){
                if(this.search.trim() === ''){
                    if(value==1){
                        this.actualPage=0;
                    }
                    this.selectedSchedules=this.allSchedules;
                    this.updateTotalPages();
                    this.updateTable(0);
                }else{
                    this.selectedSchedules=[];
                    for(let l of this.allSchedules){
                        if(l.course != null && l.course.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedSchedules.push(l);
                        }else if(l.instructor != null && l.instructor.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedSchedules.push(l);
                        }else if(l.id.toString().indexOf(this.search.trim())>-1){
                            this.selectedSchedules.push(l);
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
                this.schedules=this.selectedSchedules.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
            },
            updateTotalPages(){
                this.totalPages = Math.ceil(this.selectedSchedules.length/this.pagination);
            },
            deleteschedule(item,index){
                this.$confirm('Realmente desea eliminar el horario','Alerta',{
                    confirmButtonText:'Continuar',
                    cancelButtonText: 'Cancelar',
                    type:'warning'
                }).then(()=>{
                    axios.delete(`/admin/horarios/${item.id}`).then(res=>{
                        if(res.data["information"] === 'good'){
                            this.allSchedules.splice(this.allSchedules.findIndex(a=>a.id === item.id),1);
                            this.searching(2);
                            this.showSuccessNotification('Horario eliminado','El horario fue eliminado exitosamente');
                        }else{
                            this.showErrorNotification('Error al eliminar','El horario se encuentra asignado')
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
                window.location.href="/admin/horarios/agregar";
            },
            setDetailsView(item){
                window.location.href="/admin/horarios/"+item.id;

            },
            setEditView(item){
                window.location.href="/admin/horarios/editar/"+item.id;
            },
            sortTable(value){
                if(this.order === 1){
                    this.order=2;
                }else{
                    this.order=1;
                }
                if(value ==='id'){
                    if(this.order===1){
                        this.selectedSchedules.sort(function(a,b){return a.id<b.id?-1:a.id>b.id});
                    }else{
                        this.selectedSchedules.sort(function(a,b){return a.id>b.id?-1:a.id<b.id});
                    }
                }else if(value === 'course'){
                    if(this.order===1){
                        this.selectedSchedules.sort(function(a,b){return a.course.name<b.course.name?-1:a.course.name>b.course.name});
                    }else{
                        this.selectedSchedules.sort(function(a,b){return a.course.name>b.course.name?-1:a.course.name<b.course.name});
                    }
                }else if(value === 'instructor'){
                    if(this.order===1){
                        this.selectedSchedules.sort(function(a,b){return a.instructor.name<b.instructor.name?-1:a.instructor.name>b.instructor.name});
                    }else{
                        this.selectedSchedules.sort(function(a,b){return a.instructor.name>b.instructor.name?-1:a.instructor.name<b.instructor.name});
                    }
                }
                this.updateTable(0);
            }
        }
        
    }
</script>