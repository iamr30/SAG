<!--<template>-->
<!--        <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse"-->
<!--                  background-color="#1b1e21"-->
<!--                  text-color="#fff"-->
<!--                  active-text-color="#ffd04b"-->
<!--                 max-height="100%"-->

<!--        >-->
<!--            <div style="background: #e10127; width: 200px; height: 70px">-->
<!--                <el-image-->
<!--                    onclick="window.location.href='/admin/dashboard/'"-->
<!--                    style="width: 200px; height: 70px"-->
<!--                    :src="url"-->
<!--                    fit="scale-down"></el-image>-->
<!--            </div>-->
<!--            <div class="el-hr"></div>-->
<!--            <el-menu-item v-on:click="goto('/admin/usuarioscdu')" index="1">-->
<!--                <i class="el-icon-user"></i>-->
<!--                <span slot="title">-->
<!--                    Usuarios-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/attendancesrecord')" index="2">-->
<!--                <i class="el-icon-s-order"></i>-->
<!--                <span slot="title">-->
<!--                    Entradas-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/niveles')" index="3">-->
<!--                <i class="el-icon-trophy"></i>-->
<!--                <span slot="title">-->
<!--                    Niveles-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/disciplinas')" index="4">-->
<!--                <i class="el-icon-basketball"></i>-->
<!--                <span slot="title">-->
<!--                    Disciplinas-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/cursos')"index="5">-->
<!--                <i class="el-icon-menu"></i>-->
<!--                <span slot="title">-->
<!--                    Cursos-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/horarios')" index="6">-->
<!--                <i class="el-icon-date"></i>-->
<!--                <span slot="title">-->
<!--                    Horarios-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/instructors')" index="7">-->
<!--                <i class="el-icon-user-solid"></i>-->
<!--                <span slot="title">-->
<!--                    Instructores-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <el-menu-item v-on:click="goto('/admin/areas')" index="8">-->
<!--                <i class="el-icon-office-building"></i>-->
<!--                <span slot="title">-->
<!--                    Areas-->
<!--                </span>-->
<!--            </el-menu-item>-->
<!--            <div>-->
<!--                <button v-if="isCollapse" v-on:click="change()" class="btn btn-dark btn-lg btn-block"><i class="el-icon-d-arrow-right"></i></button>-->
<!--                <button v-if="!isCollapse" v-on:click="change()" class="btn btn-dark btn-lg btn-block"><i class="el-icon-d-arrow-left"></i></button>-->
<!--            </div>-->
<!--        </el-menu>-->

<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: "SideBarMenu",-->
<!--    data() {-->
<!--        return {-->
<!--            url: '/images/logos/logo_blanco.png',-->
<!--            isCollapse: false,-->
<!--        }-->
<!--    },-->
<!--    methods:{-->
<!--        goto(route){-->
<!--            window.location.href=route;-->
<!--        },-->
<!--        handleOpen(key, keyPath) {-->
<!--            console.log(key, keyPath);-->
<!--        },-->
<!--        handleClose(key, keyPath) {-->
<!--            console.log(key, keyPath);-->
<!--        },-->
<!--        change(){-->
<!--            this.isCollapse = !this.isCollapse;-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style>-->
<!--.el-menu-vertical-demo:not(.el-menu&#45;&#45;collapse) {-->
<!--    width: 200px;-->
<!--    min-height: 100vh;-->
<!--}-->
<!--</style>-->
<template>
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <div class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0">
                <el-image fit="scale-down" :src="url" onclick="window.location.href='/admin/dashboard/'"></el-image>

            </div>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link active" href="/admin/login"><i class="fas fa-address-card"></i><span>Iniciar Sesión</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>

</template>

<script>
export default {
    data() {
        return {
            url: '/images/logos/logo_blanco.png',
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
