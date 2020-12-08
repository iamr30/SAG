<template>
  <div v-if="this.response != null">
    <div v-if="!this.adding">
      <div class="row col-12 m-0 p-0">
        <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
          <button
            type="button"
            class="btn btn-success col-12 m-0 pl-0 pr-0"
            @click="addCourse()"
          >
            <i class="el-icon-plus"></i>Añadir
          </button>
        </div>
        <div class="text-right col-sm-9 col-lg-10 col-xl-11 m-0 p-0">
          <input
            type="text"
            class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1"
            placeholder="Buscar"
            v-model="searchschedule"
            v-on:keyup="searchscheduleButton"
          />
        </div>
      </div>
      <div class="table-responsive table mt-2" role="grid">
        <table class="table my-0">
          <thead>
            <tr class="text-center">
              <th @click="sortC(1)" scope="col">Nombre del Curso</th>
              <th @click="sortC(2)" scope="col">Horario</th>
              <th @click="sortC(3)" scope="col">Nombre del instructor</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="propschedule in this.dataschedule"
              :key="propschedule.pivot.id"
            >
              <td>
                {{
                  propschedule.course != null ? propschedule.course.name : ""
                }}
              </td>
              <td class="w-50">
                <p v-if="propschedule.m != null">Lunes {{ propschedule.m }}</p>
                <p v-if="propschedule.t != null">Martes {{ propschedule.t }}</p>
                <p v-if="propschedule.w != null">
                  Miércoles {{ propschedule.w }}
                </p>
                <p v-if="propschedule.r != null">Jueves {{ propschedule.r }}</p>
                <p v-if="propschedule.f != null">
                  Viernes {{ propschedule.f }}
                </p>
                <p v-if="propschedule.s != null">Sábado {{ propschedule.s }}</p>
              </td>
              <td class="w-25">
                {{
                  propschedule.instructor != null
                    ? propschedule.instructor.name
                    : ""
                }}
              </td>
              <td >
                <div class="col-12 m-0">
                  <button
                    type="button"
                    class="btn btn-info m-1 col-xl-6 col-xs-12"
                    @click="onClickDetails(propschedule.id)"
                  >
                    <i class="el-icon-view"></i>
                  </button>

                  <button
                    type="button"
                    class="btn btn-danger m-1 col-xl-6  col-xs-12"
                    @click="onClickDelete(propschedule.id)"
                  >
                    <i class="el-icon-delete"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="this.dataschedule.length == 0" height="50">
              <td colspan="4">
                <h5 class="bg-red">NO SE ENCONTRARON REGISTROS!!!</h5>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr class="text-center">
              <th @click="sortC(1)" scope="col">Nombre del Curso</th>
              <th @click="sortC(2)" scope="col">Horario</th>
              <th @click="sortC(3)" scope="col">Nombre del instructor</th>
              <th scope="col">Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="pagination col-12 p-0">
        <div class="text-left col-8">
          <span class="text-black"
            >Mostrando {{ this.dataschedule.length }} de
            {{ this.contentschedule.length }}</span
          >
        </div>
        <div class="text-right col-4 p-0">
          <!-- <button class="btn btn-default p-0 mr-1" @click="Prev(-1)" :disabled="actual==0"><i class="el-icon-arrow-left"></i></button>
                            <span class="">{{actual+1}} de {{max}}</span>
                            <button class="btn btn-default p-0 ml-1" @click="Prev(1)" :disabled="actual+1==max"><i class="el-icon-arrow-right"></i></button> -->
          <nav
            class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers"
          >
            <ul class="pagination">
              <li class="page-item" v-if="actualschedule + 1 > 1">
                <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                  ><span aria-hidden="true">«</span></a
                >
              </li>
              <li class="page-item disabled" v-else>
                <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                  ><span aria-hidden="true">«</span></a
                >
              </li>
              <li
                class="page-item"
                v-if="actualschedule + 1 == maxschedule && actualschedule >= 2"
              >
                <a class="page-link" @click="Prev(-2)">{{
                  actualschedule - 1
                }}</a>
              </li>
              <li class="page-item" v-if="actualschedule + 1 > 1">
                <a class="page-link" @click="Prev(-1)">{{ actualschedule }}</a>
              </li>
              <li class="page-item active mousehover">
                <a class="page-link">{{ actualschedule + 1 }}</a>
              </li>
              <li class="page-item" v-if="maxschedule > actualschedule + 1">
                <a class="page-link" @click="Prev(1)">{{
                  actualschedule + 2
                }}</a>
              </li>
              <li
                class="page-item"
                v-if="actualschedule == 0 && maxschedule >= actualschedule + 3"
              >
                <a class="page-link" @click="Prev(2)">{{
                  actualschedule + 3
                }}</a>
              </li>
              <li class="page-item" v-if="actualschedule + 1 < maxschedule">
                <a class="page-link" @click="Prev(1)" aria-label="Next"
                  ><span aria-hidden="true">»</span></a
                >
              </li>
              <li class="page-item disabled" v-else>
                <a class="page-link" @click="Prev(1)" aria-label="Next"
                  ><span aria-hidden="true">»</span></a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="form-group row col-lg-12 col-md-10 col-sm-10"></div>
      <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
        <button
          class="btn btn-info form-button m-3"
          type="button"
          @click="addCourse()"
        >
          <i class="el-icon-s-fold"></i>
        </button>
        <br />
      </div>
      <div class="table-responsive">
        <table class="w-100">
          <tbody>
            <tr>
              <td>
                <div
                  class="row border border-secondary border-5 rounded m-1 mb-5 text-center pt-3"
                >
                  <label class="m-4 col-sm-4 col-lg-2 col-form-label"
                    >Seleccione un curso</label
                  >
                  <select
                    v-model="id_course"
                    name="id_course"
                    class="form-control m-4 col-lg-8 col-md-8 col-sm-8"
                    @change="courseF()"
                  >
                    <option
                      v-for="(d, index) in course"
                      :key="index"
                      v-bind:value="d"
                    >
                      {{ d.name }}
                    </option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div
                  v-if="this.schedules.length"
                  class="row border border-secondary border-5 rounded m-1 mb-5 text-center pt-3"
                >
                  <div
                    class="container col-sm-10 row border rounded border-dark text-center m-auto"
                  >
                    <div
                      class="d-inline col-sm-12 col-md-12 col-xl-5 text-centert m-1"
                    >
                      <button
                        type="button"
                        class="btn btn btn-link"
                        @click="Prev()"
                        :disabled="this.indexschedule <= 0"
                      >
                        Anterior
                      </button>
                      <span
                        >Horario
                        {{
                          this.schedules.length == 0
                            ? 0
                            : this.indexschedule + 1
                        }}
                        de {{ this.schedules.length }}</span
                      >
                      <button
                        type="button"
                        class="btn btn btn-link"
                        @click="Next()"
                        :disabled="
                          this.indexschedule + 1 >= this.schedules.length
                        "
                      >
                        Siguiente
                      </button>
                    </div>
                    <div
                      class="d-inline col-sm-10 col-lg-5 text-center m-auto p-2"
                    >
                      <input
                        v-if="this.schedules.length"
                        type="button"
                        class="btn btn-block btn-success"
                        value="Agregar horario"
                        :disabled="!this.save"
                        @click="saveSchedule()"
                      />
                    </div>
                  </div>
                  <div class="text-right col-lg-6 col-sm-6 m-2"></div>
                  <div
                    class="container col-sm-12 col-lg-12 row text-center m-2"
                  >
                    <div class="d-inline col-sm-8 col-lg-6 text-center m-auto">
                      <div class="d-inline col-sm-12 col-lg-12 text-left mb-3">
                        <h4 class="m-3">
                          <center>INFORMACIÓN DEL CURSO</center>
                        </h4>
                      </div>
                    </div>
                  </div>
                  <div class="container col-sm-12 row text-center m-2">
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text"
                        >Nombre del curso:{{
                          this.showschedule.course == null
                            ? "Sin nombre"
                            : this.showschedule.course.name
                        }}</label
                      >
                    </div>
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text"
                        >Costo:
                        {{
                          this.showschedule.course == null
                            ? 0
                            : this.showschedule.course.cost
                        }}</label
                      >
                    </div>
                  </div>
                  <div class="container col-sm-12 row text-center m-2 mb-3">
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text"
                        >Nombre del instructor:
                        {{
                          this.showschedule.instructor == null
                            ? "No hay instructor"
                            : this.showschedule.instructor.name
                        }}</label
                      >
                    </div>
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text">
                        Fecha de Inicio:
                        {{
                          this.showschedule.course == null
                            ? "No hay Fecha de inicio"
                            : this.showschedule.course.date_start.toLocaleString()
                        }}
                      </label>
                    </div>
                  </div>
                  <div class="container col-sm-12 row text-center m-2 mb-3">
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text"
                        >Cupo total:{{ this.showschedule.capacity }}</label
                      >
                    </div>
                    <div
                      class="d-inline border col-sm-5 rounded border-dark text-left m-1 mb-3"
                    >
                      <label class="text"
                        >Cupo disponible:
                        {{
                          this.showschedule.capacity -
                          this.showschedule.assigned_schedules.length
                        }}</label
                      >
                    </div>
                  </div>

                  <div class="text-center m-1">
                    <h4 class="m-3">
                      <center>HORARIO</center>
                    </h4>
                    <div class="container col-sm-10 row text-center m-auto">
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Lunes</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.m }}</label>
                        </div>
                      </div>
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Martes</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.t }}</label>
                        </div>
                      </div>
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Miércoles</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.w }}</label>
                        </div>
                      </div>
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Jueves</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.r }}</label>
                        </div>
                      </div>
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Viernes</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.f }}</label>
                        </div>
                      </div>
                      <div
                        class="container col-sm-10 row border rounded border-dark text-center m-1"
                      >
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">Sábado</label>
                        </div>
                        <div class="d-inline col-sm-5 text-left m-1">
                          <label class="text">{{ this.showschedule.s }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  v-if="this.schedules.length <= 0 && this.id_course != 0"
                  class="row border border-secondary border-5 rounded m-1 mb-5 text-center pt-3"
                >
                  <label class="text-center col-lg-12 col-sm-12"
                    >No hay horarios disponibles para el usuario</label
                  >
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["editid"],
  data() {
    return {
      data_account: [],
      course: [],
      id_course: 0,
      schedulecontent: [],
      schedules: [],
      response: null,
      indexschedule: 0,
      showschedule: [],
      dataschedule: [],
      contentschedule: [],
      searchschedule: "",
      ascschedule: true,
      minschedule: 0,
      actualschedule: 0,
      maxschedule: 0,
      data_account: [],
      pagesizedschedule: 5,
      auxschedule: [],
      add: false,
      adding: false,
      save: true,
    };
  },
  mounted() {
    if (this.response != null) this.updateData();
  },
  methods: {
    sum_data() {
      var sum = 0;
      if (this.data_account.assigned_schedules != null) {
        this.data_account.assigned_schedules.forEach((value, index) => {
          sum = value.pivot != null ? value.pivot.amount + sum : sum;
        });
      }
      return sum;
    },
    updateDataAccount() {
      this.updateData();
    },
    updateData() {
      axios.get("/admin/cursos").then((response) => {
        this.course = response.data.courses;
      });
      axios.get("/admin/horarios").then((response) => {
        this.schedulecontent = response.data.schedules;
      });

      this.data_account = this.response.user;
      this.dataschedule = this.data_account.assigned_schedules;
      this.contentschedule = this.data_account.assigned_schedules;
      this.auxschedule = this.contentschedule;
      this.maxschedule = Math.ceil(
        this.dataschedule.length / this.pagesizedschedule
      );
      this.actualschedule = 0;
      this.updateC();
      this.courseF();
      this.add = false;
    },
    courseF() {
      this.schedules = [];
      this.indexschedule = 0;
      if (this.id_course.id == null) {
        return;
      }
      this.schedulecontent.forEach((value, index) => {
        var asign = true;
        if (value.capacity - value.assigned_schedules.length <= 0) {
          return;
        }
        if (value.id_course != this.id_course.id) {
          asign = false;
        }
        var str = value.m;
        var datm = str === null ? [] : str.split("-");
        str = value.t;
        var datt = str === null ? [] : str.split("-");
        str = value.w;
        var datw = str === null ? [] : str.split("-");
        str = value.r;
        var datr = str === null ? [] : str.split("-");
        str = value.f;
        var datf = str === null ? [] : str.split("-");
        str = value.s;
        var dats = str === null ? [] : str.split("-");
        this.contentschedule.forEach((value2, index2) => {
          str = value2.m;
          var datm2 = str === null ? [] : str.split("-");
          str = value2.t;
          var datt2 = str === null ? [] : str.split("-");
          str = value2.w;
          var datw2 = str === null ? [] : str.split("-");
          str = value2.r;
          var datr2 = str === null ? [] : str.split("-");
          str = value2.f;
          var datf2 = str === null ? [] : str.split("-");
          str = value2.s;
          var dats2 = str === null ? [] : str.split("-");
          if (
            datm2.length >= 2 &&
            datm.length >= 2 &&
            !(
              (datm[0] < datm2[0] && datm[1] <= datm2[0]) ||
              (datm[0] > datm2[0] && datm2[1] <= datm[0])
            )
          ) {
            asign = false;
          } else if (
            datt2.length >= 2 &&
            datt.length >= 2 &&
            !(
              (datt[0] < datt2[0] && datt[1] <= datt2[0]) ||
              (datt[0] > datt2[0] && datt2[1] <= datt[0])
            )
          ) {
            asign = false;
          } else if (
            datw2.length >= 2 &&
            datw.length >= 2 &&
            !(
              (datw[0] < datw2[0] && datw[1] <= datw2[0]) ||
              (datw[0] > datw2[0] && datw2[1] <= datw[0])
            )
          ) {
            asign = false;
          }
          if (
            datr2.length >= 2 &&
            datr.length >= 2 &&
            !(
              (datr[0] < datr2[0] && datr[1] <= datr2[0]) ||
              (datr[0] > datr2[0] && datr2[1] <= datr[0])
            )
          ) {
            asign = false;
          }
          if (
            dats2.length >= 2 &&
            dats.length >= 2 &&
            !(
              (dats[0] < dats2[0] && datw[1] <= dats2[0]) ||
              (dats[0] > dats2[0] && dats2[1] <= dats[0])
            )
          ) {
            asign = false;
          }
          if (
            datf2.length >= 2 &&
            datf.length >= 2 &&
            !(
              (datf[0] < datf2[0] && datf[1] <= datf2[0]) ||
              (datf[0] > datf2[0] && datf2[1] <= datf[0])
            )
          ) {
            asign = false;
          }
        });
        if (asign === true) {
          this.schedules.push(value);
        }
      });
      if (this.schedules.length > 0) {
        this.showschedule = this.schedules[0];
      }
      this.save = true;
    },
    Prev($k) {
      if (
        this.actualschedule + $k < 0 ||
        this.actualschedule + $k > this.maxschedule
      )
        return 0;
      this.actualschedule = this.actualschedule + $k;
      this.updateC();
    },
    Next() {
      this.showschedule = this.schedules[++this.indexschedule];
    },
    saveSchedule() {
      if (!this.save) {
        return;
      }
      this.save = false;
      if (this.schedules.length <= 0) {
        this.showErrorNotification(
          "Agregar curso",
          "No hay horarios disponibles"
        );
        this.save = true;
        return;
      }
      this.add = true;
      const params = {
        id_userCDU: this.data_account.id,
        id_schedules: this.showschedule.id,
      };
      axios.post("/admin/asignar/0", params).then((response) => {
        if (response.data == 1) {
          this.showSuccessNotification(
            "Agregar Horarios",
            "El horario ha sido agregado"
          );
          this.$emit("updateAll");
        } else {
          this.showErrorNotification(
            "Agregar Horario",
            "Hubo errores al agregar el horario"
          );
          this.save = true;
          this.add = false;
          console.log(response);
        }
      });
    },
    searchscheduleButton() {
      if (this.searchschedule == "") {
        this.auxschedule = this.contentschedule;
        this.maxschedule = Math.ceil(
          this.auxschedule.length / this.pagesizedschedule
        );
        this.actualschedule = 0;
        this.PrevC();
      } else {
        this.auxschedule = [];
        this.contentschedule.forEach((value, index) => {
          if (
            this.foundIt(
              value.course != null && value.course.name,
              this.searchschedule
            )
          ) {
            this.auxschedule.push(value);
          } else if (
            value.instructor != null &&
            this.foundIt(value.instructor.name, this.searchschedule)
          ) {
            this.auxschedule.push(value);
          }
        });
        this.maxschedule = Math.ceil(
          this.auxschedule.length / this.pagesizedschedule
        );
        this.actualschedule = 0;
        this.PrevC();
      }
    },
    sortC($op) {
      if ($op == 1) {
        if (this.ascschedule) {
          this.auxschedule.sort((a, b) =>
            a.course == null
              ? b.course == null
                ? -1
                : -1
              : b.course == null
              ? a.course == null
                ? -1
                : 1
              : a.course.name < b.course.name
              ? -1
              : Number(a.course.name > b.course.name)
          );
          this.ascschedule = false;
        } else {
          this.auxschedule.sort((b, a) =>
            a.course == null
              ? b.course == null
                ? -1
                : -1
              : b.course == null
              ? a.course == null
                ? -1
                : 1
              : a.course.name < b.course.name
              ? -1
              : Number(a.course.name > b.course.name)
          );
          this.ascschedule = true;
        }
      } else if ($op == 3) {
        if (this.ascschedule) {
          this.auxschedule.sort((a, b) =>
            a.instructor == null
              ? b.instructor == null
                ? -1
                : -1
              : b.instructor == null
              ? a.instructor == null
                ? -1
                : 1
              : a.instructor.name < b.instructor.name
              ? -1
              : Number(a.instructor.name > b.instructor.name)
          );
          this.ascschedule = false;
        } else {
          this.auxschedule.sort((b, a) =>
            a.instructor == null
              ? b.instructor == null
                ? -1
                : -1
              : b.instructor == null
              ? a.instructor == null
                ? -1
                : 1
              : a.instructor.name < b.instructor.name
              ? -1
              : Number(a.instructor.name > b.instructor.name)
          );
          this.ascschedule = true;
        }
      }
      this.actualschedule = 0;
      this.PrevC();
    },
    PrevC() {
      if (this.actualschedule > 0) this.actualschedule--;
      this.updateC();
    },
    NextC() {
      if (
        this.auxschedule.length >
        this.actualschedule * this.pagesizedschedule + this.pagesizedschedule
      )
        this.actualschedule++;
      this.updateC();
    },
    updateC() {
      if (this.actualschedule >= this.maxschedule) this.actualschedule--;
      this.dataschedule = this.auxschedule.slice(
        this.actualschedule * this.pagesizedschedule,
        this.actualschedule * this.pagesizedschedule + this.pagesizedschedule
      );
    },
    foundIt(strword2, word2) {
      var strword = strword2 === null ? "" : strword2.toString();
      var word = word2 === null ? "" : word2.toString();
      var j = 0;
      var i;
      for (i = 0; i < strword.length; i++) {
        if (j >= word.length) {
          return true;
        }
        if (strword[i].toLowerCase() == word[j].toLowerCase()) {
          j++;
        } else {
          j = 0;
        }
      }
      if (j >= word.length) {
        return true;
      }
      return false;
    },
    onClickDelete($idc) {
      this.add = true;
      this.$confirm(
        "Realmente desea salir del curso, se eliminarán los pagos y condonaciones ligados al curso",
        "Alerta",
        {
          confirmButtonText: "Continuar",
          cancelButtonText: "Cancelar",
          type: "warning",
        }
      )
        .then(() => {
          axios
            .delete(`/admin/asignar/${$idc}`, {
              params: { id: this.editid, id_schedule: $idc },
            })
            .then((response) => {
              if (response.data == 1) {
                this.showSuccessNotification(
                  "Eliminando",
                  "Eliminación correcta"
                );
                var index = this.schedulecontent.findIndex(
                  (i) => i.id === $idc
                );
                if (index != -1)
                  this.schedulecontent[index].assigned_schedules.splice(0, 1);
                var index2 = this.contentschedule.findIndex(
                  (i) => i.id === $idc
                );
                if (index2 != -1) this.contentschedule.splice(index2, 1);
                this.auxschedule = this.contentschedule;
                this.maxschedule = Math.ceil(
                  this.auxschedule.length / this.pagesizedschedule
                );
                this.courseF();
                this.updateC();
              } else {
                this.showErrorNotification("Error", "Error al salir del curso");
                console.log(response);
              }
            });
        })
        .catch(() => {
          this.$notify({
            type: "info",
            title: "Eliminación cancelada",
            message: "La eliminación ha sido cancelada",
          });
        });
      this.add = false;
    },
    showSuccessNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "success",
      });
    },
    showErrorNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "error",
      });
    },
    addCourse() {
      this.adding == false ? (this.adding = true) : (this.adding = false);
      this.id_course = 0;
      this.courseF();
    },
    onClickDetails($idc) {
      window.location = "/admin/horarios/" + $idc;
    },
  },
};
</script>