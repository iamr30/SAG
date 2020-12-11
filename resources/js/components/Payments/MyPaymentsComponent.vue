<template>
    <div class="container-fluid">
        <h2 class="text-dark mb-4">Pagos</h2>
        <div class="card shadow">
            <div class="m-19">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Listado</h5>
                </div>
                <div class="card-body">
                    <div class="row col-12 m-0 p-0">
                        <div class="text-right col-sm-12 col-lg-12 col-xl-12 m-0 p-0">
                            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
                            <!--                    <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click=""><i class="el-icon-search"></i></button>-->
                        </div>
                    </div>

                    <div class="table-responsive table mt-2" role="grid">
                        <table class="table my-0">
                            <thead>
                            <tr class="text-center">
                                <th @click="sortTable('created_at')" scope="col">Fecha de creación</th>
                                <th @click="sortTable('users_cdu.username')" scope="col">Usuario CDU</th>
                                <th @click="sortTable('reference')" scope="col">Referencia</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <payment-component
                                v-for="(payment, index) in payments"
                                :key="payment.id"
                                :payment="payment"
                                :route="route"
                                class="text-center"
                                @delete="deleteInstructor(index, payment)">
                                <!--                    @update="updateInstructor(index, payment)">-->
                            </payment-component>
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <th @click="sortTable('created_at')" scope="col">Fecha de creación</th>
                                <th @click="sortTable('users_cdu.username')" scope="col">Usuario CDU</th>
                                <th @click="sortTable('reference')" scope="col">Referencia</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <h3 class="bg-red" v-if="selectedPayments.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
                    <div class="pagination col-12 p-0">
                        <div class="text-left col-8">
                            <span class="text-black">Mostrando {{selectedPayments.length}} de {{ payments.length}}</span>
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
    props:['route', 'payments'],
    data() {
        return{
            payments: [],
            allPayments:[],
            selectedPayments:[],
            pagination:10.0,
            actualPage:0,
            totalPages:0,
            order:0,
            search:''
        }
    },
    mounted() {
        axios.get(this.route+'/all').then((response) =>{
            this.payments = response.data;
            this.allPayments = response.data;
            this.selectedPayments=this.payments;
            this.totalPages=Math.ceil(this.selectedPayments.length/this.pagination);
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
            this.payments=this.selectedPayments.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
        },
        updateTotalPages(){
            this.totalPages = Math.ceil(this.selectedPayments.length/this.pagination);
        },
        sortTable(value){
            if(this.order === 1){
                this.order=2;
            }else{
                this.order=1;
            }
            if(value ==='created_at'){
                if(this.order===1){
                    this.selectedPayments.sort(function(a,b){return a.created_at<b.created_at?-1:a.created_at>b.created_at});
                }else{
                    this.selectedPayments.sort(function(a,b){return a.created_at>b.created_at?-1:a.created_at<b.created_at});
                }
            }else if(value === 'users_cdu.username'){
                if(this.order===1){
                    this.selectedPayments.sort(function(a,b){return a.users_cdu.username<b.users_cdu.username?-1:a.users_cdu.username>b.users_cdu.username});
                }else{
                    this.selectedPayments.sort(function(a,b){return a.users_cdu.username>b.users_cdu.username?-1:a.users_cdu.username<b.users_cdu.username});
                }
            }else if(value === 'reference'){
                if(this.order===1){
                    this.selectedPayments.sort(function(a,b){return a.reference<b.reference?-1:a.reference>b.reference});
                }else{
                    this.selectedPayments.sort(function(a,b){return a.reference>b.reference?-1:a.reference<b.reference});
                }
            }
            this.updateTable(0);
        },
        searching(value){
            if(this.search.trim() === ''){
                if(value==1){
                    this.actualPage=0;
                }
                this.selectedPayments=this.allPayments;
                this.updateTotalPages();
                this.updateTable(0);
            }else{
                this.selectedPayments=[];
                for(let l of this.allPayments){
                    if(l.created_at.toString().indexOf(this.search.toString().trim())>-1){
                        this.selectedPayments.push(l);
                    }else if(l.users_cdu.username.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                        this.selectedPayments.push(l);
                    }else if(l.reference.toString().indexOf(this.search.trim())>-1){
                        this.selectedPayments.push(l);
                    }else if(l.id.toString().indexOf(this.search.trim())>-1){
                        this.selectedPayments.push(l);
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
            this.payments.splice(index, 1);
        },
        // addInstructor(payment)
        // {
        //     this.payments.push(payment);
        // },
        // updateInstructor(index, payment){
        //     this.payments[index] = payment;
        // }
    }
}
</script>
