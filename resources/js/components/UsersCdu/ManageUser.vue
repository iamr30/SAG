<template>
  <div v-if="this.response != null">
    <div class="text-left p-3">
      <div class="d-inline">
        <input
          @click="sendamount()"
          type="button"
          class="btn btn-primary col-xs-12 col-md-6 col-lg-4 m-1"
          :value="
            'Transferir dinero a cursos: ' + this.data_account.amount + ' $'
          "
        />
      </div>
    </div>
    <div class="table-responsive table mt-2" role="grid">
      <table class="table my-0">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th class="w-25">CURSO</th>
            <th class="w-25">MESES A PAGAR</th>
            <th>TOTAL</th>
            <th class="w-25">VIGENCIA</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-if="
              this.data_account.assigned_schedules == null ||
              this.data_account.assigned_schedules.length <= 0
            "
          >
            <td colspan="6"><h5>NO SE ENCONTRARON REGISTROS!!!</h5></td>
          </tr>
          <tr
            v-else
            v-for="account in this.data_account.assigned_schedules"
            v-bind:key="account.pivot.id"
            class="text-center col-lg-12"
          >
            <td>{{ account.pivot.id }}</td>
            <td>{{ account.course != null ? account.course.name : "" }}</td>
            <td>{{ account.pivot.amount }}</td>
            <td>{{ account.total_user }}</td>
            <td v-if="new Date(account.pivot.expiration_date) <= new Date()">
              <label class="text-danger">{{
                account.pivot.expiration_date != null
                  ? new Date(account.pivot.expiration_date).toLocaleString(
                      "es-mx"
                    )
                  : "Sin vigencia"
              }}</label>
            </td>
            <td v-else>
              <label class="text-success">{{
                account.pivot.expiration_date != null
                  ? new Date(account.pivot.expiration_date).toLocaleString(
                      "es-mx"
                    )
                  : "Sin vigencia"
              }}</label>
            </td>
            <td class="w-50">
              <div class="row col-lg-12">
                <button
                  type="button"
                  @click="modifyMonth(account)"
                  class="btn btn-info col-xs-12 col-md-12 col-xl-3 col-lg-4 m-1"
                >
                  <i class="el-icon-date"></i>
                </button>
                <button
                  v-if="editAvailable"
                  @click="addPayment(account)"
                  type="button"
                  class="btn btn-dark col-xs-12 col-md-12 col-xl-3 col-lg-4 m-1"
                >
                  <i class="el-icon-money"></i>
                </button>
                <form
                  class="col-lg-4 col-md-12 col-xs-12 m-1 p-0 col-xl-3"
                  :id="account.pivot.id"
                  target="_blank"
                  method="post"
                >
                  <input v-show="false" name="data" :value="account.pivot.id" />
                  <input v-show="false" name="user_id" v-model="id" />
                  <input type="hidden" name="_token" :value="csrf" />
                  <button
                    @click="submit(account)"
                    type="button"
                    class="btn btn-primary col-xs-12 col-md-12 col-lg-12"
                  >
                    <i class="el-icon-document"></i>
                  </button>
                </form>
                <button v-if="editAvailable"
                  @click="addCondonation(account)"
                  type="button"
                  class="btn btn-secondary col-xs-12 col-md-12 col-xl-3 col-lg-4 m-1"
                >
                  <i class="el-icon-s-order"></i>
                </button>

                <form
                  class="col-lg-4 col-md-12 col-xs-12 m-1 p-0 col-xl-3"
                  :id="account.pivot.id + 'payment'"
                  target="_blank"
                  method="post"
                  action="https://mipagoudg.udg.mx:443/PagoUdgServ/pasarela.xhtml"
                >
                  <input
                    v-show="false"
                    name="evento"
                    value="CARRERA_LEONES_NEGROS"
                  />
                  <input
                    v-show="false"
                    name="monto"
                    v-model="account.total_user"
                  />
                  <input
                    v-show="false"
                    name="nombre"
                    v-model="data_account.username"
                  />
                  <input
                    v-show="false"
                    name="mail_cliente"
                    v-model="data_account.email"
                  />
                  <input
                    v-show="false"
                    name="referenciaUno"
                    v-model="account.course.reference"
                  />
                  <input
                    type="hidden"
                    name="url_retorno"
                    :value="
                      'https://df6a2ac66913.ngrok.io/asignar/' +
                      account.pivot.id
                    "
                  />
                  <button
                    type="button"
                    @click="submitonline(account)"
                    class="btn btn-success col-xs-12 col-md-12 col-lg-12"
                    value="Pagar en línea"
                  >
                    <i class="el-icon-bank-card"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="text-center">
            <th>ID</th>
            <th class="w-25">CURSO</th>
            <th class="w-25">MESES A PAGAR</th>
            <th>TOTAL</th>
            <th class="w-25">VIGENCIA</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div></div>
  </div>
