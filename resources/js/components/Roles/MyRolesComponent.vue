<template>
    <div class="justify-content-center">
        <form-role-component @new="addRole"></form-role-component>
        <hr>
        <div class="text-right ">
            <input type="text" class="form-control col-lg-4 col-sm-8 d-inline m-0 mb-1" placeholder="Buscar" v-model="search" v-on:keyup="searching(1)" >
            <button class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1" @click=""><i class="el-icon-search"></i></button>
        </div>
        <table class="table table-hover table-striped table-bordered bg-white">
            <thead class="thead-dark">
            <tr>
                <th @click="sortTable('name')" scope="col">Nombre</th>
                <th @click="sortTable('display_name')" scope="col">Nombre para mostrar</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
            <role-component
                v-for="(role, index) in roles"
                :key="role.id"
                :role="role"
                @delete="deleteRole(index, role)"
                @update="updateRole(index, role)">
            </role-component>
            </tbody>
        </table>
        <h3 class="bg-red" v-if="selectedRoles.length == 0">NO SE ENCONTRARON REGISTROS!!!</h3>
        <div class="pagination col-12">
            <div class="text-left col-4">
                <button class="btn btn-default p-0 mr-2" @click="updateTable(-1)" :disabled="actualPage==0"><i class="el-icon-arrow-left"></i></button>
                <span class="">{{actualPage+1}} de {{totalPages}}</span>
                <button class="btn btn-default p-0 ml-2" @click="updateTable(1)" :disabled="actualPage+1==totalPages"><i class="el-icon-arrow-right"></i></button>
            </div>
            <div class="text-right col-8">
                <h5 class="text-info ml-5">{{selectedRoles.length}} registros encontrados</h5>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return{
                roles: [],
                allRoles:[],
                selectedRoles:[],
                pagination:10.0,
                actualPage:0,
                totalPages:0,
                order:0,
                search:''
            }
        },
        mounted() {
            axios.get('/roles/all').then((response) =>{
                this.roles = response.data;
                this.allRoles = response.data;
                this.selectedRoles=this.roles;
                this.totalPages=Math.ceil(this.selectedRoles.length/this.pagination);
                this.searching(2);
            });

        },
        methods:{
            addRole(role)
            {
                this.roles.push(role);
            },
            deleteRole(index){
                this.roles.splice(index, 1);
            },
            updateRole(index, role){
                this.roles[index] = role;
            },
            reloadPage(){
                window.location.reload(true);
            },
            updateTable(change){
                this.actualPage+=change;
                if(this.totalPages<this.actualPage+1){
                    this.actualPage--;
                }
                this.roles=this.selectedRoles.slice(this.actualPage*this.pagination,this.actualPage*this.pagination+this.pagination);
            },
            updateTotalPages(){
                this.totalPages = Math.ceil(this.selectedRoles.length/this.pagination);
            },
            sortTable(value){
                if(this.order === 1){
                    this.order=2;
                }else{
                    this.order=1;
                }
                if(value === 'name'){
                    if(this.order===1){
                        this.selectedRoles.sort(function(a,b){return a.name<b.name?-1:a.name>b.name});
                    }else{
                        this.selectedRoles.sort(function(a,b){return a.name>b.name?-1:a.name<b.name});
                    }
                }else if(value === 'display_name'){
                    if(this.order===1){
                        this.selectedRoles.sort(function(a,b){return a.display_name<b.display_name?-1:a.display_name>b.display_name});
                    }else{
                        this.selectedRoles.sort(function(a,b){return a.display_name>b.display_name?-1:a.display_name<b.display_name});
                    }
                }
                this.updateTable(0);
            },
            searching(value){
                if(this.search.trim() === ''){
                    if(value==1){
                        this.actualPage=0;
                    }
                    this.selectedRoles=this.allRoles;
                    this.updateTotalPages();
                    this.updateTable(0);
                }else{
                    this.selectedRoles=[];
                    for(let l of this.allRoles){
                        if(l.name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedRoles.push(l);
                        }else if(l.display_name.toLowerCase().indexOf(this.search.toLowerCase().trim())>-1){
                            this.selectedRoles.push(l);
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
