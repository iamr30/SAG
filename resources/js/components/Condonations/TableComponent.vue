<template>
  <div class="container-fluid">
    <h2 class="text-dark mb-4">Condonaciones</h2>
    <div id="" class="card shadow">
      <div class="m-19">
        <div class="card-header py-3">
          <h5 class="text-primary font-weight-bold">Listado</h5>
        </div>
        <div class="card-body">
          <div class="row col-12 m-0 p-0">
            <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
              <button
                class="btn btn-success col-12 m-0 pl-0 pr-0"
                @click="addcondonation()"
              >
                <i class="el-icon-plus"></i>Añadir
              </button>
            </div>
            <div class="text-right col-sm-9 col-lg-10 col-xl-11 m-0 p-0">
              <input
                type="text"
                class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1"
                placeholder="Buscar"
                v-model="search"
                v-on:keyup="searchButton"
              />
            </div>
          </div>
          <div class="table-responsive table mt-2" role="grid">
            <table class="table my-0">
              <thead>
                <tr class="text-center">
                  <th @click="sort(0)">Nombre del usuario</th>
                  <th @click="sort(1)">Nombre del curso</th>
                  <th @click="sort(2)">Porcentaje</th>
                  <th @click="sort(3)">Tipo de beca</th>
                  <th @click="sort(4)">Vigencia</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(props, index) in data"
                  v-bind:key="props.id"
                  class="text-center"
                >
                  <td>
                    {{ props.users_cdu.username }}
                  </td>
                  <td>
                    {{ props.course != null ? props.course.name : "" }}
                  </td>
                  <td>
                    {{ props.data.percentage }}
                  </td>
                  <td width="10%">
                    {{ props.data.scholarship_type }}
                  </td>
                  <td>
                    {{ props.data.expiration_date }}
                  </td>
                  <td class="m-0 p-0 w-10">
                    <div class="col-12 m-0">
                      <button
                        class="btn btn-info m-1 col-xl-3 col-xs-12"
                        @click="onClickDetails(props.data.id)"
                      >
                        <i class="el-icon-view"></i>
                      </button>

                      <button
                        class="btn btn-secondary m-1 col-xl-3 col-xs-12 border-dark"
                        @click="onClickEdit(props.data.id)"
                      >
                        <i class="el-icon-edit"></i>
                      </button>

                      <button
                        class="btn btn-danger m-1 col-xl-3 col-xs-12"
                        @click="onClickDelete(props.data.id, index)"
                      >
                        <i class="el-icon-delete"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="data.length == 0">
                  <td colspan="6">
                    <h3 class="bg-red" v-if="data.length == 0">
                      NO SE ENCONTRARON REGISTROS!!!
                    </h3>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="text-center">
                  <th @click="sort(0)">Nombre del usuario</th>
                  <th @click="sort(1)">Nombre del curso</th>
                  <th @click="sort(2)">Porcentaje</th>
                  <th @click="sort(3)">Tipo de beca</th>
                  <th @click="sort(4)">Vigencia</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="pagination col-12 p-0">
            <div class="text-left col-8">
              <span class="text-black"
                >Mostrando {{ data.length }} de {{ this.aux.length }}</span
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
                  <li class="page-item" v-if="actual + 1 > 1">
                    <a
                      class="page-link"
                      @click="Prev(-1)"
                      aria-label="Previous"
                      ><span aria-hidden="true">«</span></a
                    >
                  </li>
                  <li class="page-item disabled" v-else>
                    <a
                      class="page-link"
                      @click="Prev(-1)"
                      aria-label="Previous"
                      ><span aria-hidden="true">«</span></a
                    >
                  </li>
                  <li
                    class="page-item"
                    v-if="actual + 1 == max && actual >= 2"
                  >
                    <a class="page-link" @click="Prev(-2)">{{
                      actual - 1
                    }}</a>
                  </li>
                  <li class="page-item" v-if="actual + 1 > 1">
                    <a class="page-link" @click="Prev(-1)">{{
                      actual
                    }}</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">{{ actual + 1 }}</a>
                  </li>
                  <li class="page-item" v-if="max > actual + 1">
                    <a class="page-link" @click="Prev(1)">{{
                      actual + 2
                    }}</a>
                  </li>
                  <li
                    class="page-item"
                    v-if="actual == 0 && max >= actual + 3"
                  >
                    <a class="page-link" @click="Prev(2)">{{
                      actual + 3
                    }}</a>
                  </li>
                  <li class="page-item" v-if="actual + 1 < max">
                    <a
                      class="page-link"
                      @click="Prev(1)"
                      aria-label="Next"
                      ><span aria-hidden="true">»</span></a
                    >
                  </li>
                  <li class="page-item disabled" v-else>
                    <a
                      class="page-link"
                      @click="Prev(1)"
                      aria-label="Next"
                      ><span aria-hidden="true">»</span></a
                    >
                  </li>
                </ul>
              </nav>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: [],
      search: "",
      asc: true,
      content: [],
      min: 0,
      actual: 0,
      max: 0,
      pagesize: 10,
      aux: [],
    };
  },
  mounted() {
    axios
      .get("/admin/condonaciones")
      .then((res) => {
        this.content = res.data;
        this.aux = this.content;
        this.max = Math.ceil(this.content.length / this.pagesize);
        this.actual = 0;
        this.update();
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
  },
  methods: {
    onClickEdit($idy) {
      const ediId = $idy;
      window.location.href = "/admin/condonaciones/editar/" + ediId + "/";
      //this.$emit("edit", ediId);
    },
    onClickDetails($idy) {
      const ediId = $idy;
      window.location.href = "/admin/condonaciones/" + ediId + "/";
      //this.$emit("details", ediId);
    },
    Prev($k) {
      if(this.actual+$k<0||this.actual+$k>this.max)return 0;
      this.actual = this.actual+$k;
       this.update();
    },
    foundIt(strword2, word2) {
      var strword = strword2 == null ? "" : strword2.toString();
      var word = word2 == null ? "" : word2.toString();
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
    searchButton() {
      const params = {
        search: this.search,
      };
      if (this.search == "") {
        this.aux = this.content;
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      } else {
        this.aux = [];
        this.content.forEach((value, index) => {
          if (
            this.foundIt(
              value.users_cdu == null ? "" : value.users_cdu.username,
              this.search
            )
          ) {
            this.aux.push(value);
          } else if (
            this.foundIt(
              value.course != null ? value.course.name : "",
              this.search
            )
          ) {
            this.aux.push(value);
          } else if (this.foundIt(value.data.percentage, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.data.scholarship_type, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.data.expiration_date, this.search)) {
            this.aux.push(value);
          }
        });
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      }
    },
    sort($op) {
      if ($op == 0) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            a.users_cdu.username < b.users_cdu.username
              ? -1
              : Number(a.users_cdu.username > b.users_cdu.username)
          );
          this.asc = false;
        } else {
          this.aux.sort((a, b) =>
            a.users_cdu.username > b.users_cdu.username
              ? -1
              : Number(a.users_cdu.username < b.users_cdu.username)
          );
          this.asc = true;
        }
      } else if ($op == 1) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.course != null ? a.course.name : "") <
            (b.course != null ? b.course.name : "")
              ? -1
              : Number(
                  (a.course != null ? a.course.name : "") >
                    (b.course != null ? b.course.name : "")
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.course != null ? a.course.name : "") <
            (b.course != null ? b.course.name : "")
              ? -1
              : Number(
                  (a.course != null ? a.course.name : "") >
                    (b.course != null ? b.course.name : "")
                )
          );
          this.asc = true;
        }
      } else if ($op == 2) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            a.data.percentage < b.data.percentage
              ? -1
              : Number(a.data.percentage > b.data.percentage)
          );
          this.asc = false;
        } else {
          this.aux.sort((a, b) =>
            a.data.percentage > b.data.percentage
              ? -1
              : Number(a.data.percentage < b.data.percentage)
          );
          this.asc = true;
        }
      } else if ($op == 3) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.data.scholarship_type != null ? a.data.scholarship_type : "") <
            (b.data.scholarship_type != null ? b.data.scholarship_type : "")
              ? -1
              : Number(
                  (a.data.scholarship_type != null
                    ? a.data.scholarship_type
                    : "") >
                    (b.data.scholarship_type != null
                      ? b.data.scholarship_type
                      : "")
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.data.scholarship_type != null ? a.data.scholarship_type : "") <
            (b.data.scholarship_type != null ? b.data.scholarship_type : "")
              ? -1
              : Number(
                  (a.data.scholarship_type != null
                    ? a.data.scholarship_type
                    : "") >
                    (b.data.scholarship_type != null
                      ? b.data.scholarship_type
                      : "")
                )
          );
          this.asc = true;
        }
      } else if ($op == 4) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            a.data.expiration_date < b.data.expiration_date
              ? -1
              : Number(a.data.expiration_date > b.data.expiration_date)
          );
          this.asc = false;
        } else {
          this.aux.sort((a, b) =>
            a.data.expiration_date > b.data.expiration_date
              ? -1
              : Number(a.data.expiration_date < b.data.expiration_date)
          );
          this.asc = true;
        }
      }
      this.actual = 0;
      this.update();
    },
    Next() {
      if (this.aux.length > this.actual * this.pagesize + this.pagesize)
        this.actual++;
      this.update();
    },
    update() {
      if (this.actual >= this.max) this.actual--;
      this.data = this.aux.slice(
        this.actual * this.pagesize,
        this.actual * this.pagesize + this.pagesize
      );
    },
    onClickDelete($idc, $iddel) {
      this.$confirm("Realmente desea eliminar la condonación", "Alerta", {
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar",
        type: "warning",
      })
        .then(() => {
          axios
            .delete(`/admin/condonaciones/${$idc}`)
            .then((response) => {
              if (response.data == 0) {
                this.showErrorNotification(
                  "Error al eliminar",
                  "Error al eliminar la condonación"
                );
                console.log(response.data);
              } else {
                this.showSuccessNotification(
                  "Eliminar",
                  "Condonación eliminada"
                );
                //console.log($idc);
                var index = this.aux.findIndex((i) => i.data.id === $idc);
                if (index != -1) this.aux.splice(index, 1);
                axios.get("/admin/condonaciones").then((res) => {
                  this.content = res.data;
                });
                //console.log(this.aux);
                this.max = Math.ceil(this.aux.length / this.pagesize);
                this.Prev(-1);
                this.update();
              }
            })
            .catch((error) => {
              this.showErrorNotification(
                "Error eliminando",
                "Conexión inválida"
              );
              console.log(error);
            });
        })
        .catch(() => {
          this.$notify({
            type: "info",
            title: "Eliminación cancelada",
            message: "La eliminación ha sido cancelada",
          });
        });
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
    addcondonation() {
      window.location.href = "/admin/condonaciones/agregar/";
    },
  },
};
</script>