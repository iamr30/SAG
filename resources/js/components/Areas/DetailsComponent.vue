<template>
  <div class="col-sm-12 col-md-8 col-lg-5">
    <h2 class="text-dark mb-4">Áreas</h2>
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
                  <h3>Nombre</h3>
                  <div class="w-100">
                    <input
                      type="text"
                      name="name"
                      v-model="showId.name"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <button
                        v-if="this.editAvailable"
                        class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark"
                        @click="editArea()"
                      >
                        <i class="el-icon-edit"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
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
      editAvailable: false,
    };
  },
  mounted() {
    axios.get(`/admin/areas/${this.detailsid}`).then((response) => {
      this.showId = response.data;
    });
    axios.get("/admin/authuser").then((response) => {
      this.editAvailable = response.data.role_id != 3;
    });
  },
  methods: {
    ret() {
      window.history.go(-1);
    },
    editArea() {
      window.location = "/admin/areas/editar/" + this.detailsid + "/";
    },
    showList() {
      window.location = "/admin/areas/";
    },
  },
};
</script>
<style scoped>
.bgH {
  background-color: #5db7ce;
}
.lbl {
  border: 0;
  outline: 0;
  width: 100%;
  border-bottom: 1px solid black;
}
</style>