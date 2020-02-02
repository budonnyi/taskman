<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Приложение "Задачник"</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/web/css/stylesheet.css<?php time() ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<?php if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin') { ?>
    <div class="container">
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEntry">
                    Войти
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEntry" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Вход в админку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="enter-form" method="post" action="/">
                        <div id="result_form"></div>
                        <span class="text-danger"><?= $_SESSION['error'] ?></span>
                        <div class="form-group">
                            <label for="login">Имя пользователя</label>
                            <input type="text" class="form-control" id="login" name="login">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button id="submit" type="submit" class="autorize btn btn-primary">Войти</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="container">
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a href="/admin/logout" class="btn btn-warning back"> Выйти <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $(function () {
        $('#submit').on('click', function (e) {

            // e.preventDefault();

            var login = $('#login').val();
            var password = $('#password').val();

            console.log(login);

            $.ajax({
                type: 'POST',
                url: '/',
                data: {
                    login: login,
                    password: password
                },
            }).done(function () {
                // $('#result_form').html(error);
                // alert('sent');
                // $('.popup-close').click();
            }).fail(function () {
                $('#result_form').html("Неверный логин или пароль");
            });

        });
    });
</script>
