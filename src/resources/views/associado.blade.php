<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->


    <!-- Custom fonts for this template -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    @vite('resources/css/creative.css')

    <!-- owl.carousel css -->
    @vite('resources/css/owl.carousel.min.css')
    @vite('resources/css/owl.theme.default.min.css')'
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @vite('resources/js/validations.js')
    <style>
        .logoTopoBranca, .logoTopo {
            background-color: transparent !important;
            margin-top:10px;
            width:185px
        }

        #mainNav.navbar-shrink {
        /* background-color: rgba(255, 255, 255, 0.85) */
        }

        .btn {
            border-radius: 2rem !important;
        }
    </style>

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="/img/logoTopo.png" class="logoTopo" alt="">
            <img src="/img/logoTopo.png"  class="logoTopoBranca" alt="">
          </a>
          <button class="navbar-toggler navbar-toggler-right" style="background:#105CAB" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#about">Sobre A VOTAÇÃO</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#resultados">Resultado de 2018</a>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#resultados2021">Resultado de 2021</a>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#about" target="_blank">Instruções</a>
              </li> -->

              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#principal">VOTE AGORA</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#clientes">ENTIDADES</a>
              </li> -->

            </ul>
          </div>
        </div>
      </nav>

    <header class="masthead text-center text-white d-flex" id="home">

        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <br><br><br><br>
                    <h1 class="text-uppercase" style="font-size:40px" >
                        <strong data-votacao></strong>
                    </h1>
                    <hr>
                </div>
                <div class="col-lg-8 mx-auto">

                    <p class="text-faded mb-5" data-subtitle>
                        Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim
                        labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet.</p>

                    <a
                        class="btn btn-primary btn-lg js-scroll-trigger"
                        href="#about"
                        style="background: #ffcc28; border:0px solid #E9EAEC; color:#3e487e"
                    >
                        <span class="fa fa-file"></span> SOBRE A VOTAÇÃO
                    </a>

                    <BR><BR>
                    <a
                        class="btn btn-primary btn-lg js-scroll-trigger"
                        href="#principal"
                        style="background: #ffcc28; border:0px solid #E9EAEC; color:#3e487e"
                    >
                        <span class="fa fa-check"></span> VOTAR AGORA
                    </a>

                    <!-- <BR><BR>
               <p>VOTAÇÃO ENCERRADA!</p> -->
                </div>
            </div>
        </div>
    </header>

    <section class="" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h2 class="section-heading " style="color:#0E4985">
                        <!-- <img src="img/icone-users.png" width="100px" style=" margin-bottom:22px">  -->
                        <!-- <i class="fa fa-users fa-2x  sr-contact" style="color:#0E4985; margin-bottom:22px"></i> -->
                        <br>SOBRE A VOTAÇÃO
                    </h2>
                    <hr class="light my-4" style="border:1px solid #ffcc28">

                    <p style="font-size:18px; color:gray; line-height:30px" data-description>Lorem ipsum dolor sit amet, officia
                        excepteur ex fugiat reprehenderit enim
                        labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi
                        animcupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est
                        aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia
                        pariatur ut officia.
                    </p><BR>

                    <!-- <a class="btn btn-primary btn-xl js-scroll-trigger" href="edital_lista_triplice_2022.pdf" target="_blank">Edital nº 01/2022 <span class="fa fa-file"></span></a> -->
                    <!-- <a class="btn btn-primary btn-xl js-scroll-trigger" href="edital_lista_triplice_2021-2.pdf" target="_blank">Edital nº 02/2021 <span class="fa fa-file"></span></a> -->

                    <div data-links="arquivos"></div>

                    <div class="col-md-12 hidden-lg hidden-md hidden-sm " style="margin-bottom:10px"></div>
                    <a class="btn btn-primary btn-lg js-scroll-trigger" href="#principal" style="background-color:#ffcc28; color:#3e487e; border:none;">INICIE A VOTAÇÃO <span class="fa fa-check"></span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0" style="background: white">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br><br><br>
                    <h2 class="section-heading " style="color:#0E4985">VOTE AGORA</h2>
                    <hr class="my-4" style="border:1px solid #ffcc28;">

                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row  " style="margin:0 auto; text-align:center">

                <p class="text-faded ">FAÇA SEU LOGIN</p>

                <div class="col-md-12"
                    style="background-color:#105CAB; border-radius:8px; padding:10px; margin-top:-30px">
                    <!-- <h4>SEGUNDA FASE</h4> -->
                    <p style="font-size:14px; color:white; text-align:center"><b>INSTRUÇÕES:</b><br><br> Caro(a) filiado(a), no quadro abaixo,
                        digite o seu CPF para validar o acesso ao painel de votação. Em seguida, clique no botão Entrar.</p>
                </div>

                <div id="principal" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="absolute flex items-top justify-center alert alert-danger m-0" data-erro="votacao"
                        role="alert" style="display:none;">
                        A simple warning alert—check it out!
                    </div>

                    <div id="associados-box" class="grid grid-cols-1 md:grid-cols-1">
                        <div style="margin-top:20px; text-align:center; margin:0 auto; margin-top:20px" class="p-2">
                            <div class="form-group mb-3">
                                <h3 data-votacao></h3>
                                <input
                                    id="cpf" maxlength="11"
                                    style="text-align: center"
                                    placeholder="Digite seu CPF"
                                    required="required"
                                    name="cpf"
                                    type="text"
                                    class="form-control form-control-lg"
                                >
                              <span data-erro="cpf" class="small text-danger"></span>
                            </div>
                            <button
                                id="entrar"
                                type="submit"
                                class="btn btn-primary btn-lg"
                                style="border:3px solid #ffcc28; background-color:#ffcc28; color:#3e487e"
                            >
                                <span id="spinner-entrar" class="spinner-border spinner-border-sm"style="display:none;"></span>
                                ENTRAR
                            </button>
                        </div>
                    </div>
                    <div class="votacao-box grid grid-cols-1 md:grid-cols-2" style="display:none;">
                        <div class="p-6">
                            <div class="flex items-center icon-votacao">
                                <img src="{{ URL::asset('icons/votacao.png') }}" class="w-8 h-8 text-gray-500" />
                                <div data-votacao="nome-votacao" class="ml-4 text-lg leading-7 font-semibold">
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                        </div>
                    </div>
                    <div class="votacao-box grid grid-cols-1 md:grid-cols-1" style="display:none;">
                        <div class="p-6">
                            <div id="associado" class="grid items-center">
                            </div>
                        </div>
                        <div class="p-6">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br><br><br>
    </section>

    <div class="modal fade" id="gabarito" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confira sua escolha e confirme</h4>
                </div>
                <div class="modal-body">
                    <div id="escolhas">

                    </div>
                    <label for="email" class="form-label">Informe um email para receber o seu comprovante:</label>
                    <input id="email" type="email" class="form-control" placeholder="E-mail"
                        aria-describedby="emailHelp">
                    <!--
                    <div id="emailHelp" class="form-text">
                        Caso queira, você pode informar um outro e-mail para receber o seu comprovante.
                    </div>
                    -->
                </div>
                <div class="modal-footer">
                    <button id="voltar" type="button" class="btn btn-danger close"
                        data-dismiss="modal">Voltar</button>
                    <button id="confirmar" type="button" class="btn btn-success" data-dismiss="modal">
                        <span id="spinner-confirmar" class="spinner-border spinner-border-sm"
                            style="display:none;"></span>
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-comprovante" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Comprovante</h4>
                </div>
                <div class="modal-body">
                    <div id="comprovante">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="encerrar" type="button" class="btn btn-primary"
                        data-dismiss="modal">Encerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class=" text-white" style="height:100px; background-color:#0E4985">
        <div class="container text-center">
            <p style="font-size:13px; padding-top:40px; ">TODOS OS DIREITOS RESERVADOS</P>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    @vite('resources/js/creative.js')

    <!-- owl.carousel js -->
    @vite('resources/js/owl.carousel.min.js')

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
    </script>

</body>

</html>