</template>
<script>
export default {
  props: ["editid"],
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      data_account: null,
      response: null,
      id: 0,
      editAvailable: false,
      now: new Date(),
    };
  },
  mounted() {
    axios.get("/admin/authuser").then((response) => {
      this.editAvailable = response.data.role_id != 3;
    });
    if (this.response != null) this.updateData();
  },
  methods: {
    sum_data() {
      var sum = 0;
      if (this.data_account.assigned_schedules != null) {
        this.data_account.assigned_schedules.forEach((value, index) => {
          sum = value.pivot != null ? value.pivot.amount + sum : sum;
        });
      }
      return sum;
    },
    updateData() {
      console.log(this.response);
      this.data_account = this.response.user;
      this.id = this.data_account != null ? this.data_account.id : 0;
    },
    submit: function (data) {
      // document.getElementById("data").value = data.pivot.id;
      document.getElementById(data.pivot.id).action = "/admin/usuarioscdu/";
      document.getElementById(data.pivot.id).submit();
    },
    submitonline: function (data) {
      document.getElementById(data.pivot.id + "payment").submit();
    },
    modifyMonth(data) {
      let m = this.$modals.add({
        title: "Modificar Meses a Pagar",
        theme: "mojave", // || mojave
        items: [
          {
            label: "Cantidad de meses:",
            name: "amount",
            type: "number",
            value: data.pivot.amount,
            attr: {
              required: true,
              min: 1,
              max: 24,
            },
          },
        ],
      });
      m.open();
      m.onsave((m) => {
        let j = m.getItems();
        setTimeout(() => {
          console.log(m.formData());
          m.close();
        }, 500);
        const params = {
          amount: j[0].value,
        };
        axios
          .put(`/admin/asignar/${data.pivot.id}`, params)
          .then((response) => {
            if (response.data == 1) {
              this.$emit("updateAll");
              console.log(response);
              this.showSuccessNotification(
                "Modificar Meses",
                "Se han modificado los meses"
              );
            } else {
              this.showErrorNotification(
                "Error Modificando Meses",
                "Hubo un problema al modificar"
              );
              console.log(response.data);
            }
          })
          .catch((error) => {
            this.showErrorNotification(
              "Error Modificando Meses",
              "Hubo un problema al modificar"
            );
            console.log(error);
          });
      });
      m.onopen(() => {
        let y = m.set(0, "cargando");
        y.parent.$parent.$children[0].textSubmit = "Guardar";
        y.parent.$parent.$children[0].textCancel = "Cancelar";
        console.log("Reloaded");
      });
      m.onreload(() => {
        console.log("Reloaded");
      });
    },
    addPayment(data) {
      var d = data.course.reference;
      let m = this.$modals.add({
        title: "Agregar Pago",
        theme: "mojave", // || mojave
        items: [
          {
            label: "Referencia:",
            name: "username",
            type: "text",
            value: d,
            attr: {
              required: true,
              placeholder: "Ingrese la referencia",
              readOnly: true,
            },
          },
          {
            label: "Cantidad",
            name: "username",
            type: "number",
            value: data.total_user,
            attr: {
              required: true,
              step: 0.01,
            },
          },
          {
            label: "Comentarios",
            name: "comments",
            type: "textarea",
            value: "",
            attr: {
              placeholder: "Ingrese un comentario",
            },
          },
        ],
      });
      m.open();
      m.onsave((m) => {
        let j = m.getItems();
        setTimeout(() => {
          console.log(m.formData());
          m.close();
        }, 500);
        const params = {
          id_userCDU: this.response.user.id,
          id_assigned: data.pivot.id,
          reference: j[0].value,
          comments: j[2].value,
          expiration_date: null,
          amount: j[1].value,
        };
        axios
          .post("/admin/payments", params)
          .then((response) => {
            this.$emit("updateAll");
            console.log(response);
            this.showSuccessNotification(
              "Agregando Pago",
              "El pago ha sido agregado"
            );
          })
          .catch((error) => {
            this.showErrorNotification(
              "Error Agregando",
              "Hubo un problema al agregar el pago"
            );
            console.log(error);
          });
      });
      m.onopen(() => {
        let y = m.set(0, "cargando");
        y.parent.$parent.$children[0].textSubmit = "Guardar";
        y.parent.$parent.$children[0].textCancel = "Cancelar";
        console.log("Reloaded");
      });
      m.onreload(() => {
        console.log("Reloaded");
      });
    },
    addCondonation(data) {
      let m = this.$modals.add({
        title: "Agregar Condonación",
        theme: "mojave", // || mojave
        items: [
          {
            label: "Comentarios:",
            name: "comments",
            type: "textarea",
            value: "",
            attr: {
              placeholder: "Ingrese un comentario",
            },
          },
          {
            label: "Porcentaje:",
            name: "porcentage",
            type: "number",
            value: 0.0,
            attr: {
              required: true,
              max: 100.0,
            },
          },
          {
            label: "Tipo de beca",
            name: "scholar_ship",
            type: "textarea",
            value: null,
            attr: {
              placeholder: "Ingrese el tipo de beca",
              required: true,
            },
          },
          {
            label: "Vigencia",
            name: "expiration_date",
            type: "date",
            value: null,
            attr: {
              required: true,
            },
          },
        ],
      });
      m.open();
      m.onsave((m) => {
        let j = m.getItems();
        console.log(j);
        setTimeout(() => {
          console.log(m.formData());
          m.close();
        }, 500);
        const params = {
          comments: j[0].value,
          percentage: j[1].value > 100.0 ? 100.0 : j[1].value,
          scholarship: j[2].value,
          id_assigned: data.pivot.id,
          expiration_date: j[3].value,
        };
        axios
          .post("/admin/condonaciones", params)
          .then((response) => {
            if (response.data == 1) {
              this.$emit("updateAll");
              this.showSuccessNotification("Agregando", "Condonación agregada");
            } else {
              this.showErrorNotification("Error guardando", "Error al guardar");
              console.log(response.data);
            }
          })
          .catch((error) => {
            this.showErrorNotification("Error Guardando", "Conexión inválida");
            console.log(error);
          });
      });
      m.onopen(() => {
        let y = m.set(0, "cargando");
        y.parent.$parent.$children[0].textSubmit = "Guardar";
        y.parent.$parent.$children[0].textCancel = "Cancelar";
        console.log("Reloaded");
      });
      m.onreload(() => {
        console.log("Reloaded");
      });
    },
    sendamount() {
      let da = [];
      this.response.user.assigned_schedules.forEach((value) => {
        da.push({
          text: value.pivot.id + ": " + value.course.name,
          value: value.pivot.id,
        });
      });
      let m = this.$modals.add({
        title: "Transferencia",
        theme: "mojave", // || mojave
        items: [
          {
            label: "Curso",
            name: "course",
            type: "select",
            value: null,
            options: da,
            attr: {
              required: true,
            },
          },
          {
            label: "Cantidad:",
            name: "amount",
            type: "number",
            value: 0.0,
            attr: {
              required: true,
              max: this.data_account.amount,
              step: 0.01,
            },
          },
          {
            label: "Commentarios",
            name: "commentes",
            type: "textarea",
            value: "",
            attr: {
              required: true,
              placeholder: "Ingrese un comentario",
            },
          },
        ],
      });
      m.open();
      m.onsave((m) => {
        let j = m.getItems();
        const params = {
          id_user: this.response.user.id,
          amount: j[1].value,
        };
        if (j[0].value != null) {
          axios.post("/admin/usuarioscdu/", params).then((response) => {
            console.log(response.data);
          });
          const params2 = {
            id_userCDU: this.response.user.id,
            id_assigned: j[0].value,
            reference: "",
            comments: j[2].value,
            expiration_date: null,
            amount: j[1].value,
          };
          axios
            .post("/admin/payments", params2)
            .then((response) => {
              this.$emit("updateAll");
              console.log(response);
              this.showSuccessNotification(
                "Agregando Transferencia",
                "La transferencia se realizó con éxito"
              );
              m.close();
            })
            .catch((error) => {
              this.showErrorNotification(
                "Error Agregando",
                "Hubo un problema en la transferencia"
              );
              console.log(error);
            });
        } else {
          this.showErrorNotification(
            "Error en la transferencia",
            "Seleccione un curso"
          );
        }
      });
      m.onopen(() => {
        let y = m.set(0, "cargando");
        y.parent.$parent.$children[0].textSubmit = "Guardar";
        y.parent.$parent.$children[0].textCancel = "Cancelar";
        console.log("Reloaded");
      });
      m.onreload(() => {
        console.log("Reloaded");
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
  },
};
</script>