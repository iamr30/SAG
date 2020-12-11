<template>
  <div class="col-sm-12 col-md-8 col-lg-5">
    <h2 class="text-dark mb-4">Condonaciones</h2>
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
                  <h3>Comentarios</h3>
                  <div class="w-100">
                    <textarea
                      name="comments"
                      v-model="showId.data.comments"
                      class="form-control mb-2 text-left"
                      placeholder="Ingrese el comentario"
                      :disabled="true"
                    />
                  </div>
                  <br />
                  <h3>Porcentaje</h3>
                  <div class="w-100">
                    <input
                      type="number"
                      step="0.01"
                      max="100.00"
                      min="0.00"
                      name="percentage"
                      v-model="showId.data.percentage"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                  </div>
                  <br />
                  <h3>Tipo de descuento</h3>
                  <div class="w-100">
                    <input
                      type="text"
                      name="scholarship"
                      v-model="showId.data.scholarship_type"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                  </div>
                  <br />
                  <h3>Nombre de usuario</h3>
                  <div class="w-100">
                    <input
                      type="text"
                      name="scholarship"
                      v-model="showId.users_cdu.username"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                    <a href="javascript:void(0)" @click="userDetails()"
                      >Ver detalles del usuario</a
                    >
                  </div>
                  <br />
                  <h3>Nombre del curso</h3>
                  <div class="w-100">
                    <input
                      type="text"
                      name="scholarship"
                      v-model="showId.course.name"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                    <a href="javascript:void(0)" @click="courseDetails()"
                      >Ver detalles del curso</a
                    >
                  </div>
                  <br />
                  <h3>Vigencia</h3>
                  <div class="w-100">
                    <input
                      type="date"
                      name="expiration_date"
                      v-model="showId.data.expiration_date"
                      class="form-control mb-2 text-left"
                      :disabled="true"
                    />
                  </div>
                  <br />
                  <div class="row" v-if="this.editAvailable">
                    <div class="col-12 text-center">
                      <button
                        class="btn btn-secondary form-button m-3 col-sm-12 col-lg-6 border-dark"
                        @click="editCondonation()"
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
      showId: null,
      editAvailable: false,
    };
  },
  mounted() {
    axios.get(`/admin/condonaciones/${this.detailsid}`).then((response) => {
      this.showId = response.data;
    });
    axios.get("/admin/authuser").then((response) => {
      this.editAvailable = response.data.role_id != 3;
    });
  },
  methods: {
    ret() {
      // this.$emit("returnedA");
      window.history.go(-1);
    },
    editCondonation() {
      window.location = "/admin/condonaciones/editar/" + this.detailsid + "/";
    },
    showList() {
      window.location = "/admin/condonaciones/";
    },
    userDetails() {
      window.location = "/admin/usuarioscdu/" + this.showId.users_cdu.id + "/";
    },
    courseDetails() {
      console.log(this.showId);
      window.location =
        "/admin/horarios/" +
        this.showId.data.assigned_schedules.id_schedules +
        "/";
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