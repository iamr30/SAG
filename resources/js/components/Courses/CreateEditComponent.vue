<template>
    <div class="col-sm-12 col-md-8 col-lg-5">
        <h1 class="text-dark mb-4">Cursos</h1>
        <div id="" class="card shadow">
            <div class="col-12 m-0 p-0">
                <div class="card-header py-3">
                    <h5 v-if="selectedView === 'addView'" class="text-primary font-weight-bold">Agregar</h5>
                    <h5 v-else class="text-primary font-weight-bold">Editar</h5>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <form @submit.prevent="">
                            <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                                <button class="btn btn-info form-button m-3" @click="showList()"><i class="el-icon-s-fold"></i></button>
                                <br>
                            </div>
                            <div class="col-12">
                                <div class="row justify-content-center m-0 p-0">
                                    <div class="col-12 m-0 p-0 text-left">
                                        <h3>Nombre</h3>
                                        <div class="w-100">
                                            <input type="text" placeholder="Nombre" class="form-control text-left mb-2" v-model="course.name" v-on:keyup="isValidName()">
                                            <h2 class="text-danger" v-if="invalidName">El nombre ya esta registrasdo!!!</h2>
                                        </div>
                                        <h3>Disciplina</h3>
                                        <div class="w-100">
                                            <el-select v-model="id_discipline" placeholder="Select" class="w-100 m-0 p-0">
                                                <el-option v-for="d in disciplines" :key="d.id" :label="d.name" :value="d.id"></el-option>
                                            </el-select>
                                        </div>
                                        <h3>Nivel</h3>
                                        <div class="w-100">
                                            <el-select v-model="id_level" placeholder="Select" class="w-100 m-0 p-0">
                                                <el-option v-for="d in levels" :key="d.id" :label="d.name" :value="d.id"></el-option>
                                            </el-select>
                                        </div>

                                        <h3>Costo</h3>
                                        <div class="w-100">
                                            <input type="number" step="0.1" placeholder="Costo" class="form-control text-left" v-model="course.cost">
                                        </div>
                                        <h3>Referencia</h3>
                                        <div class="w-100">
                                            <input type="number" placeholder="Referencia" class="form-control text-left" v-model="course.reference">
                                            
                                        </div>
                                        <h3>Fecha de inicio</h3>
                                        <div class="w-100">
                                            <el-date-picker type="date" v-model="date_start" placeholder="Seleccione una fecha" class="w-100 p-1 date"></el-date-picker>
                                        </div>
                                        <h3>Fecha de fin</h3>
                                        <div class="w-100">
                                            <el-date-picker type="date" v-model="date_end" placeholder="Seleccione una fecha" class="w-100 p-1 date"></el-date-picker>
                                        </div>
                                        <div class="row col-12">
                                            <div class="col-sm-12 text-center" v-if="selectedView==='addView'">
                                                <button class="btn btn-success form-button m-3 col-sm-12 col-lg-6" @click="addCourse()"><i class="el-icon-finished w-100"></i></button>
                                            </div>
                                            <div class="col-sm-12 text-center" v-else>
                                                <button class="btn btn-success form-button m-3 col-sm-12 col-lg-6" @click="updateCourse()"><i class="el-icon-finished w-100"></i></button>
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
    </div>
</template>

