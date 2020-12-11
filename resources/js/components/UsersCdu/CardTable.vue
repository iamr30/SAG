<template>
  <div v-if="this.response != null">
    <div class="row col-12">
      <div class="row col-12 m-0 p-0">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-6">
          <input
            type="text"
            name="id"
            v-model="id"
            @change="newBlog()"
            class="form-control"
            placeholder="Ingrese el número de la Tarjeta"
          />
        </div>
        <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
          <button
            class="btn btn-success col-12 m-0 pl-0 pr-0"
            type="button"
            @click="clean()"
          >
            <i class="el-icon-plus"></i>Añadir
          </button>
        </div>

        <div class="text-right col-sm-12 col-lg-12 col-xl-12 m-0 p-0">
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
              <th @click="sort(1)">Número de Tarjeta</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="props in this.data" v-bind:key="props.id">
              <td class="w-75">{{ props.id_card }}</td>

              <td class=" m-0 p-0">
                <div class="col-lg-12 m-0">
                  <button
                    type="button"
                    class="btn btn-danger m-1 col-xl-3 col-xs-12"
                    @click="onClickDelete(props.id)"
                  >
                    <i class="el-icon-delete"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="this.data.length <= 0" height="50">
              <td colspan="2">
                <h5 class="bg-red">NO SE ENCONTRARON REGISTROS!!!</h5>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr class="text-center">
              <th @click="sort(1)">Número de Tarjeta</th>
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
                  <li class="page-item active mousehover">
                    <a class="page-link " >{{ actual + 1 }}</a>
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
</template>

<script>
export default {
  data() {
    return {
      response: null,
      id: "",
      id_userCDU: null,
      data: [],
      content: [],
      search: "",
      asc: true,
      min: 0,
      actual: 0,
      max: 0,
      pagesize: 10,
      aux: [],
      cards: [],
    };
  },
  mounted() {},
  methods: {
    updateData() {
      axios.get("/admin/tarjetas").then((response) => {
        this.cards = response.data;
      });
      this.id_userCDU = this.response.user.id;
      this.data = this.response.user.cards;
      this.content = this.response.user;
      this.aux = this.data;
      this.max = Math.ceil(this.data.length / this.pagesize);
      this.actual = 0;
      this.update();
    },
    newBlog() {
      if (this.id == "-1") return;
      var error = false;
      this.cards.forEach((element) => {
        if (element.id_card.toString() === this.id) {
          error = true;
          return;
        }
      });
      if (this.id.length <= 0) {
        this.showErrorNotification(
          "Agregar Tarjeta",
          "La tarjeta debe tener mínimo un dígito"
        );
        this.id = "";
        return;
      }
      if (error) {
        this.showErrorNotification(
          "Agregar Tarjeta",
          "La tarjeta ya esta siendo usada por un usuario"
        );
        this.id = "";
        return;
      }
      const params = {
        id_userCDU: this.id_userCDU,
        id_card: this.id,
      };
      axios.post("/admin/tarjetas", params).then((response) => {
        if (response.data.value == 1) {
          this.showSuccessNotification(
            "Agregar Tarjeta",
            "La tarjeta ha sido agregada"
          );
          this.cards.push(response.data.card);
          this.content.cards.push(response.data.card);
          this.aux = this.content.cards;
          this.max = Math.ceil(this.aux.length / this.pagesize);
          this.actual = 0;
          this.update();
          this.id = "";
        } else if (response.data.value == 0) {
          this.showErrorNotification(
            "Agregar Tarjeta",
            "La tarjeta ya esta siendo usada por un usuario"
          );
        } else {
          this.showErrorNotification(
            "Agregar Tarjeta",
            "Hubo errores al agregar la tarjeta"
          );
          console.log(response.data.error);
        }
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
    onClickDelete($idc) {
      this.$confirm("Realmente desea eliminar la tarjeta", "Alerta", {
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar",
        type: "warning",
      })
        .then(() => {
          axios
            .delete(`/admin/tarjetas/${$idc}`)
            .then((response) => {
              if (response.data == 1) {
                this.showSuccessNotification(
                  "Eliminando",
                  "Eliminación correcta"
                );
                let index = this.content.cards.findIndex((i) => i.id === $idc);
                if (index != -1) this.content.cards.splice(index, 1);
                let index2 = this.cards.findIndex((i) => i.id === $idc);
                if (index2 != -1) this.cards.splice(index2, 1);
                let index3 = this.aux.findIndex((i) => i.id === $idc);
                if (index3 != -1) this.aux.splice(index3, 1);
                this.max = Math.ceil(this.aux.length / this.pagesize);
                this.update();
              } else {
                this.showErrorNotification(
                  "Error",
                  "Error al eliminar la tarjeta"
                );
                console.log(response);
              }
            })
            .catch((error) => {
              this.showErrorNotification(
                "Eliminando tarjeta",
                "Hubo errores al eliminar"
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
      this.add = false;
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
      if (this.search == "") {
        this.aux = this.content.cards;
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      } else {
        this.aux = [];
        this.content.cards.forEach((value, index) => {
          if (this.foundIt(value.id_card, this.search)) {
            this.aux.push(value);
          }
        });
        this.max = Math.ceil(this.aux.length / 5.0);
        this.actual = 0;
        this.update();
      }
      this.update();
    },
    sort($op) {
      if ($op == 1) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.id_card == null ? "" : a.id_card.toString()) <
            (b.id_card == null ? "" : b.id_card.toString())
              ? -1
              : Number(
                  (a.id_card == null ? "" : a.id_card.toString()) >
                    (b.id_card == null ? "" : b.id_card.toString())
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.id_card == null ? "" : a.id_card.toString()) <
            (b.id_card == null ? "" : b.id_card.toString())
              ? -1
              : Number(
                  (a.id_card == null ? "" : a.id_card.toString()) >
                    (b.id_card == null ? "" : b.id_card.toString())
                )
          );
          this.asc = true;
        }
      }
      this.actual = 0;
      this.update();
    },
    Prev($k) {
      if(this.actual+$k<0||this.actual+$k>this.max)return 0;
      this.actual = this.actual+$k;
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
    clean() {
      if (this.id == "") {
        this.showErrorNotification(
          "Agregar Tarjeta",
          "La tarjeta debe tener mínimo un dígito"
        );
      }
      var aux = this.id;
      this.id = "-1";
      this.id = aux;
    },
  },
};
</script>