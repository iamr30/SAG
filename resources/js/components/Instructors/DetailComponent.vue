<template>
    <div class="container-fluid">

        <div class="row col-lg-12 text-center">
            <div class="text-dark pl-2 mb-4">
                <h2>Instructor</h2>
            </div>
        </div>
        <div class="row col-lg-12 text-center">

            <div class="pl-2 pr-0 pb-0 pt-0 col-lg-3 mb-4 text-left">

                <div id="" class="card shadow">
                    <div class="col-12 m-0 p-0">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold">Detalles</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="">
                                <div class="col-12">
                                    <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
                                        <button class="btn btn-info form-button mr-0" @click="showList()"><i class="el-icon-s-fold"></i></button>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="row justify-content-left m-0 p-0">
                                        <div class="col-12 text-left m-0 p-0">
                                            <h3>Nombre</h3>
                                            <input type="text" placeholder="Nombre" class="form-control mb-2 text-left" v-model="instructor.name" disabled>

                                            <div>
                                                <h3>Email</h3>
                                                <input type="text" placeholder="Disciplina" class="form-control mb-2 text-left " v-model="instructor.mail" disabled>
                                                <!--a href="javascript:void(0)" @click="disciplineDetails()">Ver detalles de la disciplina</a-->
                                            </div>
                                            <div>
                                                <h3>Telefono</h3>
                                                <input type="text" placeholder="Nivel" class="form-control mb-2 text-left " v-model="instructor.phone" disabled>
                                            </div>
                                            <!--h3>Costo</h3>
                                            <input type="number" placeholder="Costo" class="form-control mb-2 text-left " v-model="instructor.cost" disabled>
                                            <h3>Referencia</h3>
                                            <input type="text" placeholder="Referencia" class="form-control mb-2 text-left " v-model="instructor.reference" disabled>
                                            <h3>Fecha de inicio</h3>
                                            <input type="text" placeholder="Fecha inicio" class="form-control mb-2 text-left " v-model="instructor.date_start" disabled>
                                            <h3>Fecha de fin</h3>
                                            <input type="text" placeholder="Fecha fin" class="form-control mb-2 text-left " v-model="instructor.date_end" disabled>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <button class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark" @click="setEditView()"><i class="el-icon-edit"></i></button>
                                                </div>
                                            </div-->
                                            <div v-if="user.role_id !==3" class="row col-12">
                                                <div class="col-12 text-center">
                                                    <button class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark" @click="gotoEdit()"><i class="el-icon-edit"></i></button>
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
            <div class="pl-2 pr-0 pb-0 pt-0 col-lg-9 text-left">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h5 class="text-primary font-weight-bold">Horarios asignados al instructor</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-right col-sm-12 col-lg-12 m-0 p-0">
                            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
                            <!--                <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click=""><i class="el-icon-search"></i></button>-->
                        </div>

                        <div class="table-responsive table mt-2" role="grid">
                            <table class="table my-0">
                                <thead>
                                <tr  class="text-center">
                                    <th @click="sortTable('course')" scope="col">Nombre del curso</th>
                                    <th @click="sortTable('capacity')" scope="col">Capacidad</th>
                                    <th scope="col">Lunes</th>
                                    <th scope="col">Martes</th>
                                    <th scope="col">Miercoles</th>
                                    <th scope="col">Jueves</th>
                                    <th scope="col">Viernes</th>
                                    <th scope="col">Sabados</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(schedule) in schedules">
                                    <td class="text-md-center">
                                        <p class="bg-light">{{schedule.course.name}}</p>
                                    </td>
                                    <td class="text-md-center">
                                        <p >{{schedule.capacity}}</p>
                                    </td>
                                    <td class="text-md-center"><p v-if="schedule.m !== null" >{{schedule.m}}</p><i v-else class="el-icon-minus"></i></td>
                                    <td class="text-md-center"><p v-if="schedule.t !== null" >{{schedule.t}}</p><i v-else class="el-icon-minus"></i></td>
                                    <td class="text-md-center"><p v-if="schedule.w !== null" >{{schedule.w}}</p><i v-else class="el-icon-minus"></i></td>
                                    <td class="text-md-center"><p v-if="schedule.r !== null" >{{schedule.r}}</p><i v-else class="el-icon-minus"></i></td>
                                    <td class="text-md-center"><p v-if="schedule.f !== null" >{{schedule.f}}</p><i v-else class="el-icon-minus"></i></td>
                                    <td class="text-md-center"><p v-if="schedule.s !== null" >{{schedule.s}}</p><i v-else class="el-icon-minus"></i></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr  class="text-center">
                                    <th @click="sortTable('course')" scope="col">Nombre del curso</th>
                                    <th @click="sortTable('capacity')" scope="col">Capacidad</th>
                                    <th scope="col">Lunes</th>
                                    <th scope="col">Martes</th>
                                    <th scope="col">Miercoles</th>
                                    <th scope="col">Jueves</th>
                                    <th scope="col">Viernes</th>
                                    <th scope="col">Sabados</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h3 class="bg-red" v-if="selectedSchedules.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                        <div class="pagination col-12 p-0">
                            <div class="text-left col-8 p-0">
                                <h5 class="text-info ml-5">Mostrando {{selectedSchedules.length}} de {{schedules.length}}</h5>
                            </div>
                            <div class="text-right col-4 p-0">
