<template>
    <div class="col-sm-12 col-md-8 col-lg-5">
        <h2 class="text-dark mb-4">Horarios</h2>
        <div id="" class="card shadow">
            <div class="col-12 m-0 p-0">
                <div class="card-header py-3">
                    <h5 class="text-primary font-weight-bold">Detalles</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="">
                        <div class="col-12">
                            <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                                <button class="btn btn-info form-button mr-0" @click="showList()"><i class="el-icon-s-fold"></i></button>
                                <br>
                                <br>
                            </div>
                            <dir class="row justify-content-center m-0 p-0">
                                <div class="col-12 text-left m-0 p-0">
                                    <h3>Curso</h3>
                                    <input type="text" placeholder="Curso" class="form-control text-left mb-2" v-model="schedule.course.name" disabled>
                                    <a href="javascript:void(0)" @click="courseDetails()">Ver detalles del curso</a>
                                    <h3>Instructor</h3>
                                    <input type="text" placeholder="Instructor" class="form-control text-left mb-2" v-model="schedule.instructor.name" disabled>
                                    <a href="javascript:void(0)" @click="instructorDetails()">Ver detalles del instructor</a>
                                    <h3>Cupo</h3>
                                    <input type="number" placeholder="Cupo" class="form-control text-left mb-2" v-model="schedule.capacity" disabled>
                                    <h3>Días y horarios</h3>
                                    <div class="col-12 m-0 p-0">
                                        <el-collapse accordion class="bg-danger m-0 p-0">
                                            <el-collapse-item title="Lunes">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Lunes</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.monday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.monday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.monday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.monday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.monday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                        <el-collapse-item title="Martes">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Martes</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.tuesday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.tuesday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.tuesday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.tuesday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.tuesday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                            <el-collapse-item title="Miércoles">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Miércoles</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.wednesday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.wednesday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.wednesday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.wednesday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.wednesday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                            <el-collapse-item title="Jueves">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Jueves</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.thursday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.thursday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.thursday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.thursday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.thursday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                            <el-collapse-item title="Viernes">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Viernes</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.friday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.friday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.friday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.friday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.friday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                            <el-collapse-item title="Sábado">
                                                <div class="card justify-content-center text-left m-0 p-0">
                                                    <div class="card-header bg-lighten-4">
                                                        <h6 class="text-center">Clase Sábado</h6>
                                                    </div>
                                                    <div class="card-body bg-ligth table-responsive">
                                                        <el-switch v-model="days.saturday.selected" disabled></el-switch>
                                                        <br>
                                                        <br>
                                                        <div v-if="days.saturday.selected" class="row col-12 minw">
                                                            <div class="col-xs-12">
                                                                <h6>Hora Inicio</h6>
                                                                <el-time-select class="w-100 mb-2" placeholder="Hora Inicio" v-model="days.saturday.startTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05'}" disabled></el-time-select>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <h6>Hora Fin</h6>
                                                                <el-time-select class="w-100" placeholder="Hora Fin" v-model="days.saturday.endTime" :picker-options="{start: '07:00',end: '21:00',step:'00:05',minTime: days.saturday.startTime}" disabled></el-time-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </el-collapse-item>
                                        </el-collapse>
                                    </div>
                                    <div class="row col-12" v-if="user.role_id!=3">
                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6" @click="setEditView()"><i class="el-icon-edit w-100 " ></i></button>
                                        </div>
                                    </div>
                                </div>
                            </dir>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            schedule:{},
        },
        data(){
            return {
                days:{
                    monday:{selected:false,startTime:'',endTime:''},
                    tuesday:{selected:false,startTime:'',endTime:''},
                    wednesday:{selected:false,startTime:'',endTime:''},
                    thursday:{selected:false,startTime:'',endTime:''},
                    friday:{selected:false,startTime:'',endTime:''},
                    saturday:{selected:false,startTime:'',endTime:''}
                },
                user:{}
            }
        },
        created(){
            axios.get('/admin/authuser').then((response)=>{
                this.user=response.data;
            });
            if(this.schedule.course==null){
                this.schedule.course = {name:"No asignado"};
            }
            if(this.schedule.instructor==null){
                this.schedule.instructor={name:"No asignado"};
            }
            if(this.schedule.m != '' && this.schedule.m != null){
                var aux = this.schedule.m.split("-");
                this.days.monday.selected=true;
                this.days.monday.startTime = aux[0];
                this.days.monday.endTime = aux[1];
            }
            if(this.schedule.t != '' && this.schedule.t != null){
                var aux = this.schedule.t.split('-');
                this.days.tuesday.selected=true;
                this.days.tuesday.startTime = aux[0];
                this.days.tuesday.endTime = aux[1];
            }
            if(this.schedule.w != '' && this.schedule.w != null){
                var aux = this.schedule.w.split('-');
                this.days.wednesday.selected=true;
                this.days.wednesday.startTime = aux[0];
                this.days.wednesday.endTime = aux[1];
            }
            if(this.schedule.r != '' && this.schedule.r != null){
                var aux = this.schedule.r.split('-');
                this.days.thursday.selected=true;
                this.days.thursday.startTime = aux[0];
                this.days.thursday.endTime = aux[1];
            }
            if(this.schedule.f != '' && this.schedule.f != null){
                var aux = this.schedule.f.split('-');
                this.days.friday.selected=true;
                this.days.friday.startTime = aux[0];
                this.days.friday.endTime = aux[1];
            }
            if(this.schedule.s != '' && this.schedule.s != null){
                var aux = this.schedule.s.split('-');
                this.days.saturday.selected=true;
                this.days.saturday.startTime = aux[0];
                this.days.saturday.endTime = aux[1];
            }
        },
        methods:{
            updateDisciplineId(discipline){
                this.schedule.id_discipline=discipline.id;
            },
            addschedule(){
                var params = this.setReady();
                if(params === null){
                    return;
                }
                axios.post('/admin/horarios',params).then(res=>{
                    this.allSchedules.push(res.data);
                    this.showSuccessNotification('Horario agregado',"Horario agregado exitosamente.");
                    this.resetFields();
                })

            },
            setReady(){
                this.schedule.id_course=this.id_course;
                this.schedule.id_instructor = this.id_instructor;
                if(this.days.monday.selected){
                    if(this.days.monday.startTime != "" && this.days.monday.endTime != "" && this.days.monday.endTime > this.days.monday.startTime){
                        this.schedule.m = this.days.monday.startTime + '-' + this.days.monday.endTime;
                    }else{
                        this.showErrorNotification('Error Lunes','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.m='';
                }
                if(this.days.tuesday.selected){
                    if(this.days.tuesday.startTime != "" && this.days.tuesday.endTime != "" && this.days.tuesday.endTime > this.days.tuesday.startTime){
                        this.schedule.t = this.days.tuesday.startTime + '-' + this.days.tuesday.endTime;
                    }else{
                        this.showErrorNotification('Error Martes','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.t='';
                }
                if(this.days.wednesday.selected){
                    if(this.days.wednesday.startTime != "" && this.days.wednesday.endTime != "" && this.days.wednesday.endTime > this.days.wednesday.startTime){
                        this.schedule.w = this.days.wednesday.startTime + '-' + this.days.wednesday.endTime;
                    }else{
                        this.showErrorNotification('Error Miércoles','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.w='';
                }
                if(this.days.thursday.selected){
                    if(this.days.thursday.startTime != "" && this.days.thursday.endTime != "" && this.days.thursday.endTime > this.days.thursday.startTime){
                        this.schedule.r = this.days.thursday.startTime + '-' + this.days.thursday.endTime;
                    }else{
                        this.showErrorNotification('Error Jueves','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.r='';
                }
                if(this.days.friday.selected){
                    if(this.days.friday.startTime != "" && this.days.friday.endTime != "" && this.days.friday.endTime > this.days.friday.startTime){
                        this.schedule.f = this.days.friday.startTime + '-' + this.days.friday.endTime;
                    }else{
                        this.showErrorNotification('Error Viernes','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.f='';
                }
                if(this.days.saturday.selected){
                    if(this.days.saturday.startTime != "" && this.days.saturday.endTime != "" && this.days.saturday.endTime > this.days.saturday.startTime){
                        this.schedule.s = this.days.saturday.startTime + '-' + this.days.saturday.endTime;
                    }else{
                        this.showErrorNotification('Error Sábado','El rango de horario no es válido');
                        return null;
                    }   
                }else{
                    this.schedule.s='';
                }      
                console.log(this.schedule); 
                
                const params={id_course:this.schedule.id_course,id_instructor: this.schedule.id_instructor, m:this.schedule.m, t: this.schedule.t, w: this.schedule.w, r:this.schedule.r, f:this.schedule.f, s:this.schedule.s,capacity: this.schedule.capacity};
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
            updateschedule(){
                var params=this.setReady();
                if(params === null){
                    return;
                }
                axios.put(`/admin/horarios/${this.schedule.id}`,params).then(res=>{
                    const index=this.allSchedules.findIndex(search=>search.id === res.data.id);
                    this.allSchedules[index]=res.data;
                    this.showSuccessNotification('Horario editado','Se ha editado el horario exitosamente')
                });
                
            },
            setEditView(){
                window.location.href="/admin/horarios/editar/"+this.schedule.id;
            },
            resetFields(){
                this.id_course = null;
                this.id_instructor = null;
                this.schedule.capacity = 0;
                this.days={
                    monday:{selected:false,startTime:null,endTime:null},
                    tuesday:{selected:false,startTime:null,endTime:null},
                    wednesday:{selected:false,startTime:null,endTime:null},
                    thursday:{selected:false,startTime:null,endTime:null},
                    friday:{selected:false,startTime:null,endTime:null},
                    saturday:{selected:false,startTime:null,endTime:null}
                }
            },
            courseDetails(){
                if(this.schedule.id_course==null){
                    this.showErrorNotification('Error','El curso no ha sido asignado');
                }else{
                    window.location.href = '/admin/cursos/'+this.schedule.id_course;
                }
            },
            instructorDetails(){
                if(this.schedule.id_instructor==null){
                    this.showErrorNotification('Error','El instructor no ha sido asignado');
                }else{
                    window.location.href = '/admin/instructors/'+this.schedule.id_instructor;
                }
            },
            showList(){
                window.location.href="/admin/horarios/";
            },
            cancelUpdate(){
                window.history.go(-1);
            }
        }
        
    }
</script>