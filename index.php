<?php
  session_start();

  require 'database.php';
  $user = null;
  $name_1 = "Ana";
  $meess_1 = "Informacion de ultima Hora";
  $name_2 = "Roberto";
  $meess_2= "El mejor lugar para informarse sobre videojuegos";
  $name_3 = "Ricardo";
  $meess_3 = "Me encanta pokemon";
  $name_4 = "Liza";
  $meess_4 = "Death Stranding es raro";

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    

    if (count($results) > 0) {
      $user = $results;
    }
  }
  if(!empty($user) && !empty($_POST['mensaje'])){
    $sql = "INSERT INTO mensajes(nombre,mensaje) VALUES (:name,:mensaje)";
    $stmt = $conn->prepare($sql);
	$mensaje=$_POST['mensaje'];
    $stmt->bindParam(':mensaje', $mensaje);
	$name =$user['name'];
	$stmt ->bindParam(':name',$name);
    $stmt->execute();
     
  }
  $records = $conn->prepare("SELECT * FROM mensajes order by id desc");
  $records->execute();
  $cont=1;
  while($row=$records->fetch(PDO::FETCH_ASSOC)){
        if($cont == 1){
            $name_1 = $row['nombre'];
            $meess_1 = $row['mensaje'];
        }
        if($cont == 2){
            $name_2 = $row['nombre'];
            $meess_2 = $row['mensaje'];
        }
        if($cont == 3){
            $name_3 = $row['nombre'];
            $meess_3 = $row['mensaje'];
        }
        if($cont == 4){
            $name_4 = $row['nombre'];
            $meess_4 = $row['mensaje'];
        }
        $cont = $cont + 1;
  }


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- awesone fonts css-->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>JDF Game News</title>
    <style>

    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
        <div class="container"><a class="navbar-brand">JDF News</a>
            <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                    class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Acerca de</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contácto</a></li>
                </ul>

                <?php if(!empty($user)): ?>
                  <h1 > Welcome. <?= $user['name']; ?>
                  <a href="logout.php">
                    Logout
                  </a>
                <?php else: ?>
                  <form class="form-inline my-2 my-lg-0">
                      <a href="login.php" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">login or signup</a>
                  </form>
                <?php endif; ?>

            </div>
        </div>
    </nav>
    <div class="container-fluid gtco-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1> Nos comprometemos a
                        informarte sobre todo lo <span>nuevo</span> del
                        mundo de los videojuegos. </h1>
                    <p> Tu opinión es importante, dejanos un mensaje dando click al botán de abajo.</p>
                    <a href="#message">Dejar Mensaje <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                <div class="col-md-6">
                    <div class="card"><img class="card-img-top img-fluid" src="images/banner-img.svg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid gtco-feature" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="cover">
                        <div class="card">
                            <svg
                                    class="back-bg"
                                    width="100%" viewBox="0 0 900 700" style="position:absolute; z-index: -1">
                                <defs>
                                    <linearGradient id="PSgrad_01" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                        <stop offset="0%" stop-color="red" stop-opacity="1"/>
                                        <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                                    </linearGradient>
                                </defs>
                                <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_01)"
                                      d="M616.656,2.494 L89.351,98.948 C19.867,111.658 -16.508,176.639 7.408,240.130 L122.755,546.348 C141.761,596.806 203.597,623.407 259.843,609.597 L697.535,502.126 C748.221,489.680 783.967,441.432 777.751,392.742 L739.837,95.775 C732.096,35.145 677.715,-8.675 616.656,2.494 Z"/>
                            </svg>
                            <!-- *************-->

                            <svg width="100%" viewBox="0 0 700 500">
                                <clipPath id="clip-path">
                                    <path d="M89.479,0.180 L512.635,25.932 C568.395,29.326 603.115,76.927 590.357,129.078 L528.827,380.603 C518.688,422.048 472.661,448.814 427.190,443.300 L73.350,400.391 C32.374,395.422 -0.267,360.907 -0.002,322.064 L1.609,85.154 C1.938,36.786 40.481,-2.801 89.479,0.180 Z"></path>
                                </clipPath>
                                <!-- xlink:href for modern browsers, src for IE8- -->
                                <image clip-path="url(#clip-path)" xlink:href="images/learn-img.jpg" width="100%"
                                       height="465" class="svg__image"></image>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h2> Somos expertos en videojuegos
                         </h2>
                    <p> ¿Pokemon Sword o Pokemon Shield? Si aún no estás seguro de qué versión comprar, aquí están todos los Pokémon exclusivos y las grandes diferencias entre Sword y Shield.
                        </p>
                    <p>
                        <small>Cada nueva generación de Pokémon comienza con la misma pregunta: ¿Qué versión deberías obtener? Al igual que cada par de juegos de nueva generación anteriores, tanto Pokémon Sword como Shield ofrecen diferentes experiencias para los jugadores. Ninguno es tan drástico como las diferencias entre Pokémon Black y White , pero encontrarás diferentes Pokémon y encontrarás diferentes Gym Leaders dependiendo de la versión que juegues.
                        </small>
                    </p>
                    <a href="#">Saber Más <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            </div>
        </div>
    </div>
    <div class="container-fluid gtco-features" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2> Explora los temas<br/>
                        Que Te Ofrecemos</h2>
                    <p> JDFNews es la autoridad global en juegos de PC. Llevamos más de 20 años cubriendo los juegos de PC, y hoy continuamos con ese legado con ediciones impresas en todo el mundo y noticias, características, cobertura de deportes electrónicos, pruebas de hardware y reseñas de juegos las 24 horas del día en JDFNews.com, así como las principales publicaciones anuales. eventos que incluyen el PC Gaming Show en E3. </p>
                    <a href="#">All Services <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                <div class="col-lg-8">
                    <svg id="bg-services"
                         width="100%"
                         viewBox="0 0 1000 800">
                        <defs>
                            <linearGradient id="PSgrad_02" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                <stop offset="0%" stop-color="red" stop-opacity="1"/>
                                <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                            </linearGradient>
                        </defs>
                        <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_02)"
                              d="M801.878,3.146 L116.381,128.537 C26.052,145.060 -21.235,229.535 9.856,312.073 L159.806,710.157 C184.515,775.753 264.901,810.334 338.020,792.380 L907.021,652.668 C972.912,636.489 1019.383,573.766 1011.301,510.470 L962.013,124.412 C951.950,45.594 881.254,-11.373 801.878,3.146 Z"/>
                    </svg>
                    <div class="row">
                        <div class="col">
                            <div class="card text-center">
                                <div class="oval"><img class="card-img-top" src="images/web-design.png" alt=""></div>
                                <div class="card-body">
                                    <h3 class="card-title">PC Gamming</h3>
                                    <p class="card-text">Desde componentes hasta lo último en juegos para esta plataforma.</p>
                                </div>
                            </div>
                            <div class="card text-center">
                                <div class="oval"><img class="card-img-top" src="images/marketing.png" alt=""></div>
                                <div class="card-body">
                                    <h3 class="card-title">Nintendo</h3>
                                    <p class="card-text">Amado por muchos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-center">
                                <div class="oval"><img class="card-img-top" src="images/seo.png" alt=""></div>
                                <div class="card-body">
                                    <h3 class="card-title">Xbox</h3>
                                    <p class="card-text">Odiado por muchos.</p>
                                </div>
                            </div>
                            <div class="card text-center">
                                <div class="oval"><img class="card-img-top" src="images/graphics-design.png" alt=""></div>
                                <div class="card-body">
                                    <h3 class="card-title">PS4</h3>
                                    <p class="card-text">Amor-Odio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid gtco-numbers-block">
        <div class="container">
            <svg width="100%" viewBox="0 0 1600 400">
                <defs>
                    <linearGradient id="PSgrad_03" x1="80.279%" x2="0%"  y2="0%">
                        <stop offset="0%" stop-color="red" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(29,62,200)" stop-opacity="1" />

                    </linearGradient>

                </defs>
                <!-- <clipPath id="clip-path3">

                                          </clipPath> -->

                <path fill-rule="evenodd"  fill="url(#PSgrad_03)"
                      d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>

                <clipPath id="ctm" fill="none">
                    <path
                            d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>
                </clipPath>

                <!-- xlink:href for modern browsers, src for IE8- -->
                <image  clip-path="url(#ctm)" xlink:href="images/word-map.png" height="800px" width="100%" class="svg__image">

                </image>

            </svg>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">125</h5>
                            <p class="card-text">Articulos Creados</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">200M</h5>
                            <p class="card-text">Seguidores</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">530</h5>
                            <p class="card-text">Visitas por segundo</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">941</h5>
                            <p class="card-text">Empresas Afiliadas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid gtco-testimonials">
        <div class="container">
            <h2>Los Ultimos Mensajes</h2>
            <div class="owl-carousel owl-carousel1 owl-theme">
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/customer1.jpg" alt="">
                        <div class="card-body">
                            <h5><?= $name_1; ?> <br/>
                                 </h5>
                            <p class="card-text"><?= $meess_1; ?> </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/customer2.jpg" alt="">
                        <div class="card-body">
                            <h5><?= $name_2; ?><br/>
                                 </h5>
                            <p class="card-text"><?= $meess_2; ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/customer3.jpg" alt="">
                        <div class="card-body">
                            <h5><?= $name_3; ?><br/>
                                </h5>
                            <p class="card-text"><?= $meess_3; ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/customer3.jpg" alt="">
                        <div class="card-body">
                            <h5><?= $name_4; ?><br/>
                                </h5>
                            <p class="card-text"><?= $meess_4; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid gtco-news" id="news">
        <div class="container">
            <h2>Últimas Noticias</h2>
            <div class="owl-carousel owl-carousel2 owl-theme">
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/news1.jpg" alt="">
                        <div class="card-body text-left pr-0 pl-0">
                            <h5>Cyberpunk 2077 </h5>
                            <p class="card-text">Cyberpunk 2077 contará con una tecnología mucho más avanzada que con The Witcher 3 y un uso de esas herramientas más eficientes, asegura CD Projekt RED. El estudio polaco, que afronta ahora la recta final del desarrollo de su esperado nuevo videojuego, ha explicado en una entrevista con AusGamers cómo han renovado la transmisión de contenido.
                                . . . </p>
                            <a href="#">LEER MÁS <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/news2.jpg" alt="">
                        <div class="card-body text-left pr-0 pl-0">
                            <h5> Death Stranding </h5>
                            <p class="card-text">Durante la conferencia de Sony en la Electronic Entertainment Expo de 2016, Hideo Kojima describió el género del juego como un seudo-juego de acción, pero con elementos nuevos y diferentes. Lo comparó con el juego Metal Gear de 1987, que actualmente se considera como un videojuego de sigilo, pero que en aquel entonces fue catalogado como un juego de acción durante su lanzamiento debido a que el género de sigilo no existía.
                                . . . </p>
                            <a href="#">LEER MÁS <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="images/news3.jpg" alt="">
                        <div class="card-body text-left pr-0 pl-0">
                            <h5>Pokemon Sword/Shield</h5>
                            <p class="card-text">¡Si compras  Pokémon Sword  o  Pokémon Shield  antes del 15 de enero de 2020, puedes recibir un Gigantamax Meowth especial! *** A diferencia de otros que se encuentran en la región Galar, este Meowth puede Gigantamax para adquirir una apariencia imponente y alargada capaz de usar una poderosa apariencia G-Max Move! Este Meowth especial no puede evolucionar. Puede recibir este Meowth especial seleccionando la opción Obtener por Internet en Mystery Gift. ¡No te olvides de reclamar este Pokémon Scratch antes del 15 de enero de 2020!
                                . . . </p>
                            <a href="#">LEER MÁS <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="container-fluid" id="gtco-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" id="contact">
                    <h4 id="message"> Dejanos un mensaje </h4>
                    <form method="POST" action="index.php">
                        <input name="mensaje" class="form-control" type="text" placeholder="Message"></textarea>
                        <button class="submit-button">ENVIAR<i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <h4>JDFNews</h4>
                            <ul class="nav flex-column company-nav">
                                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Acerca De</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Noticias</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contácto</a></li>
                            </ul>
                            <h4 class="mt-5">Siguenos</h4>
                            <ul class="nav follow-us-nav">
                                <li class="nav-item"><a class="nav-link pl-0" href="#"><i class="fa fa-facebook"
                                                                                          aria-hidden="true"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-twitter"
                                                                                     aria-hidden="true"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-google"
                                                                                     aria-hidden="true"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-linkedin"
                                                                                     aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h4>Temas</h4>
                            <ul class="nav flex-column services-nav">
                                <li class="nav-item"><a class="nav-link" href="#">PC Gamming</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Nintendo</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Xbox</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">PS4</a></li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <p>&copy; 2019. All Rights Reserved. Design by <a href="https://gettemplates.co" target="_blank">GetTemplates</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- owl carousel js-->
    <script src="owl-carousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


  </body>
</html>
