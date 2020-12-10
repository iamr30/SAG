<template>
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <div class="navbar-brand bg-red d-flex justify-content-center align-items-center sidebar-brand m-0">
                <el-image fit="scale-down" :src="url" onclick="window.location.href='/admin/dashboard/'"></el-image>

            </div>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/dashboard"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/usuarioscdu"><i class="fas fa-address-card"></i><span>Usuarios</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/condonaciones"><i class="fas fa-file-alt"></i><span>Condonaciones</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/attendancesrecord"><i class="fas fa-clipboard-list"></i><span>Entradas</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/horarios"><i class="fas fa-calendar-alt"></i><span>Horarios</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/disciplinas"><i class="fas fa-swimmer"></i><span>Disciplinas</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/cursos"><i class="fas fa-th-large"></i><span>Cursos</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/niveles"><i class="fas fa-level-up-alt"></i><span>Niveles</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/instructors"><i class="fas fa-user-ninja"></i><span>Instructores</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/areas"><i class="fas fa-building"></i><span>Areas</span></a></li>
                <li v-if="user.role_id !== 3" class="nav-item"><a class="nav-link" href="/admin/payments"><i class="fas fa-money-bill-wave"></i><span>Pagos</span></a></li>
                <li v-else class="nav-item"><a class="nav-link" :href="'/user/usuarioscdu/' + this.usercdu.id"><i class="fas fa-chart-line"></i><span>Mi cuenta</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>

</template>

<script>
    export default {
        name: "SideBarMenu",
        created() {
            let userscdu;
            axios.get('/authuser').then((response) =>{
                this.user = response.data;
                if (this.user.role_id === 3){
                    axios.get('/user/usuarioscdu/').then((res) =>{
                        for (let userCDU in res.data){
                            if(res.data[userCDU].user_id === this.user.id){
                                this.usercdu = res.data[userCDU];
                            }
                        }
                    });
                }
            });
        },
        data() {
            return {
                url: '/images/logos/logo_blanco.png',
                user: [],
                usercdu: [],
            }
        },
        methods: {
            goto(route) {
                window.location.href = route;
            }
        }
    }
</script>

<style>
</style>
