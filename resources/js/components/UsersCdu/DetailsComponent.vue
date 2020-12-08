<template>
  <div class="p-3 text-center">
    <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
      <button class="btn btn-info form-button m-3" type="button" @click="ret()">
        <i class="el-icon-s-fold"></i>
      </button>
      <br />
    </div>
    <div class="d-flex flex-column" id="content-wrapper">
     <h3 class="text-dark mb-4 text-left">Perfil</h3>

      <div class="container">
        <div class="row ">
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body text-center shadow ">
                <img
                  class="rounded-circle mb-3 mt-4"
                  id="pic"
                  width="160"
                  height="160"
                />
                <div class="mb-3">
                  <button
                    class="btn btn-primary btn-sm"
                    type="button"
                    @click="edit()"
                  >
                    Editar usuario
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8  mb-3">
                <div class="card shadow h-100">
                  <div class="card-header ">
                    <h5 class="text-primary m-0 font-weight-bold">
                      Descripción del usuario
                    </h5>
                  </div>
                  <div class="card-body ">
                    <form>
                      <div class="form-row">
                        <div class="col">
                          <div class="form-group">
                            <label for="username"
                              ><strong>Nombre de usuario</strong></label
                            ><input
                              class="form-control"
                              type="text"
                              placeholder="user.name"
                              name="username"
                              :value="this.showId.username"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="email"
                              ><strong>Correo electrónico</strong></label
                            ><input
                              class="form-control"
                              type="email"
                              placeholder="user@example.com"
                              name="email"
                              :value="this.showId.email"
                              disabled
                            />
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col">
                          <div class="form-group">
                            <label for="first_name"
                              ><strong>Código</strong></label
                            ><input
                              class="form-control"
                              type="text"
                              placeholder="John"
                              name="first_name"
                              :value="this.showId.code"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="last_name"
                              ><strong>Teléfono</strong></label
                            ><input
                              class="form-control"
                              type="text"
                              placeholder="Doe"
                              name="last_name"
                              :value="this.showId.phone"
                              disabled
                            />
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div id="" class="card shadow mb-5">
          <div class="m-19">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Estado de cuenta</h5>
            </div>
            <div class="card-body">
              <manageuser-component
                ref="manageuser"
                v-on:updateAll="updateData"
                v-bind:editid="this.detailsid"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div id="" class="card shadow mb-5">
          <div class="m-19">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Cursos asignados</h5>
            </div>
            <div class="card-body">
              <assignschedule-component
                ref="assignschedule"
                v-on:updateAll="updateData"
                v-bind:editid="this.detailsid"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid" v-show="this.editAvailable">
        <div id="" class="card shadow mb-5">
          <div class="m-19">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Agregar Tarjeta</h5>
            </div>
            <div class="card-body">
              <cardtable-component ref="cardtable" />
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div id="" class="card shadow mb-5">
          <div class="m-19">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Pagos</h5>
            </div>
            <div class="card-body">
              <paymenttable-component
                ref="paymenttable"
                v-bind:detailsid="this.detailsid"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div id="" class="card shadow mb-5">
          <div class="m-19">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Condonaciones</h5>
            </div>
            <div class="card-body">
              <condonationtable-component
                ref="condonationtable"
                v-bind:detailsid="this.detailsid"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["detailsid", "showpay"],
  data() {
    return {
      showId: [],
      response: [],
      editAvailable: false,
    };
  },
  mounted() {
    axios.get("/admin/authuser").then((res) => {
      this.editAvailable = res.data.role_id != 3;
    });
    this.updateData();
  },
  methods: {
    ret() {
      //this.$emit("returnedA");
      window.location = "/admin/usuarioscdu/";
    },
    updateData() {
      axios.get(`/admin/usuarioscdu/${this.detailsid}`).then((response) => {
        this.response = response.data;
        this.showId = response.data.user;
        this.$refs.cardtable.response = this.response;
        this.$refs.cardtable.updateData();
        this.$refs.manageuser.response = this.response;
        this.$refs.manageuser.updateData();
        this.$refs.assignschedule.response = this.response;
        this.$refs.assignschedule.updateData();
        this.$refs.paymenttable.response = this.response;
        this.$refs.paymenttable.updateData();
        this.$refs.condonationtable.response = this.response;
        this.$refs.condonationtable.updateData();
        if (this.showId.pic == null) {
          document.getElementById("pic").src =
            "../../../../storage/invalidPhoto.jpg";
        } else {
          document.getElementById("pic").src =
            "../../../../storage/" + this.showId.pic;
        }
      });
    },
    edit() {
      window.location = "/admin/usuarioscdu/editar/" + this.detailsid + "/";
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
