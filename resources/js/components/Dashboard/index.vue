<template>
  <div>
    <div class="d-sm-flex justify-content-between align-items-center mb-3">
      <h3 class="text-dark mb-0">Dashboard</h3>
      <a
        class="btn btn-primary btn-sm d-none d-sm-inline-block"
        role="button"
        href="#"
        ><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar
        reporte</a
      >
    </div>
    <div>
      <div class="row col-lg-12">
        <cardinfo-component
          v-for="(props, index) in content"
          v-bind:key="index"
          v-bind:id="index"
          v-bind:text="props.text"
          v-bind:url="props.url"
          v-bind:number="props.number"
          v-bind:bg="props.bg"
          v-bind:icon="props.icon"
        />
      </div>
      <div class="row col-lg-12">
        <div class="col-lg-4 mb-2">
          <div class="pl-3 pr-0 pb-0 pt-0 card">
            <div class="card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="myChart1"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-2">
          <div class="pl-2 pr-0 pb-0 pt-0 card text-left">
            <div class="card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-2">
          <div class="pl-2 pr-0 pb-0 pt-0 card text-left">
            <div class="card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="myChart2"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row col-lg-12 mt-3">
        <div class="col-lg-6 mb-2">
          <div class="pl-2 pr-0 pb-0 pt-0 text-left card h-100">
            <div class="d-inline card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="line"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-2">
          <div class="pl-2 pr-0 pb-0 pt-0 text-left card h-100">
            <div class="h-100 p-0 m-0">
              <div class="card-body pd-4 m-0">
                <div
                  class="col-lg-12 table-wrapper-scroll-y my-custom-scrollbar"
                >
                  <table class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre de usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr
                        v-for="(props, index) in users"
                        v-bind:key="props.id"
                        class="text-center w-20"
                      >
                        <td class="align-middle p">{{ index + 1 }}</td>
                        <td class="align-middle text-left p">
                          <img
                            v-if="props.users_cdu.pic == null"
                            class="img2"
                            src="../../../../storage/app/public/invalidPhoto.jpg"
                          />
                          <img
                            v-else
                            class="img2"
                            :src="'../../../../storage/' + props.users_cdu.pic"
                          />
                          {{ props.users_cdu.username }}
                        </td>
                        <td class="align-middle p">
                          {{ props.dateForHumans }}
                        </td>
                        <td>
                          <button
                            class="btn btn-info m-1 col-xl-8 col-lg-8 col-xs-12"
                            @click="onClickDetails(props.users_cdu.id)"
                          >
                            <i class="el-icon-view"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
var Chart = require("chart.js");
export default {
  props: ["route"],
  data() {
    return {
      backgroundColor: [],
      borderColor: [],
      course: null,
      users: null,
      content: null,
    };
  },
  mounted() {
    axios.get(this.route).then((response) => {
      this.course = response.data;
      // console.log(response.data);
      var x = this;
      var data = [];
      var labels = [];
      var dataD = [];
      var labelsD = [];
      this.users = this.course.users;
      this.content = [
        {
          text: "Usuarios",
          number: this.course.all.users_cdu,
          icon: "el-icon-user-solid",
          bg: "bg-secondary",
          url: "usuarioscdu",
        },
        {
          text: "Cursos",
          number: this.course.all.course,
          icon: "el-icon-menu",
          bg: "bg-success",
          url: "cursos",
        },
        {
          text: "Disciplinas",
          number: this.course.all.discipline,
          icon: "el-icon-basketball",
          bg: "bg-primary",
          url: "disciplinas",
        },
        {
          text: "Áreas",
          number: this.course.all.area,
          icon: "el-icon-office-building",
          bg: "bg-danger",
          url: "areas",
        },
        {
          text: "Niveles",
          number: this.course.all.level,
          icon: "el-icon-trophy",
          bg: "bg-info",
          url: "niveles",
        },
        {
          text: "Horarios",
          number: this.course.all.schedule,
          icon: "el-icon-date",
          bg: "bg-danger",
          url: "horarios",
        },
        {
          text: "Condonaciones",
          number: this.course.all.condonation,
          icon: "el-icon-tickets",
          bg: "bg-secondary",
          url: "condonaciones",
        },
        {
          text: "Instructores",
          number: this.course.all.instructor,
          icon: "el-icon-s-custom",
          bg: "bg-dark",
          url: "instructors",
        },
      ];
      this.course.course.forEach((value, index) => {
        if (value.cont > 0) {
          data.push(value.cont);
          labels.push(value.name);
        }
      });

      var dataI = [];
      var labelsI = [];
      this.course.course.forEach((value, index) => {
        if (value.instructors > 0) {
          dataI.push(value.instructors);
          labelsI.push(value.name);
        }
      });
      this.course.discipline.forEach((value, index) => {
        if (value.number > 0) {
          dataD.push(value.number);
          labelsD.push(value.name);
        }
      });
      this.pie(data, labels, "Cursos asignados", "myChart");
      this.pie(dataI, labelsI, "Cursos con instructores", "myChart1");
      this.pie(dataD, labelsD, "Disciplinas asignadas", "myChart2");
      var items = [];
      var xy = [];
      this.course.register.forEach((value, index) => {
        var dateObj = new Date(value.date);
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var newdate = day + "/" + month + "/" + year;
        items.push(newdate);
        xy.push({ x: index * 2, y: value.num });
      });
      var ctx2 = document.getElementById("line").getContext("2d");
      // console.log(xy);
      var stackedLine = new Chart(ctx2, {
        type: "line",
        data: {
          labels: items,
          datasets: [
            {
              label: "Asistencia de usuarios",
              backgroundColor: this.getRandomColor(),
              borderColor: this.getRandomColor(),
              data: xy,
              fill: false,
            },
          ],
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: "Registro de entrada",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          scales: {
            x: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Month",
              },
            },
            y: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Value",
              },
            },
          },
        },
      });
    });
  },
  methods: {
    getRandomColor() {
      var letters = "0123456789ABCDEF";
      var color = "#";
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    },

    pie($data, $label, $title, $id) {
      var backgroundColor1 = [];
      var borderColor1 = [];
      for (var i = 0; i < $data.length; i++) {
        backgroundColor1.push(this.getRandomColor());
        borderColor1.push(this.getRandomColor());
      }
      var ctx = document.getElementById($id).getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          datasets: [
            {
              data: $data,
              backgroundColor: backgroundColor1,
              borderColor: borderColor1,
              borderWidth: 1,
            },
          ],
          labels: $label,
        },
        options: {
          aspectRatio: 1.5,
          title: {
            display: true,
            text: $title,
          },
          responsive: true,
          legend: {
            display: true,
            position: "left",
          },
        },
      });
    },
    onClickDetails($idy) {
      const ediId = $idy;
      window.location.href = "/admin/usuarioscdu/" + ediId + "/";
      //this.$emit("details", ediId);
    },
  },
};
</script>
<style scoped>
.img2 {
  height: 30px;
  border-radius: 30%;
}
.my-custom-scrollbar {
  position: relative;
  max-height: 300px;
  overflow: auto;
}
.table-wrapper-scroll-y {
  display: block;
}
</style>
