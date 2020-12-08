<template>
  <div v-if="this.response != null" class="row col-12">
    <div class="text-right col-sm-12 col-lg-12 col-xl-12 m-0 p-0">
      <input
        type="text"
        class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1"
        placeholder="Buscar"
        v-model="search"
        v-on:keyup="searchButton"
      />
      <button
        type="button"
        class="btn btn-primary col-sm-2 col-lg-1 m-0 mb-1"
        @click="searchButton"
      >
        <i class="el-icon-search"></i>
      </button>
    </div>

    <div class="table-responsive table mt-2" role="grid">
      <table class="table my-0">
        <thead>
          <tr class="text-center">
            <th @click="sort(0)">Id Pago</th>
            <th @click="sort(1)">Referencia</th>
            <th @click="sort(2)">Cantidad</th>
            <th @click="sort(3)">Fecha de creación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="props in this.data"
            v-bind:key="props.id"
            class="text-center"
          >
            <td>{{ props.id_assigned }}</td>

            <td>{{ props.reference }}</td>

            <td>{{ props.amount }}</td>

            <td>{{ props.created_at }}</td>
            <td class="m-0 p-0">
              <div class="col-12 m-0">
                <button
                  type="button"
                  class="btn btn-info m-1 col-xl-5 col-xs-12"
                  @click="details(props.id)"
                >
                  <i class="el-icon-view"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="this.data.length == 0" height="50">
            <td colspan="5">
              <h5 class="bg-red">NO SE ENCONTRARON REGISTROS!!!</h5>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="text-center">
            <th @click="sort(0)">Id Pago</th>
            <th @click="sort(1)">Referencia</th>
            <th @click="sort(2)">Cantidad</th>
            <th @click="sort(3)">Fecha de creación</th>
            <th>Acciones</th>
          </tr>
        </tfoot>
      </table>
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
  props: ["detailsid"],
  data() {
    return {
      data: [],
      content: [],
      search: "",
      asc: true,
      min: 0,
      actual: 0,
      max: 0,
      pagesize: 10,
      aux: [],
      response: null,
    };
  },
  mounted() {
    if (this.response != null) this.updateData();
  },
  methods: {
    updateData() {
      this.showId = this.response.user;
      console.log(this.showId);
      this.data = this.showId.payments;
      this.content = this.showId.payments;
      this.aux = this.data;
      this.max = Math.ceil(this.data.length / this.pagesize);
      this.actual = 0;
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
      if (this.search == "") {
        this.aux = this.content;
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      } else {
        this.aux = [];
        this.content.forEach((value, index) => {
          if (this.foundIt(value.reference, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.id_assigned, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.created_at, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.amount, this.search)) {
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
            (a.id_assigned == null ? "" : a.id_assigned.toString()) <
            (b.id_assigned == null ? "" : b.id_assigned.toString())
              ? -1
              : Number(
                  (a.id_assigned == null ? "" : a.id_assigned.toString()) >
                    (b.id_assigned == null ? "" : b.id_assigned.toString())
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.id_assigned == null ? "" : a.id_assigned.toString()) <
            (b.id_assigned == null ? "" : b.id_assigned.toString())
              ? -1
              : Number(
                  (a.id_assigned == null ? "" : a.id_assigned.toString()) >
                    (b.id_assigned == null ? "" : b.id_assigned.toString())
                )
          );
          this.asc = true;
        }
      } else if ($op == 1) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.reference == null ? "" : a.reference.toString()) <
            (b.reference == null ? "" : b.reference.toString())
              ? -1
              : Number(
                  (a.reference == null ? "" : a.reference.toString()) >
                    (b.reference == null ? "" : b.reference.toString())
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.reference == null ? "" : a.reference.toString()) <
            (b.reference == null ? "" : b.reference.toString())
              ? -1
              : Number(
                  (a.reference == null ? "" : a.reference.toString()) >
                    (b.reference == null ? "" : b.reference.toString())
                )
          );
          this.asc = true;
        }
      } else if ($op == 2) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.amount == null ? "" : a.amount.toString()) <
            (b.amount == null ? "" : b.amount.toString())
              ? -1
              : Number(
                  (a.amount == null ? "" : a.amount.toString()) >
                    (b.amount == null ? "" : b.amount.toString())
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.amount == null ? "" : a.amount.toString()) <
            (b.amount == null ? "" : b.amount.toString())
              ? -1
              : Number(
                  (a.amount == null ? "" : a.amount.toString()) >
                    (b.amount == null ? "" : b.amount.toString())
                )
          );
          this.asc = true;
        }
      } else if ($op == 3) {
        if (this.asc) {
          this.aux.sort((a, b) =>
            (a.expiration_date == null ? "" : a.expiration_date.toString()) <
            (b.expiration_date == null ? "" : b.expiration_date.toString())
              ? -1
              : Number(
                  (a.expiration_date == null
                    ? ""
                    : a.expiration_date.toString()) >
                    (b.expiration_date == null
                      ? ""
                      : b.expiration_date.toString())
                )
          );
          this.asc = false;
        } else {
          this.aux.sort((b, a) =>
            (a.expiration_date == null ? "" : a.expiration_date.toString()) <
            (b.expiration_date == null ? "" : b.expiration_date.toString())
              ? -1
              : Number(
                  (a.expiration_date == null
                    ? ""
                    : a.expiration_date.toString()) >
                    (b.expiration_date == null
                      ? ""
                      : b.expiration_date.toString())
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
    details(id) {
      window.location.href = "/admin/payments/" + id + "/";
    },
  },
};
</script>
