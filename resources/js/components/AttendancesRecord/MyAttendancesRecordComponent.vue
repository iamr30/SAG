<template>
    <div class="container-fluid">
        <h2 class="text-dark mb-4">Entradas</h2>
        <div class="card shadow">
            <div class="m-19">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Listado</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 m-0 p-0">
                        <div class="text-right col-sm-12 col-lg-12 col-xl-12 m-0 p-0">
                            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
<!--                            <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click="searching(1)"><i class="el-icon-search"></i></button>-->
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" role="grid">

                    <table class="table my-0">
                    <thead>
                        <tr  class="text-center">
                            <th @click="sortTable('id')" scope="col">ID Usuario</th>
                            <th @click="sortTable('name')" scope="col">Usuario</th>
                            <th @click="sortTable('date')" scope="col">Fecha y Hora</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                        <tbody>
                        <attendancerecord-component
                            v-for="(attendance, index) in attendances"
                            :key="attendance.id"
                            :attendance="attendance"
                            class="text-center"
                        >
                        </attendancerecord-component>
                        </tbody>
                        <tfoot>
                            <tr  class="text-center">
                                <th @click="sortTable('id')" scope="col">ID Usuario</th>
                                <th @click="sortTable('name')" scope="col">Usuario</th>
                                <th @click="sortTable('date')" scope="col">Fecha y Hora</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <h3 class="bg-red" v-if="selectedAttendances.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                <div class="pagination col-12 p-0">
                    <div class="text-left col-4 p-0">
                        <h5 class="text-info ml-5">Mostrando {{selectedAttendances.length}} de {{attendances.length}}</h5>
                    </div>
                    <div class="text-right col-8">
<!--                        <button class="btn btn-default p-0 mr-2" @click="updateTable(-1)" :disabled="actualPage==0"><i class="el-icon-arrow-left"></i></button>-->
<!--                        <span class="">{{actualPage+1}} de {{totalPages}}</span>-->
<!--                        <button class="btn btn-default p-0 ml-2" @click="updateTable(1)" :disabled="actualPage+1==totalPages"><i class="el-icon-arrow-right"></i></button>-->
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
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return{
            attendances: [],
            allAttendances:[],
            selectedAttendances:[],
            pagination:10.0,
            actualPage:0,
            totalPages:0,
            order:0,
            search:''
        }
    },
    mounted() {
        axios.get('/admin/attendancesrecord/all').then((response) =>{
            this.attendances = response.data;
            this.allAttendances = response.data;
            this.selectedAttendances=this.attendances;
            this.totalPages=Math.ceil(this.selectedAttendances.length/this.pagination);
            this.searching(2);
        });

    },
    methods:{
        reloadPage(){
            window.location.reload(true);
        },
        updateTable(change){
            this.actualPage+=change;
            if(this.totalPages<this.actualPage+1){
                this.actualPage--;
            }
            this.attendances=this.selectedAttendances.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
        },
        updateTotalPages(){
            this.totalPages = Math.ceil(this.selectedAttendances.length/this.pagination);
        },
        sortTable(value){
            if(this.order === 1){
                this.order=2;
            }else{
                this.order=1;
            }
            if(value ==='id'){
                if(this.order===1){
                    this.selectedAttendances.sort(function(a,b){return a.users_cdu.id<b.users_cdu.id?-1:a.users_cdu.id>b.users_cdu.id});
                }else{
                    this.selectedAttendances.sort(function(a,b){return a.users_cdu.id>b.users_cdu.id?-1:a.users_cdu.id<b.users_cdu.id});
                }
            }else if(value === 'name'){
                if(this.order===1){
                    this.selectedAttendances.sort(function(a,b){return a.users_cdu.username<b.users_cdu.username?-1:a.users_cdu.username>b.users_cdu.username});
                }else{
                    this.selectedAttendances.sort(function(a,b){return a.users_cdu.username>b.users_cdu.username?-1:a.users_cdu.username<b.users_cdu.username});
                }
            }else if(value === 'date'){
                if(this.order===1){
                    this.selectedAttendances.sort(function(a,b){return a.date<b.date?-1:a.date>b.date});
                }else{
                    this.selectedAttendances.sort(function(a,b){return a.date>b.date?-1:a.date<b.date});
                }
            }
            this.updateTable(0);
        },
        searching(value){
            if(this.search.trim() === ''){
                if(value==1){
                    this.actualPage=0;
                }
                this.selectedAttendances=this.allAttendances;
                this.updateTotalPages();
                this.updateTable(0);
            }else{
                this.selectedAttendances=[];
                for(let l of this.allAttendances){
                    if(l.users_cdu.username.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                        this.selectedAttendances.push(l);
                    }else if(l.users_cdu.id.toString().indexOf(this.search.trim())>-1){
                        this.selectedAttendances.push(l);
                    }else if(l.date.toString().indexOf(this.search.trim())>-1){
                        this.selectedAttendances.push(l);
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