<script>
    export default{
        props:{
            course:{},
        },
        data(){
            return {
                allCourses:[],
                levels:[],
                disciplines:[],
                id_discipline: null,
                selectedView: '',
                invalidName:false,
                id_level:null,
                date_start:'',
                date_end:''
            }
        },
        created(){
            axios.get('/admin/cursos/agregar').then(res=>{
                this.allCourses=res.data["courses"];
                this.disciplines=res.data["disciplines"];
                this.levels=res.data['levels'];
                if(this.course.id===0){
                    this.selectedView = 'addView';
                }else{
                    this.selectedView = 'updateView';
                    this.id_discipline = this.course.id_discipline;
                    this.id_level = this.course.id_level;
                    this.date_start = this.course.date_start.toString();
                    this.date_end = this.course.date_end.toString();
                }
            });
        },
        methods:{
            updateDisciplineId(discipline){
                this.course.id_discipline=discipline.id;
            },
            addCourse(){
                this.course.name=this.course.name.trim();
                if(this.id_discipline===null||this.course.name === ''|| this.id_level===null || this.date_start===''||this.date_end===''||this.course.reference===''||this.course.reference===null){
                    this.showErrorNotification('Campos incompletos','Debe llenar todos los campos');
                    return;
                }
                if(!this.isValidName()){
                    this.showErrorNotification('Nombre inválido','El nombre ya se encuentra registrado');
                    return;
                }
                if(this.course.cost < 0){
                    this.showErrorNotification('Costo inválido','El costo no debe tener valores negativos');
                    return;
                }
                var ds = new Date(this.date_start);
                var de = new Date(this.date_end);
                console.log(ds);
                if(ds > de){
                    this.showErrorNotification('Fechas inválidas','El curso termina antes de empezar');
                    return;
                }
                var params = this.setReady();
                axios.post('/admin/cursos',params).then(res=>{
                    this.allCourses.push(res.data);
                    this.showSuccessNotification('Curso agregado',"Curso agregado exitosamente.");
                    this.resetFields();
                    this.showList();
                })

            },
            setReady(){
                this.course.id_discipline=this.id_discipline;
                this.course.id_level= this.id_level;
                this.course.date_start= this.date_start;
                this.course.date_end=this.date_end;
                
                console.log(this.course);
                
                const params={name: this.course.name,id_discipline: this.course.id_discipline,id_level: this.course.id_level,date_start: this.course.date_start,date_end: this.course.date_end,cost:this.course.cost,reference:this.course.reference};
                console.log(params);
                return params;
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
            isValidName(){
                var index=this.allCourses.findIndex(a=>a.name === this.course.name.trim())
                if(index>-1){
                    if(this.selectedView==='addView'){
                        this.invalidName=true;
                        return false;
                    }else{
                        if(this.course.name.trim()===this.allCourses[this.allCourses.findIndex(a=>a.id===this.course.id)].name){
                            this.invalidName=false;
                            return true;
                        }else{
                            this.invalidName=true;
                            return false;
                        }
                    }
                }else{
                    this.invalidName=false;
                    return true;
                }
            },
            updateCourse(){
                this.course.name=this.course.name.trim();
                this.course.reference=this.course.reference.trim();
                if(this.id_discipline===null||this.course.name === ''|| this.id_level===null || this.date_start===''||this.date_end===''||this.course.reference===''||this.course.reference===null){
                    this.showErrorNotification('Campos incompletos','Debe llenar todos los campos');
                    return;
                }
                if(!this.isValidName()){
                    this.showErrorNotification('Nombre inválido','El nombre ya se encuentra registrado');
                    return;
                }
                if(this.course.cost < 0){
                    this.showErrorNotification('Costo inválido','El costo no debe tener valores negativos');
                    return;
                }
                var ds = new Date(this.date_start);
                var de = new Date(this.date_end);
                console.log(ds);
                if(ds > de){
                    this.showErrorNotification('Fechas inválidas','El curso termina antes de empezar');
                    return;
                }
                var params=this.setReady();
                axios.put(`/admin/cursos/${this.course.id}`,params).then(res=>{
                    const index=this.allCourses.findIndex(search=>search.id === res.data.id);
                    this.allCourses[index]=res.data;
                    this.showSuccessNotification('Curso editado','Se ha editado el curso exitosamente');
                    this.showList();
                });
                
            },
            showList(){
                window.location.href="/admin/cursos/";
            },
            resetFields(){
                this.course.name = '';
                this.course.id_discipline = null;
                this.course.id_level = null;
                this.id_level = null;
                this.id_discipline = null;
                this.course.cost = 0;
                this.date_start = '';
                this.date_end = '';
                this.course.reference = '';
            },
            cancelUpdate(){
                window.history.go(-1);
            }
        }
        
    }
</script>