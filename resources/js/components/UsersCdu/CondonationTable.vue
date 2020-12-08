<template>
  <div v-if="this.response != null" class="row col-12">
    <div class="text-right col-sm-12 col-lg-12 col-xl-12 m-0 p-0">
      <input
        type="text"
        class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1"
        placeholder="Buscar"
        v-model="searchC"
        v-on:keyup="searchCButton"
      />
    </div>
    <div class="table-responsive table mt-2" role="grid">
      <table class="table my-0">
        <thead>
          <tr class="text-center">
            <th @click="sortC(-1)">Id Curso</th>
            <th @click="sortC(0)">Curso</th>
            <th @click="sortC(1)">Tipo de beca</th>
            <th @click="sortC(2)">Porcentaje</th>
            <th @click="sortC(3)">Vigencia</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="propsC in dataC" v-bind:key="propsC.id">
            <td>{{ propsC.id_assigned }}</td>
            <td>{{ propsC.course_name }}</td>
            <td>{{ propsC.scholarship_type }}</td>
            <td>{{ propsC.percentage }}</td>
            <td>{{ printDate(propsC.expiration_date) }}</td>
            <td class="m-0 p-0">
              <div class="col-12 m-0">
                <button
                  type="button"
                  class="btn btn-info m-1 col-xl-5 col-xs-12"
                  @click="detailsC(propsC.id)"
                >
                  <i class="el-icon-view"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="this.dataC.length == 0" height="50">
            <td colspan="6">
              <h5 class="bg-red">NO SE ENCONTRARON REGISTROS!!!</h5>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="text-center">
            <th @click="sortC(-1)">Id Curso</th>
            <th @click="sortC(0)">Curso</th>
            <th @click="sortC(1)">Tipo de beca</th>
            <th @click="sortC(2)">Porcentaje</th>
            <th @click="sortC(3)">Vigencia</th>
            <th>Acciones</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="pagination col-12 p-0">
      <div class="text-left col-8">
        <span class="text-black"
          >Mostrando {{ this.dataC.length }} de {{ this.contentC.length }}</span
        >
      </div>
      <div class="text-right col-4 p-0">
        <!-- <button class="btn btn-default p-0 mr-1" @click="Prev(-1)" :disabled="actualC==0"><i class="el-icon-arrow-left"></i></button>
                            <span class="">{{actualC+1}} de {{max}}</span>
                            <button class="btn btn-default p-0 ml-1" @click="Prev(1)" :disabled="actualC+1==max"><i class="el-icon-arrow-right"></i></button> -->
        <nav
          class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers"
        >
          <ul class="pagination">
            <li class="page-item" v-if="actualC + 1 > 1">
              <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                ><span aria-hidden="true">«</span></a
              >
            </li>
            <li class="page-item disabled" v-else>
              <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                ><span aria-hidden="true">«</span></a
              >
            </li>
            <li class="page-item" v-if="actualC + 1 == maxC && actualC >= 2">
              <a class="page-link" @click="Prev(-2)">{{ actualC - 1 }}</a>
            </li>
            <li class="page-item" v-if="actualC + 1 > 1">
              <a class="page-link" @click="Prev(-1)">{{ actualC }}</a>
            </li>
            <li class="page-item active mousehover">
              <a class="page-link">{{ actualC + 1 }}</a>
            </li>
            <li class="page-item" v-if="maxC > actualC + 1">
              <a class="page-link" @click="Prev(1)">{{ actualC + 2 }}</a>
            </li>
            <li class="page-item" v-if="actualC == 0 && maxC >= actualC + 3">
              <a class="page-link" @click="Prev(2)">{{ actualC + 3 }}</a>
            </li>
            <li class="page-item" v-if="actualC + 1 < maxC">
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
</template>
<script>
export default {
  props: ["detailsid"],
  data() {
    return {
      dataC: [],
      contentC: [],
      searchC: "",
      ascC: true,
      minC: 0,
      actualC: 0,
      maxC: 0,
      pagesizeC: 10,
      auxC: [],
      response: null,
    };
  },
  mounted() {
    if (this.response != null) this.updateData();
  },
  methods: {
    updateData() {
      this.showId = this.response.user;
      this.dataC = this.showId.condonations;
      this.contentC = this.showId.condonations;
      this.auxC = this.dataC;
      this.maxC = Math.ceil(this.dataC.length /this.pagesizeC );
      this.actualC = 0;
      this.updateC();
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
    searchCButton() {
      if (this.searchC == "") {
        this.auxC = this.contentC;
        this.maxC = Math.ceil(this.auxC.length / this.pagesizeC);
        this.actualC = 0;
        this.updateC();
      } else {
        this.auxC = [];
        this.contentC.forEach((value, index) => {
          if (this.foundIt(value.course_name, this.searchC)) {
            this.auxC.push(value);
          } else if (this.foundIt(value.scholarship_type, this.searchC)) {
            this.auxC.push(value);
          } else if (this.foundIt(value.percentage, this.searchC)) {
            this.auxC.push(value);
          } else if (
            this.foundIt(this.printDate(value.expiration_date), this.searchC)
          ) {
            this.auxC.push(value);
          } else if (this.foundIt(value.id_assigned, this.searchC)) {
            this.auxC.push(value);
          }
        });
        this.maxC = Math.ceil(this.auxC.length / 5.0);
        this.actualC = 0;
        this.updateC();
      }
    },
    sortC($op) {
      if ($op == -1) {
        if (this.ascC) {
          this.auxC.sort((a, b) =>
            (a.id_assigned == null ? "" : a.id_assigned.toString()) <
            (b.id_assigned == null ? "" : b.id_assigned.toString())
              ? -1
              : Number(
                  (a.id_assigned == null ? "" : a.id_assigned.toString()) >
                    (b.id_assigned == null ? "" : b.id_assigned.toString())
                )
          );
          this.ascC = false;
        } else {
          this.auxC.sort((b, a) =>
            (a.id_assigned == null ? "" : a.id_assigned.toString()) <
            (b.id_assigned == null ? "" : b.id_assigned.toString())
              ? -1
              : Number(
                  (a.id_assigned == null ? "" : a.id_assigned.toString()) >
                    (b.id_assigned == null ? "" : b.id_assigned.toString())
                )
          );
          this.ascC = true;
        }
      } else if ($op == 0) {
        if (this.ascC) {
          this.auxC.sort((a, b) =>
            (a.course_name == null ? "" : a.course_name.toString()) <
            (b.course_name == null ? "" : b.course_name.toString())
              ? -1
              : Number(
                  (a.course_name == null ? "" : a.course_name.toString()) >
                    (b.course_name == null ? "" : b.course_name.toString())
                )
          );
          this.ascC = false;
        } else {
          this.auxC.sort((b, a) =>
            (a.course_name == null ? "" : a.course_name.toString()) <
            (b.course_name == null ? "" : b.course_name.toString())
              ? -1
              : Number(
                  (a.course_name == null ? "" : a.course_name.toString()) >
                    (b.course_name == null ? "" : b.course_name.toString())
                )
          );
          this.ascC = true;
        }
      } else if ($op == 1) {
        if (this.ascC) {
          this.auxC.sort((a, b) =>
            (a.scholarship_type == null ? "" : a.scholarship_type) <
            (b.scholarship_type == null ? "" : b.scholarship_type)
              ? -1
              : Number(
                  (a.scholarship_type == null ? "" : a.scholarship_type) >
                    (b.scholarship_type == null ? "" : b.scholarship_type)
                )
          );
          this.ascC = false;
        } else {
          this.auxC.sort((b, a) =>
            (a.scholarship_type == null ? "" : a.scholarship_type) <
            (b.scholarship_type == null ? "" : b.scholarship_type)
              ? -1
              : Number(
                  (a.scholarship_type == null ? "" : a.scholarship_type) >
                    (b.scholarship_type == null ? "" : b.scholarship_type)
                )
          );
          this.ascC = true;
        }
      } else if ($op == 2) {
        if (this.ascC) {
          this.auxC.sort((a, b) =>
            (a.percentage == null ? 0 : a.percentage) <
            (b.percentage == null ? 0 : b.percentage)
              ? -1
              : Number(
                  (a.percentage == null ? 0 : a.percentage) >
                    (b.percentage == null ? 0 : b.percentage)
                )
          );
          this.ascC = false;
        } else {
          this.auxC.sort((b, a) =>
            (a.percentage == null ? 0 : a.percentage) <
            (b.percentage == null ? 0 : b.percentage)
              ? -1
              : Number(
                  (a.percentage == null ? 0 : a.percentage) >
                    (b.percentage == null ? 0 : b.percentage)
                )
          );
          this.ascC = true;
        }
      } else if ($op == 3) {
        if (this.ascC) {
          this.auxC.sort((a, b) =>
            (a.expiration_date == null ? "" : a.expiration_date) <
            (b.expiration_date == null ? "" : b.expiration_date)
              ? -1
              : Number(
                  (a.expiration_date == null ? "" : a.expiration_date) >
                    (b.expiration_date == null ? "" : b.expiration_date)
                )
          );
          this.ascC = false;
        } else {
          this.auxC.sort((b, a) =>
            (a.expiration_date == null ? "" : a.expiration_date) <
            (b.expiration_date == null ? "" : b.expiration_date)
              ? -1
              : Number(
                  (a.expiration_date == null ? "" : a.expiration_date) >
                    (b.expiration_date == null ? "" : b.expiration_date)
                )
          );
          this.ascC = true;
        }
      }
      this.actualC = 0;
      this.updateC();
    },
Prev($k) {
      if(this.actualC+$k<0||this.actualC+$k>this.maxC)return 0;
      this.actualC = this.actualC+$k;
       this.updateC();
    },
    NextC() {
      if (this.auxC.length > this.actualC * this.pagesizeC + this.pagesizeC)
        this.actualC++;
      this.updateC();
    },
    updateC() {
      if (this.actualC >= this.maxC) this.actualC--;
      this.dataC = this.auxC.slice(
        this.actualC * this.pagesizeC,
        this.actualC * this.pagesizeC + this.pagesizeC
      );
    },
    detailsC(id) {
      window.location.href = "/admin/condonaciones/" + id + "/";
    },
    printDate(date) {
      var d = new Date(date);
      var da = d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
      return da;
    },
  },
};
</script>