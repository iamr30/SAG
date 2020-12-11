<template>
   <div class="col-sm-12 col-md-8 col-lg-5">
    <h2 v-if="this.editid === null" class="text-dark mb-4">Condonaciones</h2>
    <h2 v-else class="text-dark-mb-4">Condonaciones</h2>
    <div id="" class="card shadow">
      <div class="col-12 m-0 p-0">
        <div class="card-header py-3">
          <h5 v-if="this.editid === null" class="text-primary font-weight-bold">
            Agregar
          </h5>
          <h5 v-else class="text-primary font-weight-bold">Editar</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <form v-on:submit.prevent="newBlog()">
              <div class="col-sm-4 col-lg-4 text-left m-0 p-0">
                <button
                  class="btn btn-info form-button m-3"
                  type="button"
                  @click="showList()"
                >
                  <i class="el-icon-s-fold"></i>
                </button>
                <br />
              </div>
              <div class="col-12">
                <div class="row justify-content-left m-0 p-0">
                  <div class="col-12  m-0 p-0 text-left">
                    <h3>Comentarios</h3>
                <div class="w-100">
                  <textarea
                    name="comments"
                    v-model="comments"
                    class="form-control mb-2 text-left"
                    placeholder="Ingrese el comentario"
                  />
                </div>
                <h3>Porcentaje</h3>
                <div class="w-100">
                  <input
                    type="number"
                    step="0.01"
                    max="100.00"
                    min="0.00"
                    name="percentage"
                    v-model="percentage"
                    class="form-control mb-2 text-left"
                  />
                </div>
                <h3>Tipo de descuento</h3>
                <div class="w-100">
                  <input
                    type="text"
                    name="scholarship"
                    v-model="scholarship"
                    class="form-control mb-2 text-left"
                  />
                </div>
                <h3>Nombre de usuario</h3>
                <div class="w-100">
                  <el-select
                    class="w-100"
                    @change="updateCourse()"
                    v-model="id_usuario"
                    placeholder="Select"
                    required
                  >
                    <el-option
                      v-for="d in this.array"
                      :key="d.id"
                      :label="d.id+': '+d.username"
                      :value="d.id"
                    ></el-option>
                  </el-select>
                </div>
                <h3>Nombre del curso</h3>
                <div class="w-100">
                  <el-select
                    class="w-100"
                    v-model="id_course"
                    placeholder="Select"
                  >
                    <el-option
                      v-for="d in this.course"
                      :key="d.id"
                      :label="d.pivot.id+': '+d.course.name"
                      :value="d.pivot.id"
                    ></el-option>
                  </el-select>
                </div>
                <h3>Vigencia</h3>
                <div class="w-100">
                  <input
                    type="date"
                    name="expiration_date"
                    v-model="expiration_date"
                    class="form-control mb-2 text-left"
                    required
                  />
                </div>
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <button
                      class="btn btn-success form-button m-3 col-sm-12 col-lg-6"
                      type="submit"
                    >
                      <i class="el-icon-finished w-100"></i>
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
  </div>
</template>
<script>
export default {
  props: ["editid"],
  data() {
    return {
      name: "",
      comments: "",
      percentage: 0.0,
      scholarship: "",
      array: [],
      id_usuario: 0,
      expiration_date: "",
      name_usuario: "",
      course: [],
      id_course: 0,
      response: [],
    };
  },
  mounted() {
    if (this.editid != null) {
      axios.get(`/admin/condonaciones/${this.editid}`).then((response) => {
        console.log(response.data);
        this.name = response.data.data.name;
        this.comments = response.data.data.comments;
        this.percentage = response.data.data.percentage;
        this.scholarship = response.data.data.scholarship_type;
        this.name_usuario = response.data.users_cdu;
        this.id_usuario = this.name_usuario.id;
        this.updateEditCourse(response.data);
        this.expiration_date = response.data.data.expiration_date;
      });
      axios.get("/admin/usuarioscdu").then((response) => {
        this.array = response.data;
      });
    } else {
      axios.get("/admin/usuarioscdu").then((res) => {
        this.array = res.data;
      });
    }
  },
  methods: {
    newBlog() {
      const params = {
        comments: this.comments,
        percentage: this.percentage,
        scholarship: this.scholarship,
        id_assigned: this.id_course,
        expiration_date: this.expiration_date,
      };
      if (this.editid == null) {
        axios
          .post("/admin/condonaciones", params)
          .then((response) => {
            if (response.data == 1) {
              //this.$emit("new");
              this.comments = "";
              this.percentage = 0;
              this.scholarship = "";
              this.id_usuario = null;
              this.id_course = null;
              this.expiration_date = null;
              this.showSuccessNotification("Agregando", "Condonación agregada");
              window.location = "/admin/condonaciones/";
            } else {
              this.showErrorNotification("Error guardando", "Error al guardar");
              console.log(response.data);
            }
          })
          .catch((error) => {
            this.showErrorNotification("Error Guardando", "Conexión inválida");
            console.log(error);
          });
      } else {
        console.log(params);
        axios
          .put(`/admin/condonaciones/${this.editid}`, params)
          .then((response) => {
            //this.$emit("new");
            console.log(response.data);
            this.showSuccessNotification("Editando", "Condonación editada");
          })
          .catch((error) => {
            this.showErrorNotification("Error Editando", "Conexión inválida");
            console.log(error);
          });
      }
    },
    returnE() {
      //this.$emit("new");
      window.history.go(-1);
      this.name = "";
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
    updateCourse() {
      axios.get(`/admin/usuarioscdu/${this.id_usuario}`).then((response) => {
        this.course = response.data.user.assigned_schedules;
        console.log(this.course);
      });
    },
    updateEditCourse(data) {
      axios.get(`/admin/usuarioscdu/${data.users_cdu.id}`).then((response) => {
        this.course = response.data.user.assigned_schedules;
        this.course.forEach((value, index) => {
          if (value.course.id === data.course.id) {
            this.id_course = value.pivot.id;
            return;
          }
        });
      });
    },showList(){
      window.location.href="/admin/condonaciones/";
    }
  },
};
</script>