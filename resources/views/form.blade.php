<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBRTEC PETS</title>

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One&family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylepets.css') }}">
</head>
<body>
    <header class="border-bottom-1 shadow py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="index.html" title="KBR TEC" class="d-inline-block">
                        <h1>
                            <img src="{{ asset('img/logo.webp') }}" alt="KBR TEC" width="150">
                        </h1>
                    </a>
                </div>

                <div class="col-8">
                    <nav class="d-flex gap-4 align-items-center justify-content-end">
                        <a href="{{ route('index') }}">Home</a>
                        <a href="{{ route('adoption') }}">Quero Adotar</a>
                        <a href="{{ route('login.index') }}"class="btn btn-custom">Admin</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <nav aria-label="breadcrumb" class="p-3 bg-custom-light">
        <div class="container">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item fs-sm"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item fs-sm"><a href="{{ route('adoption') }}">Quero Adotar</a></li>
                <li class="breadcrumb-item fs-sm"><a href="" style="text-transform: uppercase">{{ $name }}</a></li>
                <li class="breadcrumb-item active fs-sm" aria-current="page">Formulário de Solicitação</li>
            </ol>
        </div>
    </nav>

    <section class="bg-light py-5">
        <div class="container mb-5">
            <h2 class="m-0 bowlby-one text-uppercase h5 text-center">Solicitação de adoção</h2>

            <p class="text-center">Preencha aqui os dados da pessoa interessada em adotar o animal selecionado:</p>

            <form action="{{ route('store') }}" method="POST" class="bg-custom rounded p-4 mt-4 col-6 mx-auto row">
                @csrf
                <div class="form-group py-2 col-12">
                    <label for="solicitante" class="text-capitalize text-light">Seu nome:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="form-group py-2 col-12">
                    <label for="animal" class="text-capitalize text-light">Nome <span class="text-lowercase">do</span> animal:</label>
                    <input type="text" class="form-control" name="pet" id="pet" style="text-transform: uppercase" value="{{ $name }}" readonly>
                </div>

                <div class="form-group py-2 col-6">
                    <label for="cpf" class="text-capitalize text-light">CPF:</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" maxlength="11">
                </div>

                <div class="form-group py-2 col-6">
                    <label for="email" class="text-capitalize text-light">E-mail:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>

                <div class="form-group py-2 col-6">
                    <label for="cel" class="text-capitalize text-light">Celular:</label>
                    <input type="text" class="form-control" name="telephone" id="telephone">
                </div>

                <div class="form-group py-2 col-6">
                    <label for="nascimento" class="text-capitalize text-light">Data <span class="text-lowercase">de</span> Nascimento:</label>
                    <input type="date" class="form-control" name="date_birth" id="date_birth">
                </div>

                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-12 d-flex justify-content-center mt-4">
                    <button class="btn btn-custom-2">Solicitar</button>
                </div>
            </form>
        </div>
    </section>

    <section class="bg-custom py-3" style="background-color: #FFECCE;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="d-flex flex-column align-items-end">
                    <h2 class="bowlby-one text-uppercase h4 m-0">Alguma dúvida?</h2>

                    <a href="#" class="btn btn-custom">Entre em contato</a>
                </div>
                <img src="{{ asset('img/cartoon-cat-3.webp') }}" alt="Gato" width="150">
            </div>
        </div>
    </section>

    <footer class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">
                    Copyright © 2023. Todos os direitos reservados
                </p>

                <a href="https://www.kbrtec.com.br/" target="_blank" title="Acesse o site da KBR TEC">
                    <img src="{{ asset('img/kbrtec.webp') }}" alt="KBRTEC" width="100">
                </a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>