<!--                                <button class="btn btn-default p-0 mr-2" @click="updateTable(-1)" :disabled="actualPage==0"><i class="el-icon-arrow-left"></i></button>-->
<!--                                <span class="">{{actualPage+1}} de {{totalPages}}</span>-->
<!--                                <button class="btn btn-default p-0 ml-2" @click="updateTable(1)" :disabled="actualPage+1==totalPages"><i class="el-icon-arrow-right"></i></button>-->
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
    </div>

</template>

<script>
export default{
    props:['instructor'],
    data(){
        return {
            schedules: [],
            allSchedules: [],
            selectedSchedules:[],
            pagination:10.0,
            actualPage:0,
            totalPages:0,
            order:0,
            search:'',
            user:{}
        }
    },

    mounted() {
        this.totalPages=Math.ceil(this.selectedSchedules.length/this.pagination);
        this.searching(2);
        // console.log(this.allSchedules);
    },
    created(){
        // console.log(this.instructor, this.schedule);
        axios.get('/admin/instructors/schedules/'+`${this.instructor.id}`).then((response) =>{
            for (let sched in response.data.schedules){
                this.schedules.push(response.data.schedules[sched]);
            }
            this.allSchedules = this.schedules;
            this.selectedSchedules = this.allSchedules;
            console.log(this.selectedSchedules);
        });
        axios.get('/admin/authuser').then((response) =>{
            this.user = response.data;
        });

    },
    methods:{
        showList(){
            window.location.href="/admin/instructors/";
        },
        gotoEdit(){
            window.location.href="/admin/instructors/editar/"+this.instructor.id;
        },
        reloadPage(){
            window.location.reload(true);
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
        sortTable(value){
            if(this.order === 1){
                this.order=2;
            }else{
                this.order=1;
            }
            if(value ==='course'){
                if(this.order===1){
                    this.selectedSchedules.sort(function(a,b){return a.course.name<b.course.name?-1:a.course.name>b.course.name});
                }else{
                    this.selectedSchedules.sort(function(a,b){return a.course.name>b.course.name?-1:a.course.name<b.course.name});
                }
            }else if(value === 'capacity'){
                if(this.order===1){
                    this.selectedSchedules.sort(function(a,b){return a.capacity<b.capacity?-1:a.capacity>b.capacity});
                }else{
                    this.selectedSchedules.sort(function(a,b){return a.capacity>b.capacity?-1:a.capacity<b.capacity});
                }
            }
            this.updateTable(0);
        },
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
                    if(l.course.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                        this.selectedSchedules.push(l);
                    }else if(l.capacity.toString().indexOf(this.search.trim())>-1){
                        this.selectedSchedules.push(l);
                    }
                }
                if(value === 1){
                    this.actualPage=0;
                }
                this.updateTotalPages();
                this.updateTable(0);
            }
        }
    }

}
</script>
