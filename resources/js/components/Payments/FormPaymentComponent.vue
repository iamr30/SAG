<template>

    <div class="card">

        <div class="card-header">Nuevo Pago</div>

        <div class="card-body">
            <form action="" v-on:submit.prevent="newPayment()" >

                <div class="form-group">
                    <label for="reference">Referencia:</label>
                    <input type="text" class="form-control" name="reference" id="reference"
                           v-model="reference">
                    <div v-if='!referenceFilled'>
                        <p>Por favor ingresa la referencia.</p>
                    </div>
                    <label for="comments">Comentario:</label>
                    <input type="text" class="form-control" name="comments" id="comments"
                           v-model="comments">
                    <div v-if='!commentsFilled'>
                        <p>Por favor ingresa el comentario.</p>
                    </div>
                    <label for="amount">Monto:</label>
                    <input type="number" min="0.0" step="0.01" placeholder="0.00" class="form-control" name="amount" id="amount"
                           v-model="amount">
                    <div v-if='!amountFilled'>
                        <p>Por favor ingresa el monto.</p>
                    </div>
                    <label for="expiration_date">Fecha de expiracion:</label>
                    <input type="date" class="form-control" name="expiration_date" id="expiration_date"
                           v-model="expiration_date">
                    <div v-if='!expirationFilled'>
                        <p>Por favor elegir fecha.</p>
                    </div>
                    <div>
                        <label class="typo__label">Usuario CDU:</label>
                        <multiselect  v-model="usr_cdu" :options="usrs_cdu"  placeholder="Select one" id="usr_cdu" label="username" track-by="username"></multiselect>
                    </div>



                    <div v-if='!usr_cduSelected'>
                        <p>Selecciona un Usuario.</p>
                    </div>

                    <div>
                        <label class="typo__label">ID Horario:</label>
                        <select
                            data-live-search="true"
                            id="assigned"
                            v-model="id_assigned"
                            name="assigned"
                            class="align-content-end selectpicker"
                        >
                            <option v-bind:value="assigned.id" v-for="asi in assigneds" :key="asi">{{asi.id}}</option>
                        </select>
                    </div>

                </div>
                <button v-if='referenceFilled && commentsFilled && usr_cduSelected' type="submit" class="btn btn-primary">Agregar Pago</button>
            </form>
        </div>
    </div>
</template>

<script>

import Multiselect from 'vue-multiselect'
    export default {
        components:
            {
                Multiselect
            },
        data(){
            return{
                usrs_cdu: [],
                usr_cdu: '',
                assigneds: [],
                reference: '',
                comments: '',
                amount: '',
                expiration_date:'',
                id_userCDU: '',
                id_assigned: ''
            }
        },
        mounted() {
            axios.get('/asignar').then((response) =>{
                this.assigneds = response.data;
            });
            axios.get('/usuarioscdu').then((response) =>{
                this.usrs_cdu = response.data;
            });
        },
        methods: {
            newPayment(){
                const  params = {
                    reference: this.reference,
                    comments: this.comments,
                    expiration_date: this.expiration_date,
                    amount: this.amount,
                    id_userCDU: this.usr_cdu.id,
                    id_assigned: this.id_assigned
                };
                axios.post('/payments', params).then((response) => {
                    const payment = response.data;
                    this.$emit('new', payment);
                });
                this.reference= '';
                this.comments= '';
                this.id_userCDU= '';
                this.expiration_date= '';
                this.amount= '';
                this.id_assigned= '';

            },
        },
        computed:{
            commentsFilled () {
                return (this.comments !== '')
            },
            expirationFilled () {
                return (this.expiration_date !== '')
            },
            referenceFilled () {
                return (this.reference !== '')
            },
            amountFilled () {

                return (this.amount !== 0)
            },
            usr_cduSelected () {
                return (this.usrs_cdu !== '')
            }
        }
    }
</script>
