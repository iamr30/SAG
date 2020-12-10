<template>
  <div>
    <div>
      <div class="p-3 text-center col-lg-12">
        <div class="">
          <h3 v-if="this.editid == null">Registro</h3>
          <h1 v-else>Editar Usuario</h1>
          <br /><br />
        </div>
        <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
          <button
            class="btn btn-info form-button m-3"
            type="button"
            @click="returnE()"
          >
            <i class="el-icon-s-fold"></i>
          </button>
          <br />
        </div>
        <form method="POST" v-on:submit.prevent="newBlog()">
          <div class="row">
            <div class="col-sm-12 text-right">
              <button
                class="btn btn-success form-button m-3 col-sm-12 col-md-4 col-lg-2"
                type="submit"
              >
                <i class="el-icon-finished w-100"></i>
              </button>
            </div>
          </div>
          <div class="">
            <div>
              <div class="d-inline">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col">
                      <div id="" class="card shadow mb-0 p-0 mb-3">
                        <div class="m-19">
                          <div class="card-header py-3">
                            <h5 class="text-primary font-weight-bold">
                              Perfil
                            </h5>
                          </div>
                          <div class="card-body col-lg-6 col-md-6 m-auto">
                            <div
                              class="col-md-12 rounded m-0 mb-0"
                              @dragenter="OnDragEnter"
                              @dragleave="OnDragLeave"
                              @dragover.prevent
                              @drop="onDrop"
                            >
                              <div
                                class="uploader text-center shadow"
                                :class="{ dragging: isDragging }"
                              >
                                <form
                                  class="row text-center"
                                  id="camera"
                                  action="/admin/asignar/0"
                                  target="_blank"
                                  method="post"
                                >
                                  <input
                                    type="hidden"
                                    name="option"
                                    value="picture"
                                  />
                                  <input
                                    type="hidden"
                                    name="_token"
                                    :value="csrf"
                                  />
                                  <div class="col-md-12 col-lg-6">
                                    <button
                                      @click="sendform()"
                                      class="btn btn-secondary btn-block"
                                      type="button"
                                    >
                                      Cámara
                                    </button>
                                  </div>
                                  <div class="col-md-12 col-lg-6">
                                    <input
                                      type="file"
                                      id="file"
                                      enctype="multipart/form-data"
                                      class="btn btn-info btn-block p-1 hidden"
                                      @change="onInputChange"
                                    />
                                  </div>
                                </form>
                                <div class="col-md-12 col-lg-12 text-center">
                                  <h5>Suelta tu imagen aquí</h5>
                                </div>
                                <div class="col-md-12 col-lg-12 text-center">
                                  <img
                                    enctype="multipart/form-data"
                                    class="img-rounded img2"
                                    id="pic"
                                  />
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-lg-6 m-auto">
                                    <button
                                      type="button"
                                      id="deleteImg"
                                      @click="this.deleteImg"
                                      class="btn btn-danger btn-block"
                                    >
                                      Eliminar
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-inline">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col">
                      <div class="card shadow mb-3">
                        <div class="card-header py-3">
                          <h5 class="text-primary m-0 font-weight-bold">
                            Descripción del usuario
                          </h5>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <label
                              for="id"
                              v-if="this.incorrecto"
                              class="col-sm-12 col-lg-3 col-form-label text-danger"
                              >Código: El código ya ha sido utilizado</label
                            >
                            <label
                              for="id"
                              v-else
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Código:</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="number"
                                name="id"
                                v-model="id"
                                class="form-control"
                                placeholder="Ingrese el código de miembro"
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="username"
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Nombre:</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="text"
                                name="username"
                                v-model="username"
                                class="form-control"
                                placeholder="Ingrese nombre"
                                required
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="email"
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Email</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="email"
                                name="email"
                                v-model="email"
                                class="form-control"
                                placeholder="Ingrese correo electrónico"
                                required
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="phone"
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Teléfono</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="text"
                                name="phone"
                                v-model="phone"
                                class="form-control"
                                placeholder="Ingrese teléfono"
                              />
                            </div>
                          </div>
                          <div
                            class="form-group row"
                            v-if="this.editid == null"
                          >
                            <label
                              for="username"
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Contraseña:</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="password"
                                name="password"
                                v-model="password"
                                class="form-control"
                                placeholder="Ingrese contraseña"
                                required
                              />
                            </div>
                          </div>
                          <div
                            class="form-group row"
                            v-if="this.editid == null"
                          >
                            <label
                              for="username"
                              class="col-sm-12 col-lg-3 col-form-label"
                              >Confirmar contraseña:</label
                            >
                            <div class="col-sm-12 col-lg-8">
                              <input
                                type="password"
                                name="username"
                                v-model="val_password"
                                class="form-control"
                                placeholder="Reingrese la contraseña"
                                required
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div v-if="this.editid != null">
                  <div class="container-fluid">
                    <div id="" class="card shadow mb-5">
                      <div class="m-19">
                        <div class="card-header py-3">
                          <h5 class="text-primary font-weight-bold">
                            Estado de cuenta
                          </h5>
                        </div>
                        <div class="card-body">
                          <manageuser-component
                            ref="manageuser"
                            v-on:updateAll="updateData"
                            v-bind:editid="this.editid"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div id="" class="card shadow mb-5">
                      <div class="m-19">
                        <div class="card-header py-3">
                          <h5 class="text-primary font-weight-bold">
                            Cursos asignados
                          </h5>
                        </div>
                        <div class="card-body">
                          <assignschedule-component
                            ref="assignschedule"
                            v-on:updateAll="updateData"
                            v-bind:editid="this.editid"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid" v-show="editAvailable">
                    <div id="" class="card shadow mb-5">
                      <div class="m-19">
                        <div class="card-header py-3">
                          <h5 class="text-primary font-weight-bold">
                            Agregar Tarjeta
                          </h5>
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
                            v-bind:detailsid="this.editid"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div id="" class="card shadow mb-5">
                      <div class="m-19">
                        <div class="card-header py-3">
                          <h5 class="text-primary font-weight-bold">
                            Condonaciones
                          </h5>
                        </div>
                        <div class="card-body">
                          <condonationtable-component
                            ref="condonationtable"
                            v-bind:detailsid="this.editid"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
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
      username: "",
      id: "",
      email: "",
      phone: "",
      incorrecto: false,
      array: [],
      isDragging: false,
      dragCount: 0,
      images: [],
      editAvailable: false,
      response: [],
      password: "",
      val_password: "",
    };
  },
  mounted() {
    axios.get("/admin/authuser").then((res) => {
      this.editAvailable = res.data.role_id != 3;
    });
    document.getElementById("deleteImg").style.visibility = "hidden";

    if (this.editid != null) {
      axios.get(`/admin/usuarioscdu/${this.editid}`).then((response) => {
        this.showId = response.data.user;
        this.response = response.data;
        this.username = this.showId.username;
        this.array = this.showId;
        this.id = this.showId.code;
        this.email = this.showId.email;
        this.phone = this.showId.phone;
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
        if (this.showId.pic != null) {
          document.getElementById("deleteImg").style.visibility = "visible";

          document.getElementById("pic").style.visibility == "visible";
          document.getElementById("pic").src =
            "../../../../storage/" + this.showId.pic;
        }
      });
    }
  },
  methods: {
    newBlog() {
      if ($.trim(this.username) == "") {
        this.showErrorNotification("Agregando usuario", "Ingrese un nombre");
        return;
      }
      const params = new FormData();
      let img = document.getElementById("pic");
      if (document.getElementById("deleteImg").style.visibility === "visible") {
        let canvas = document.createElement("canvas");
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        let context = canvas.getContext("2d");
        context.drawImage(img, 0, 0);
        var url = canvas.toDataURL();
        var blobBin = atob(url.split(",")[1]);
        var array = [];
        for (var i = 0; i < blobBin.length; i++) {
          array.push(blobBin.charCodeAt(i));
        }

        var file2 = new Blob([new Uint8Array(array)], { type: "image/png" });
        params.append("imagen", file2);
      } else if (this.editid != null) {
        params.append("deleteImage", this.array.id);
      }
      if (this.editid == null) {
        if (this.password != this.val_password) {
          this.showErrorNotification(
            "Agregando usuario",
            "Las contraseñas no coincide"
          );
          return;
        } else {
          if (this.password.length < 8) {
            this.showErrorNotification(
              "Agregando usuario",
              "La contraseña debe tener mínimo 8 caracteres"
            );
            return;
          }
        }
        params.append("username", this.username);
        params.append("id", this.id);
        params.append("email", this.email);
        params.append("phone", this.phone);
        params.append("role", 3);
        params.append("password", this.password);
        axios
          .post("/admin/usuarioscdu", params)
          .then((response) => {
            if (response.data.value == 0) {
              this.showErrorNotification(
                "Agregando usuario",
                "El correo ya ha sido utilizado"
              );
              return;
            }
            if (response.data.value == 1 && response.data.userdata != null) {
              this.username = "";
              this.id = "";
              this.email = "";
              this.phone = "";
              this.password = "";
              this.val_password = "";
              document.getElementById("deleteImg").style.visibility = "hidden";
              this.deleteImg();
              this.showSuccessNotification("Agregando", "Guardado Exitoso");
              console.log(response.data);
              if (response.data.url != -1) {
                window.location =
                  "/admin/usuarioscdu/" + response.data.userdata.id;
              } else {
                window.location = "/admin/usuarioscdu/";
              }
            } else {
              this.showErrorNotification(
                "Error Agregando",
                "Error guardando datos"
              );
              console.log(response.data);
            }
          })
          .catch((error) => {
            this.showErrorNotification(
              "Error Agregando",
              "Hubo un problema al guardar la imagen"
            );
            console.log(error);
          });
      } else {
        var datos = {
          username: this.username,
          code: this.id,
          email: this.email,
          phone: this.phone,
        };
        axios
          .put(`/admin/usuarioscdu/${this.editid}`, datos)
          .then((response) => {
            if (response.data.value == 0) {
              this.showErrorNotification(
                "Editando",
                "El correo ya ha sido tomado por otro usuario"
              );
              return;
            }
            this.showSuccessNotification(
              "Editando",
              "Datos de texto guardados"
            );
            console.log(response.data);
          })
          .catch((error) => {
            this.showErrorNotification(
              "Editando",
              "Hubo un problema al guardar la imagen"
            );
            console.log(error);
          });
        if (
          document.getElementById("deleteImg").style.visibility === "visible"
        ) {
          params.append("editImage", this.array.id);
          axios
            .post("/admin/usuarioscdu", params)
            .then((response) => {
              this.showSuccessNotification(
                "Editando",
                "Imagen guardada correctamente"
              );
            })
            .catch((error) => {
              this.showErrorNotification(
                "Error Editando",
                "Hubo un problema al guardar la imagen"
              );
              console.log(error);
            });
        } else {
          axios.post("/admin/usuarioscdu", params).then((response) => {
            console.log(response);
          });
        }
      }
    },
    sendform: function () {
      document.getElementById("camera").submit();
    },
    returnE() {
      window.location = "/admin/usuarioscdu/";
    },
    OnDragEnter(e) {
      e.preventDefault();
      this.dragCount++;
      this.isDragging = true;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;
      if (this.dragCount <= 0) {
        this.isDragging = false;
      }
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();
      this.dragCount = 0;
      this.isDragging = false;
      const files = e.dataTransfer.files;
      Array.from(files).forEach((file) => this.addImage(file));
    },
    onInputChange(e) {
      const files = e.target.files;
      Array.from(files).forEach((file) => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        console.log(`${file.name} no es una imagen`);
        this.showErrorNotification("Añadir Imagen", "No es una imagen");
        return;
      }
      document.getElementById("deleteImg").style.visibility = "visible";
      var im = document.getElementById("pic");
      document.getElementById("pic").style.visibility = "visible";
      const img = new Image(),
        reader = new FileReader();
      reader.onload = (e) => (im.src = e.target.result);
      reader.readAsDataURL(file);
    },
    popUp() {
      var win = window.open(
        "",
        "wildebeast",
        "width=600,height=600,scrollbars=1,resizable=1"
      );
      var html = "<!DOCTYPE html><html><body>";
      html +=
        "<video id='video2' >Tu navegador no soporta este tipo de procedimiento</video>";
      html += "<canvas id='canvas'></canvas>";
      html +=
        " <div id='showB'><button class='btn btn-success' onclick='saveP()'>Guardar Imagen</button><input class='btn btn-primary'id='taking'onclick='tem()' type='button' value='Tomar Foto'/></div>";
      html += "</body>";
      html += "<script type='text/javascript'>";
      html +=
        "(function() {document.getElementById('showB').style.visibility='hidden';snap();})();";
      html +=
        "function snap() {try{navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMediat ||navigator.msGetUserMedia || navigator.oGetUserMedia || navigator.mGetUserMedia;if (navigator.getUserMedia) { navigator.getUserMedia({ video: true }, this.streamWebCam, this.throwError);}}catch(error){alert('Tu dispositivo no soporta esta funcionalidad');}} ";
      html += "function streamWebCam(stream) {if(stream==null)alert('error');";
      html += "var w = window.innerWidth";
      html += "|| document.documentElement.clientWidth";
      html += "|| document.body.clientWidth;";

      html += "var h = window.innerHeight";
      html += "|| document.documentElement.clientHeight";
      html +=
        "|| document.body.clientHeight;h-=30;var canvas=document.getElementById('canvas');var video = document.getElementById('video2'); video.width=w;video.height=h;video.src = window.URL.createObjectURL(stream);video.play();canvas.style.display='none';video.style.display='initial'; ";
      html +=
        "document.getElementById('taking').value='Tomar Imagen';document.getElementById('showB').style.visibility='visible';}";
      html +=
        "function throwError(e) {try{var video = document.getElementById('video2');video.src = window.URL.createObjectURL(stream); }catch(error){alert('Tu dispositivo no soporta esta funcion');}} ";
      html +=
        "function tem(){var video = document.getElementById('video2');if(document.getElementById('canvas').style.display==='initial'){document.getElementById('taking').value='Tomar Imagen';document.getElementById('canvas').style.display='none';video.play();video.style.display='initial';}else{document.getElementById('taking').value='Iniciar la cámara'; canvas.style.display='initial';take();}}";
      html +=
        "function saveP(){var canvas=document.getElementById('canvas');var img = canvas.toDataURL();var d=window.opener.document.getElementById('pic');if(document.getElementById('taking').value==='Tomar Imagen'){}else{d.src=img;d.style.height='200px';window.opener.document.getElementById('deleteImg').style.visibility='visible';}window.close();}";
      html +=
        "function take() {var canvas=document.getElementById('canvas');var video = document.getElementById('video2'); var video = document.getElementById('video2');canvas.style.display='initial'; canvas.width=video.offsetWidth;canvas.height=video.offsetHeight;var context = canvas.getContext('2d'); context.drawImage(video, 0, 0,video.width,video.height); video.style.display='none';video.pause(); } ";
      html += "</sc" + "ript > </html >";
      //variable name of window must be included for all three of the following methods so that
      //javascript knows not to write the string to this window, but instead to the new windo
      //window.opener.dataPopUp('hola');
      win.document.open();
      win.document.write(html);
      win.focus();
      //win.document.close()
    },
    deleteImg() {
      document.getElementById("deleteImg").style.visibility = "hidden";
      document.getElementById("pic").style.visibility = "hidden";
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
    updateData() {
      axios.get(`/admin/usuarioscdu/${this.editid}`).then((response) => {
        this.showId = response.data.user;
        this.response = response.data;
        this.array = this.showId;
        this.$refs.manageuser.response = this.response;
        this.$refs.manageuser.updateData();
        this.$refs.assignschedule.response = this.response;
        this.$refs.assignschedule.updateData();
        this.$refs.paymenttable.response = this.response;
        this.$refs.paymenttable.updateData();
        this.$refs.condonationtable.response = this.response;
        this.$refs.condonationtable.updateData();
        if (this.showId.pic != null) {
          document.getElementById("deleteImg").style.visibility = "visible";

          document.getElementById("pic").style.visibility == "visible";
          document.getElementById("pic").src =
            "../../../../storage/" + this.showId.pic;
        }
      });
    },
  },
};
</script>
<style lang="scss" scoped>
.uploader {
  border: 2px dashed black;
  background-color: white;
}
.img2 {
  max-height: 150px;
  max-width: 150px;
}

.dragging {
  background: rgb(218, 213, 213);
  color: rgb(233, 231, 231);
}

.images-preview {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.bgH {
  background-color: #131f22;
}

.center-block {
  width: 250px;
  padding: 10px;
  background-color: #eceadc;
  color: #ec8007;
}

.name {
  overflow: hidden;
  height: 18px;
}
</style>