<template>
  <div v-if="this.response!=null">
    <input
      id="buttoninfo"
      type="button"
      class="btn btn-success"
      @click="printDiv"
      value="Imprimir ticket"
    />
    <div id="print">
      <div class="border border-secondary border-5 rounded text-center m-1 mb-5 p-3">
        <div class="d-inline mb-3">
          <img height="150" src="../../../../storage/app/public/logo.png" />
        </div>
      </div>
      <div class="border border-secondary border-5 rounded text-center m-1 mb-5">
        <h2 class="m-3">
          <center>INFORMACIÓN GENERAL</center>
        </h2>
        <div class="container col-sm-12 row text-center m-2">
          <div class="d-inline border col-sm-2 rounded border-dark text-left m-1 mb-3">
            <label class="text">ID PAGO: {{this.course.pivot.id}}</label>
          </div>
          <div class="d-inline border col-sm-3 rounded border-dark text-left m-1 mb-3">
            <label class="text">REFERENCIA: {{this.course.course!=null?this.course.course.reference:"No asignada"}}</label>
          </div>
          <div class="d-inline border col-sm-3 rounded border-dark text-left m-1 mb-3">
            <label class="text">TOTAL A PAGAR: {{this.course.total_user}}</label>
          </div>
          <div class="d-inline border col-sm-3 rounded border-dark text-left m-1 mb-3">
            <label class="text">
              FECHA DE EMISIÓN:
              <br />
              {{this.now.toLocaleString() }}
            </label>
          </div>
        </div>
      </div>
      <div class="border border-secondary border-5 rounded text-center m-1 mb-5">
        <h2 class="m-3">
          <center>DATOS PERSONALES</center>
        </h2>
        <div class="container col-sm-12 row text-center m-2 mb-3">
          <div class="d-inline border col-sm-6 rounded border-dark text-left m-1">
            <label class="text">Nombre: {{this.response.user.username}}</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-left m-1">
            <label class="text">Código: {{this.response.user.code}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center m-2">
          <div class="d-inline border col-sm-6 rounded border-dark text-left m-1 mb-3">
            <label class="text">Teléfono: {{this.response.user.phone}}</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3">
            <label class="text">Correo electrónico: {{this.response.user.email}}</label>
          </div>
        </div>
      </div>
      <div class="border border-secondary border-5 rounded text-center m-1 mb-5">
        <h2 class="m-3">
          <center>DATOS DEL CURSO</center>
        </h2>
        <div class="container col-sm-12 row text-center m-2">
          <div class="d-inline border col-sm-6 rounded border-dark text-left m-1 mb-2">
            <label
              class="text"
            >Nombre del Curso: {{this.course.course!=null?this.course.course.name:"No asignado"}}</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-2">
            <label
              class="text"
            >Nombre del Instructor: {{this.course.instructor!=null?this.course.instructor.name:"No asignado"}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center m-2">
          <div class="d-inline border col-sm-6 rounded border-dark text-left m-1 mb-3">
            <label
              class="text"
            >Disciplina: {{this.course.course!=null?this.course.course.discipline.name:"No asignada"}}</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3">
            <label
              class="text"
            >Nivel: {{this.course.course!=null?this.course.course.level.name:"No asignado"}}</label>
          </div>
        </div>
      </div>
      <div class="float-right col-sm-8 border border-secondary border-5 rounded text-center m-1">
        <h2 class="m-3">
          <center>
            <label class="text">TOTAL A PAGAR</label>
          </center>
        </h2>
        <div class="container col-sm-12 row text-center">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">MESES A PAGAR</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{this.course.pivot.amount}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">BASE</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{(this.course.pivot.amount * (this.course.course.cost!=null?this.course.course.cost:0))}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">DESCUENTO</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{this.course.total_condonation}}%</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">SUBTOTAL</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{this.course.total}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-center">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">SALDO A FAVOR</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{this.course.all_pay}}</label>
          </div>
        </div>
        <div class="container col-sm-12 row text-left mb-4">
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">TOTAL A PAGAR</label>
          </div>
          <div class="d-inline border col-sm-5 rounded border-dark text-right m-1">
            <label class="text">{{this.course.total_user}}</label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
var foo = function () {
  var originalContents = document.body.innerHTML;
  var x = document.getElementsByClassName("text");
  Array.prototype.forEach.call(x, function (el) {
    el.style.fontSize = "20px";
  });
  var printContents = document.getElementById("print").innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
  document.getElementById("buttoninfo").onclick = foo;
};
export default {
  props: ["detailsid", "id_schedule"],
  data() {
    return {
      response: null,
      course: null,
      now: new Date(),
    };
  },
  mounted() {
    this.updateData();
  },
  methods: {
    updateData() {
      axios.get(`/usuarioscdu/${this.detailsid}`).then((response) => {
        this.response = response.data;
        var aux = this.response.user.assigned_schedules;
        var index = aux.findIndex((i) => i.pivot.id === this.id_schedule);
        this.course = aux[index];
        console.log(this.id_schedule);
        console.log(this.course);
      });
    },
    printDiv() {
      var originalContents = document.body.innerHTML;
      var x = document.getElementsByClassName("text");
      Array.prototype.forEach.call(x, function (el) {
        el.style.fontSize = "20px";
      });
      var printContents = document.getElementById("print").innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      document.getElementById("buttoninfo").onclick = foo;
    },
  },
};
</script>
