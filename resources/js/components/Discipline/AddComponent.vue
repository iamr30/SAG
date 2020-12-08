<template>
  <div class="col-sm-12 col-md-8 col-lg-5">
    <h2 v-if="this.editid === null" class="text-dark mb-4">Disciplinas</h2>
    <h2 v-else class="text-dark-mb-4">Disciplinas</h2>
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
                  <div class="col-12 m-0 p-0 text-left">
                    <h3>Nombre</h3>
                    <div class="w-100">
                      <input
                        type="text"
                        name="name"
                        v-model="name"
                        class="form-control mb-2 text-left"
                        placeholder="Ingrese Nombre"
                        required
                      />
                    </div>
                    <br />
                    <h3>Nombre del área</h3>
                    <div class="w-100">
                      <el-select
                        class="w-100"
                        v-model="id_area"
                        placeholder="Select"
                        name="id_area"
                        required
                      >
                        <el-option
                          v-for="d in this.array"
                          :key="d.id"
                          :label="d.name"
                          :value="d.id"
                        ></el-option>
                      </el-select>
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
      array: [],
      id_area: [],
      dragCount: 0,
      isDragging: false,
    };
  },
  mounted() {
    if (this.editid != null) {
      axios.get("/admin/areas").then((response) => {
        this.array = response.data;
      });
      axios.get(`/admin/disciplinas/${this.editid}`).then((response) => {
        this.name = response.data.name;
        this.id_area = response.data.area.id;
      });
    } else {
      axios.get("/admin/areas").then((res) => {
        this.array = res.data;
      });
    }
  },
  methods: {
    newBlog() {
      const params = {
        name: this.name,
        id_area: this.id_area,
      };
      if (this.editid == null) {
        axios
          .post("/admin/disciplinas", params)
          .then((response) => {
            if (response.data == 1) {
              //this.$emit("new");
              this.name = "";
              this.showSuccessNotification("Agregando", "Disciplina agregada");
              window.location = "/admin/disciplinas/";
            } else {
              this.showErrorNotification(
                "Error guardando",
                "Conexión inválida"
              );
              console.log(response.data);
            }
          })
          .catch((error) => {
            this.showErrorNotification("Error guardando", "Conexión inválida");
            console.log(error);
          });
      } else {
        axios
          .put(`/admin/disciplinas/${this.editid}`, params)
          .then((response) => {
            //this.$emit("new");
            this.showSuccessNotification("Editando", "Disciplina editada");
          })
          .catch((error) => {
            this.showErrorNotification("Error editando", "Conexión inválida");
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
    showList() {
      window.location = "/admin/disciplinas/";
    },
  },
};
</script>