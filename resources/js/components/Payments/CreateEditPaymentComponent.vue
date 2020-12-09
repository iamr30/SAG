<template>
    <div class="container-fluid">

        <div class="row col-lg-12 text-center">
            <div class="pl-2 pr-0 pb-0 pt-0 col-lg-5 mb-4">
                <h2 class="text-dark text-left">Pagos</h2>
                <div class="card shadow">
                    <div class="col-12 m-0 p-0">
                        <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold">Detalles</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="">
                                <div class="col-12">
                                    <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                                        <button v class="btn btn-info form-button mr-0" @click="showList()"><i class="el-icon-s-fold"></i></button>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="row justify-content-center m-0 p-0">
                                        <div class="col-12 text-left m-0 p-0">
                                            <h3>ID</h3>
                                            <input type="text" placeholder="Nombre" class="form-control mb-2 text-left" v-model="payment.id" disabled>
                                            <h3>Fecha</h3>
                                            <input type="text" placeholder="Fecha" class="form-control mb-2 text-left" v-model="payment.created_at" disabled>
                                            <h3>Referencia</h3>
                                            <input type="text" placeholder="Referencia" class="form-control mb-2 text-left" v-model="payment.reference">
                                            <h3>Monto</h3>
                                            <input type="text" placeholder="Monto" class="form-control mb-2 text-left" v-model="payment.amount">
                                            <h3>Comentario</h3>
                                            <input type="text" placeholder="Referencia" class="form-control mb-2 text-left" v-model="payment.comments" >
                                            <h3>Fecha de expiración</h3>
                                            <input type="text" placeholder="Referencia" class="form-control mb-2 text-left" v-model="payment.expiration_date" disabled>

                                            <div class="row col-12">
                                                <div v-if="user.role_id !==3" class="col-12 text-center">
                                                    <button class="btn btn-success form-button m-3 col-sm-12 col-lg-6" @click="updatePayment()"><i class="el-icon-finished w-100 " ></i></button>
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

            <div class="pl-2 pr-0 pb-0 pt-0 col-lg-7 ">
                <div class="row pl-3">
                    <h2 class="text-dark">Perfil</h2>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h5 class="text-primary font-weight-bold">
                                    Descripción del usuario
                                </h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="username"
                                                ><strong>Nombre de usuario</strong></label
                                                ><input
                                                class="form-control"
                                                type="text"
                                                placeholder="user.name"
                                                name="username"
                                                :value="this.showId.username"
                                                disabled
                                            />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email"
                                                ><strong>Correo electrónico</strong></label
                                                ><input
                                                class="form-control"
                                                type="email"
                                                placeholder="user@example.com"
                                                name="email"
                                                :value="this.showId.email"
                                                disabled
                                            />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first_name"
                                                ><strong>Código</strong></label
                                                ><input
                                                class="form-control"
                                                type="text"
                                                placeholder="John"
                                                name="first_name"
                                                :value="this.showId.code"
                                                disabled
                                            />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="last_name"
                                                ><strong>Teléfono</strong></label
                                                ><input
                                                class="form-control"
                                                type="text"
                                                placeholder="Doe"
                                                name="last_name"
                                                :value="this.showId.phone"
                                                disabled
                                            />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-body text-center shadow">
                                <img
                                    class="rounded-circle mb-2"
                                    id="pic"
                                    width="100%"
                                />
                                <div class="mb-0">
                                    <button
                                        class="btn btn-info col-xl-5 col-xs-12"
                                        type="button"
                                        @click="goToUser()"
                                    >
                                        <i class="el-icon-view"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--    <details-component :showpay="false" :detailsid="payment.id_userCDU"></details-component>-->
</template>

<script>
export default {
    props: {
        payment:{}
    },
    data(){
        return{
            reference: '',
            agreement: '',
            expiration_date: '',
            created_at: '',
            amount: '',
            showId: [],
            response: [],
            user:{}
        }
    },
    created() {
        axios.get('/admin/authuser').then((response) => {
            this.user = response.data;
        });
    },
    mounted() {
        axios.get(`/admin/usuarioscdu/${this.payment.id_userCDU}`).then((response) => {
            this.response = response.data;
            this.showId = this.response.user;
            if (this.showId.pic == null) {
                document.getElementById("pic").src =
                    "../../../../storage/invalidPhoto.jpg";
            } else {
                document.getElementById("pic").src =
                    "../../../../storage/" + this.showId.pic;
            }
        });
    },
    methods: {
        setEditView(){
            // window.location.href="/admin/niveles/editar/"+this.level.id;
        },
        showSuccessNotification(title,text){
            this.$notify({
                title: title,
                message:text,
                type: 'success'
            });
        },
        showList(){
            window.location.href="/admin/payments/";
        },
        goToUser(){
            window.location.href="/admin/usuarioscdu/"+this.payment.id_userCDU;
        },
        updatePayment(){
            const params = {

                id_userCDU: this.payment.id_userCDU,
                reference: this.payment.reference,
                comments: this.payment.comments,
                expiration_date: this.payment.expiration_date,
                amount: this.payment.amount,
                id_assigned: this.payment.id_assigned
            }
            axios.put(`/admin/payments/${this.payment.id}`, params).then(response=>{
                this.showSuccessNotification('Pago editado','Se ha guardado el pago exitosamente');
            });
        }
    }
}
</script>
