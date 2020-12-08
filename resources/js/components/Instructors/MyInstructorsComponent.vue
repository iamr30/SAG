<template>
    <div class="container-fluid">
        <h2 class="text-dark mb-4">Instructores</h2>
        <div class="card shadow">
            <div class="m-19">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Listado</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 m-0 p-0">
                        <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
                            <button class="btn btn-success col-12 m-0 pl-0 pr-0" icon="el-icon-plus" v-on:click="goToCreate()" type="success"><i class="el-icon-plus"></i>Añadir</button>
                        </div>
                        <div class="text-right col-sm-10 col-lg-11 m-0 p-0">
                            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
                            <!--                    <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click=""><i class="el-icon-search"></i></button>-->
                        </div>
                    </div>

                    <div class="table-responsive table mt-2" role="grid">
                        <table class="table my-0">
                            <thead>
                            <tr class="text-center">
                                <th @click="sortTable('name')" scope="col">Nombre</th>
                                <th @click="sortTable('mail')" scope="col">Correo</th>
                                <th @click="sortTable('phone')" scope="col">Telefono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <instructor-component
                                v-for="(instructor, index) in instructors"
                                :key="instructor.id"
                                :instructor="instructor"
                                :route="route"
                                class="text-center"
                                @delete="deleteInstructor(index, instructor)">
                                <!--                    @update="updateInstructor(index, instructor)">-->
                            </instructor-component>
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <th @click="sortTable('name')" scope="col">Nombre</th>
                                <th @click="sortTable('mail')" scope="col">Correo</th>
                                <th @click="sortTable('phone')" scope="col">Telefono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <h3 class="bg-red" v-if="selectedInstructors.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                    <div class="pagination col-12 p-0">
                        <div class="text-left col-8">
                            <span class="text-black">Mostrando {{selectedInstructors.length}} de {{ instructors.length}}</span>
                        </div>
                        <div class="text-right col-4 p-0">
<!--                            <button class="btn btn-default p-0 mr-1" @click="updateTable(-1)" :disabled="actualPage==0"><i class="el-icon-arrow-left"></i></button>-->
<!--                            <span class="">{{actualPage+1}} de {{totalPages}}</span>-->
<!--                            <button class="btn btn-default p-0 ml-1" @click="updateTable(1)" :disabled="actualPage+1==totalPages"><i class="el-icon-arrow-right"></i></button>-->
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
    export default {
        props:['route', 'instructors'],
        data() {
            return{
                instructors: [],
                allInstructors:[],
                selectedInstructors:[],
                pagination:10.0,
                actualPage:0,
                totalPages:0,
                order:0,
                search:''
            }
        },
        mounted() {
            axios.get(this.route+'/all').then((response) =>{
                this.instructors = response.data;
                this.allInstructors = response.data;
                this.selectedInstructors=this.instructors;
                this.totalPages=Math.ceil(this.selectedInstructors.length/this.pagination);
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
                this.instructors=this.selectedInstructors.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
            },
            updateTotalPages(){
                this.totalPages = Math.ceil(this.selectedInstructors.length/this.pagination);
            },
            sortTable(value){
                if(this.order === 1){
                    this.order=2;
                }else{
                    this.order=1;
                }
                if(value ==='name'){
                    if(this.order===1){
                        this.selectedInstructors.sort(function(a,b){return a.name<b.name?-1:a.name>b.name});
                    }else{
                        this.selectedInstructors.sort(function(a,b){return a.name>b.name?-1:a.name<b.name});
                    }
                }else if(value === 'mail'){
                    if(this.order===1){
                        this.selectedInstructors.sort(function(a,b){return a.mail<b.mail?-1:a.mail>b.mail});
                    }else{
                        this.selectedInstructors.sort(function(a,b){return a.mail>b.mail?-1:a.mail<b.mail});
                    }
                }else if(value === 'phone'){
                    if(this.order===1){
                        this.selectedInstructors.sort(function(a,b){return a.phone<b.phone?-1:a.phone>b.phone});
                    }else{
                        this.selectedInstructors.sort(function(a,b){return a.phone>b.phone?-1:a.phone<b.phone});
                    }
                }
                this.updateTable(0);
            },
            searching(value){
                if(this.search.trim() === ''){
                    if(value==1){
                        this.actualPage=0;
                    }
                    this.selectedInstructors=this.allInstructors;
                    this.updateTotalPages();
                    this.updateTable(0);
                }else{
                    this.selectedInstructors=[];
                    for(let l of this.allInstructors){
                        if(l.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedInstructors.push(l);
                        }else if(l.mail.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedInstructors.push(l);
                        }else if(l.phone.toString().indexOf(this.search.trim())>-1){
                            this.selectedInstructors.push(l);
                        }else if(l.id.toString().indexOf(this.search.trim())>-1){
                            this.selectedInstructors.push(l);
                        }
                    }
                    if(value === 1){
                        this.actualPage=0;
                    }
                    this.updateTotalPages();
                    this.updateTable(0);
                }
            },
            goToCreate(){
                window.location.href=this.route + "/create";
            },
            deleteInstructor(index){
                this.instructors.splice(index, 1);
            },
            // addInstructor(instructor)
            // {
            //     this.instructors.push(instructor);
            // },
            // updateInstructor(index, instructor){
            //     this.instructors[index] = instructor;
            // }
        }
    }
</script>
