<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="d-flex flex-column h-100">
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginLabel">Войти</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="auth">
                        @csrf
                        <input class="form-control mb-2" type="text" placeholder="e-mail" name="email">
                        <input class="form-control" type="password" placeholder="Пароль" name="pass"><br>
                        <button type="submit" class="btn btn-primary" name="auth">Войти</button>
                        <div id="error" style="display: none;">
                            <div class="alert alert-danger my-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpLabel">Регистрация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registration">
                        @csrf
                        <input class="form-control mb-2" type="text" placeholder="Имя" name="name" required>
                        <input class="form-control mb-2" type="email" placeholder="e-mail" name="email" required>
                        <input class="form-control mb-2" type="password" placeholder="Пароль" name="pass1" required>
                        <input class="form-control" type="password" placeholder="Повторите пароль" name="pass2" required><br>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                    <div id="notif" style="display: none;">
                        <div class="alert alert-success my-2"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><h2><a href="/" class="nav-link px-2 text-white">Интернет-магазин</a></h2></li>
                </ul>
                <div class="text-end">
                    @guest
                    <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#login">Войти</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUp">Регистрация</button>
                    @endguest

                    @auth
                    <a href="/cart" type="button" class="btn btn-success">
                        Корзина <span class="badge bg-dark" id="countCart">{{\App\Http\Controllers\CartController::countCart()}}</span>
                    </a>
                    <a href="/profile" class="btn btn-outline-light">Профиль</a>
                    <a href="{{route('logout')}}" class="btn btn-outline-danger">Выйти</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="container py-5">

            @yield('content')

        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Разработано специально для пар прекрасного преподавателя Сафарова Владислава Маратовича</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>