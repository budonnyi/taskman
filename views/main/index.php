<?php
include(ROOT . '/views/layouts/header.php');
?>

<div class="container">
    <h4 class="text-center">Список задач</h4>
    <table class="table table-striped table-hover">

        <thead>
        <tr class="text-center">
            <th style="width: 25%;">Имя пользователя <a href="/index/user"><i
                            class="fa fa-sort-alpha-asc"></i></a></th>
            <th style="width: 20%;">Email <a href="/index/email"><i
                            class="fa fa-sort-alpha-asc"></i></a></th>
            <th style="width: 35%;">Текст задачи</th>
            <th style="width: 20%;">Статус <a href="/index/status"><i
                            class="fa fa-sort-alpha-asc"></i></a></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($taskList as $task) { ?>
            <tr style="<?php if ($task['status'] == 0) echo('color: #ccc'); ?>">
                <td class="vert-align"><?= $task['user'] ?></td>
                <td class="vert-align"><a href="mailto:<?= $task['email'] ?>"><?= $task['email'] ?></a></td>
                <td class="vert-align" style="overflow: hidden;"><?= substr($task['description'], 0, 130); ?></td>
                <td class="vert-align text-center"><?= ($task['status'] == 0) ? 'Отредактировано админом' : 'Активная'; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="row">
        <div class="mx-auto">
            <nav>
                <ul class="pagination">
                    <?php
                    $quantity = Task::getTaskQuantity();
                    for ($i = 1; $i <= ceil($quantity / 3); $i++) { ?>
                        <li class="page-item"><a class="page-link"
                                                 href="/index/<?= $_SESSION['filter'] ?>/page-<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>

    <?php if (empty($taskList)) { ?>
        <h2 class="text-center">Список задач пустой </h2>
    <?php } ?>

    <?php if (isset($_SESSION['notice']) && $_SESSION['notice']) { ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Задача люавлена</strong> Отображается в списке задач.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php unset($_SESSION['notice']) ?>
    <?php } ?>

    <style>

    </style>

    <div class="d-flex flex-row-reverse">
        <div class="">
            <button id="add-task" class="btn btn-success mb-4">Добавить новую задачу</button>
        </div>
    </div>

    <div id="add-block" class="hidden">

        <form id="form_id" method="post" action="/" onsubmit="return validate('form_id', 'email');">
            <div class="form-row">
                <div class="col-2">
                    <input id="user" name="user" type="text" class="form-control" placeholder="Имя пользователя"
                           value="<?= isset($_POST['user']) ? $_POST['user'] : '' ?>">
                </div>
                <div class="col-2">
                    <input id="email" name="email" type="text" class="form-control" placeholder="e-mail"
                           value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                </div>
                <div class="col">
                    <input id="description" name="description" type="text" class="form-control"
                           placeholder="Текст задачи"
                           value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>">
                </div>
                <div class="col-auto">
                    <button id="send" type="submit" class="btn btn-primary mb-2">Добавить</button>
                </div>
            </div>
        </form>

        <div id="result_form"></div>

    </div>
</div>

<script>
    $("#add-task").on('click', function () {
        $("#add-block").toggleClass('hidden');
    });
</script>

<script>
    //check email on user side
    function validate(form_id, email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var user = $("#user").val();
        var description = $("#description").val();
        var address = $("#email").val();

        console.log(user+address+description);

        if(address === '' || description === '' || user === '') {
            alert('Необходимо заполнить эвсе поля!');
            return false;
        }

        if (reg.test(address) == false) {
            alert('Введите корректный e-mail');
            return false;
        }
    }
</script>

<?php include(ROOT . '/views/layouts/footer.php'); ?>
