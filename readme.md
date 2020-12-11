<h1> Proyecto final Programacion para internet </h1>
<h2> Sistema administrativo gimnasio (actualizado centro deportivo) - SAG </h2>
<p> Sistema administrativo de usuarios de diferentes niveles para la organizacion de estos, asi como cursos, instructores y pagos del centro deportivo.
    Ademas de contar con una landing page de donde se podra acceder como usuarioCDU (usuario de mas bajo nivel en el organigrama - usuario cliente, este solo puede ver su detalle), como usuario administrador con la capacidad de ver y administrar usuariosCDU, instructores, areas, cursos, horarios, disciplinas, niveles y pagos, ademas de un dashboard que da un 
    resumen administrativo sobre todas las tablas mencionadas, al final se cuenta con el usuario de mas alto nivel que es capaz de entrar al sistema voyager aplicado para la seguridad y administracion del sistema completo. </p>
<p> Como extras se incluye la capacidad de tomar y guardar las imagenes de un usuario nuevo (conectandose a la camara del ordenador o subiendo un archivo png o jpg), ademas de la descarga de ordenes de pago (en formato pdf), tambien tomando como login externo Vayager e incluso cuenta con la capacidad de restablecer contraseña mediante correo. </p>
<p><b> integrantes: </b></p>
<ul>
<li> Isaac Marquez </li>
<li> Oscar Lopez </li>
<li> Luis Cortes </li>
</ul>
<p>Pasos:
<ul>
<li> Crear una base de datos 'utf8_general_ci' y agregar el nombre en 'DB_DATABASE' de preferencia se puede llamar sag  </li>
<li> composer update </li>
<li> php artisan migrate </li>
<li> php artisan voyager:install --with-dummy </li>
<li> npm install </li>
<li> rm public/storage </li>
<li> php artisan storage:link  </li>
<li> npm install vue-eagle-modal </li>
<li> php artisan key:generate </li>
<li> php artisan config:cache </li>
<li> npm run dev </li>
<li> php artisan serve </li>
</ul>
<p> Para utilizar una base de datos con informacion "predeterminada" se recomienda el comando "mysql -u root -p sag < sag-sys_backup.sql", primero se debe de crear la bd sag y en seguida ya dentro de la carpeta del proyecto se corre ese comando.</p>
<p> Para el acceso a voyager, es necesario hacer login con un usuario de rol 1 (super admin) y acceder a cualquier ruta /root o irse a la esquina superior derecha y dar click en el usuario y despues en perfil. </p>
<p> El sistema en general no esta terminado para el uso del centro deportivo en el cual se esta proyectando usar a inicios del siguiente año, por lo cual puede a ver algunos modelos que no tengan implementacion, nos comio el tiempo :(, saludos.</p>


<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
