<template>
  <div class="row col-lg-10 col-md-10 h-100 bg-dark text-center p-4">
    <div style="position: relative; height: 100%;width:100%; border: solid;" class="bg-secondary">
      <video
        v-show="this.sho"
        id="video"
        class="col-lg-10 h-auto w-auto"
        autoplay
      >Tu navegador no soporta esta funcion.</video>
      <canvas id="canvas" v-show="false"></canvas>
      <div class="output" v-show="!this.sho">
        <img id="photo" />
      </div>
      <div
        style="position: absolute; height: auto; border: solid; bottom: 0; right: 0;  left: 0; "
        class="text-center p-2"
      >
        <button
          type="button"
          @click="savePicture()"
          class="btn btn-success col-sm-10 col-md-3 m-1"
        >Guardar Imagen</button>
        <button
          type="button"
          id="startbutton"
          @click="takepicture()"
          class="btn btn-primary col-sm-10 col-md-3 m-1"
        >Tomar Imagen</button>
        <button type="button" @click="exit()" class="btn btn-danger col-sm-10 col-md-3 m-1">Salir</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      width: 320,
      height: 0,
      streaming: false,
      sho: true,
      cam:false
    };
  },
  mounted() {
    var x=this;
    try{
    navigator.mediaDevices
        .getUserMedia({ video: true, audio: false })
        .then(function (stream) {
          video.srcObject = stream;
          video.play();
          video.width = 0;
          video.height = 0;
          x.cam=true;
        })
        .catch(function (err) {
          console.log("An error occurred: " + err);
           x.showErrorNotification("Cámara","Error al abrir la cámara");
     
         // x;
        });
    }catch(erro){
      console.log("An error occurred: " + erro)
      x.showErrorNotification("Cámara","Error al abrir la cámara");
     }
   // window.addEventListener("load", this.startup(), false);
  },
  methods: {
    clearphoto() {
      this.showErrorNotification("Imagen", "No se ha tomado ninguna imagen");
    },
    takepicture() {
      if(!this.cam){
        this.showErrorNotification("Cámara", "No se ha habilitado una cámara");
        return;
      }
      var video = document.getElementById("video");
      var canvas = document.getElementById("canvas");
      var photo = document.getElementById("photo");
      var startbutton = document.getElementById("startbutton");
      var context = canvas.getContext("2d");
      if (video.paused) {
        video.play();
        startbutton.innerHTML="Tomar Imagen";
        this.sho=true;
      } else {
        canvas.width = video.offsetWidth;
        canvas.height = video.offsetHeight;
        context.drawImage(video, 0, 0, video.offsetWidth, video.offsetHeight);
        var data = canvas.toDataURL("image/png");
        photo.setAttribute("src", data);
        if (video.srcObject!=null) {
          this.sho = false;
          startbutton.innerHTML="Iniciar cámara";
          video.pause();
        } else {
          this.clearphoto();
        }
      }
    },
    savePicture() {
      var video = document.getElementById("video");
      var canvas = document.getElementById("canvas");
      var photo = document.getElementById("photo");
      var startbutton = document.getElementById("startbutton");
      var context = canvas.getContext("2d");
      if (!this.sho) {
        window.opener.document.getElementById("pic").src = photo.src;
        window.opener.document.getElementById("deleteImg").style.visibility =
          "visible";
        window.close();
      } else {
        this.clearphoto();
      }
    },
    exit() {
      video.pause();
      video.currentTime = 0;
      window.close();
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
        
        