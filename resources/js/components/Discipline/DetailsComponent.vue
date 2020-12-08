<template>
  <div class="col-sm-12 col-md-8 col-lg-5">
    <h2 class="text-dark mb-4">Disciplinas</h2>
    <div id="" class="card shadow">
      <div class="col-12 m-0 p-0">
        <div class="card-header py-3">
          <h5 class="text-primary font-weight-bold">Detalles</h5>
        </div>
        <div class="card-body">
          <form @submit.prevent="">
            <div class="col-12">
              <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                <button
                  class="btn btn-info form-button mr-0"
                  @click="showList()"
                >
                  <i class="el-icon-s-fold"></i>
                </button>
                <br />
                <br />
              </div>
              <div class="row justify-content-center m-0 p-0">
                <div class="col-12 text-left m-0 p-0">
                  <h3>ID</h3>
                  <input
                    type="text"
                    placeholder="Nombre"
                    class="form-control mb-2 text-left"
                    v-model="this.showId.id"
                    disabled
                  />
                  <h3>Nombre</h3>
                  <input
                    type="text"
                    placeholder="Nombre"
                    class="form-control mb-2 text-left"
                    v-model="this.showId.name"
                    disabled
                  />
                  <br />
                  <div>
                    <h3>Área</h3>
                    <input
                      type="text"
                      class="form-control mb-2 text-left"
                      v-if="this.showId.area != null"
                      v-model="this.showId.area.name"
                      disabled
                    />
                    <a href="javascript:void(0)" @click="areaDetails()"
                      >Ver detalles del Área</a
                    >
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <button
                        class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark"
                        v-if="this.editAvailable"
                        @click="editView()"
                      >
                        <i class="el-icon-edit"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <br />
              <br />
            </div>
          </form>
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
      showId: [],
      m: false,
      editAvailable: false,
    };
  },
  mounted() {
    axios.get("/admin/authuser").then((response) => {
      this.editAvailable = response.data.role_id != 3;
    });
    axios.get(`/admin/disciplinas/${this.detailsid}`).then((response) => {
      this.showId = response.data;
      this.m = true;
    });
  },
  methods: {
    ret() {
      //this.$emit("returnedA");
      window.history.go(-1);
    },
    showList() {
      window.location = "/admin/disciplinas/";
    },
    editView() {
      window.location = "/admin/disciplinas/editar/" + this.detailsid + "/";
    },
    areaDetails() {
      window.location = "/admin/areas/" + this.showId.area.id + "/";
    },
  },
};
</script>
<style scoped>
.lbl {
  border: 0;
  outline: 0;
  width: 100%;
  border-bottom: 1px solid black;
}
</style>