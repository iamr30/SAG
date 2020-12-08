@extends('layouts.main')

@section('content')
        <div class="container">
            <div class="row mt-5 pb5">
                <div class="col-md-8">
                    <h3 class="title-a mb-4"><b>San Javier Club Privado</b></h3>
                    <div class="description">
                        <p class="text-justify">Hace 40 años, un grupo de amigos tuvo la gran idea de formar y construir un 
                            “Club Deportivo y Social” que fuera la extensión de sus hogares. Un lugar que los pudiera integrar 
                            como socios, que integrara a hombres y mujeres de negocios con sus familias;
                            personas dinámicas y agradables, con amplia cultura, buen gusto, y de buenas costumbres;
                            personas con un gran valor moral por su contribución al bien común. </p>

                        <p class="text-justify">
                            Un terreno de más de 41 mil metros cuadrados se convirtió en el lienzo perfecto para crear nuestro club.
                            Ya son 40 años de existencia y a lo largo de estas primeras 4 décadas hemos logrado el sueño de reunir a las familias de nuestra comunidad.
                            La historia de San Javier Club Privado es parte de Colinas de San Javier, su nacimiento y engrandecimiento pues los fundadores principales  del club eran sus habitantes. Algunos continúan al día de hoy.
                            Ahora una nueva generación continua engrandeciendo el club. El árbol institucional sembrado prevalece y los nuevos presidentes, consejeros y comisionados continúan trabajando con profundo cariño por mantener el principio que inspiró la fundación del club. </p>

                    </div>
                    <img src="{{ asset('images/home/home_foto.jpg') }}" width="100%">
                </div>
                <div class="col-md-4">
                    <h3 class="title-a">NOTICIAS</h3>
                    <div class="card mb-4 mt-4">
                        <div>
                            <img src="{{ asset('images/home/home_noticia1.jpg') }}" width="100%">
                        </div>
                        <div class="card-header">
                            <b>9 SEP:</b>
                            <label> APERTURA GENERAL </label>
                        </div>
                    </div>
                    <div class="card">
                        <div class="">
                            <img src="{{ asset('images/home/home_noticia2.jpg') }}" width="100%">
                        </div>
                        <div class="card-header">
                            <b>10 SEP:</b>
                            <label> PROTOCOLO GIMNASIO </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 pb5">
                <div class="col-md-12">
                    <h3 class="title-a">INSTALACIONES</h3>
                    <div class="map">
                        <img src="{{ asset('images/home/home_mapa.png') }}" width="100%">
                    </div>
                </div>

            </div>
            <div class="row mt-5 pb-5">
                <div class="col-md-12">
                    <div class="owl-carousel">
                        <div class="item">
                            <img  class="img-responsive" src="{{ asset('images/carousel/Galeria_min1.jpg') }}">
                        </div>
                        <div class="item">
                            <img  class="img-responsive" src="{{ asset('images/carousel/Galeria_min2.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{ asset('images/carousel/Galeria_min3.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{ asset('images/carousel/Galeria_min4.jpg') }}">
                        </div>
                        <div class="item">
                            <img  class="img-responsive" src="{{ asset('images/carousel/Galeria_min5.jpg') }}">
                        </div>
                        <div class="item">
                            <img  class="img-responsive" src="{{ asset('images/carousel/Galeria_min6.jpg') }}">
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt5">
                <h3 class="title-a no-padding-cero"> SERVICIOS QUE OFRECEMOS EN:</h3>
            </div>
            <div class="row mt-5 ">
                <div class="col-md-8 pr-5">
                    <div class="row">
                        <div class="col-sm-6 no-padding-cero">
                            <img class="img-responsive image-seccion" src="{{ asset('images/home/seccion_alb.jpg ') }}" width="100%">
                            <div class="overlap-seccion d-flex justify-content-center align-items-center">
                                <h3 class="title-c">ALBERCA</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 no-padding-cero">
                            <img class="img-responsive image-seccion" src="{{ asset('images/home/seccion_uni.jpg ') }}" width="100%">
                            <div class="overlap-seccion d-flex justify-content-center align-items-center">
                                <h3 class="title-c">DEPORTES AL AIRE LIBRE</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 no-padding-cero">
                            <img class="img-responsive image-seccion" src="{{ asset('images/home/seccion_gum.jpg ') }}" width="100%">
                            <div class="overlap-seccion d-flex justify-content-center align-items-center">
                                <h3 class="title-c">GIMNASIO</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 no-padding-cero">
                            <img class="img-responsive image-seccion" src="{{ asset('images/home/seccion_co.jpg ') }}" width="100%">
                            <div class="overlap-seccion d-flex justify-content-center align-items-center">
                                <h3 class="title-c">SALON MULTIUSOS</h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 pr-3 pl-3 d-flex flex-column justify-content-between align-items-center ">
                    <button class="btn-b"><b>INSCRIBETE AHORA</b>
                    </button>
                    <button class="btn-c">REGLAMENTOS
                    </button>
                    <img src="{{ asset('images/home/home_banner.jpg') }}" width="100%">
                </div>
            </div>



        </div>
@stop

