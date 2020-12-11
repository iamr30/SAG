<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<head>
  <meta charset="utf-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Orden de pago</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .chartData {
      height: 40px;
    }

    .tablepay {
      height: 25px;
    }

    .img2 {
      height: 100px;
    }

    center {
      font-size: smaller;
      padding: 0;
      margin: 0;
    }
  </style>
</head>

<body class="border border-dark border-5 rounded pl-3 pr-3 pt-3 m-0">
  <div id="app">
    <div class="border border-dark border-5 rounded text-center m-1 p-3 pb-1 mb-3">
      <table class="col-lg-12 p-0">
        <body>
          <tr>
            <td class="text-center w-50"><img class="img2 " src="..\storage\app\public\logo.png">
            </td>
          </tr>
        </body>
      </table>
    </div>

    <div>
      <div class="border border-dark border-5 rounded text-center m-1 mb-3">
        <h6 class="m-2">
          <center>INFORMACIÓN GENERAL</center>
        </h6>
        <div class="container col-sm-12 row text-center m-2">
          <table class="col-lg-12 p-0">

            <body>
              <tr>
                <td class="w-50 ">
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">ID PAGO:{{$payid}} </label>
                  </div>
                </td>
                <td>
                  <div class=" border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">REFERENCIA: {{$reference}}</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">TOTAL A PAGAR: {{$total}}</label>
                  </div>
                </td>
                <td>
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">
                      FECHA DE EMISIÓN:{{$date }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
            </body>
          </table>


        </div>
      </div>
      <div class="border border-dark border-5 rounded text-center m-1 mb-3">
        <h6 class="m-2">
          <center>DATOS PERSONALES</center>
        </h6>
        <div class="container col-sm-12 row text-center m-2">
          <table class="col-lg-12 p-0">

            <body>
              <tr>
                <td class="w-50 ">
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">NOMBRE:{{$name }} </label>
                  </div>
                </td>
                <td>
                  <div class=" border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">CÓDIGO DE MIEMBRO: {{$code }}</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">TELÉFONO: {{$phone }}</label>
                  </div>
                </td>
                <td>
                  <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">
                      CORREO ELECTRÓNICO: {{$email }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
            </body>
          </table>


        </div>
      </div>
      <div class="border border-dark border-5 rounded text-center m-1 mb-3">
        <h6 class="m-2">
          <center>DATOS DEL CURSO</center>
        </h6>
        <div class="container col-sm-12 row text-center m-2">
          <table class="col-lg-12 p-0">

            <body>
              <tr>
                <td class="w-50">
                  <div class="border chartData col-sm-12 chartData rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">NOMBRE DEL CURSO: {{$coursename }}</label>
                  </div>
                </td>
                <td>
                  <div class=" border col-sm-12 chartData rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">NOMBRE DEL INSTRUCTOR: {{$instructorname }}
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 chartData rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">DISCIPLINA:{{$discipline }}</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 chartData rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">
                      NIVEL:{{$level }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
            </body>
          </table>


        </div>
      </div>

      <div class="float-right col-sm-8 border border-secondary border-5 rounded text-center m-1 pb-3">
        <h6 class="m-2">
          <center>TOTAL A PAGAR</center>
        </h6>
        <div class="container col-sm-12 row text-center">
          <table class="col-lg-12 p-0">

            <body>
              <tr>
                <td class="w-50">
                  <div class="border tablepay col-sm-12  rounded border-dark right m-1 mb-1">
                    <label class="float-right h6 small mt-1">MESES A PAGAR: </label>
                  </div>
                </td>
                <td>
                  <div class=" border tablepay col-sm-12 rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$month }}
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">COSTO MENSUAL:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$unitario }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">BASE:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$base }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>

              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">DESCUENTO:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$condonation }}%
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">SUBTOTAL:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$subtotal }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">SALDO A FAVOR:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$favor }}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-50">
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="float-right h6 small mt-1">TOTAL A PAGAR:</label>
                  </div>
                </td>
                <td>
                  <div class="border col-sm-12 tablepay rounded border-dark text-left m-1 mb-1">
                    <label class="text h6 small">{{$total}}
                      <br />
                    </label>
                  </div>
                </td>
              </tr>
            </body>
          </table>
        </div>
      </div>
    </div>

</html>