<?php

if ($_SESSION['user'] != 'admin') {
    header("Location: /index/id");
}

?>

<?php include(ROOT . '/views/layouts/header.php'); ?>

<div class="modal fade" id="modalUpdateModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div id="modal-content" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Редактировать задачу </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="" method="post" class="form-group">
                        <textarea class="form-control" name="description"
                                  rows="8">
                        </textarea>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <h4 class="text-center">Список задач</h4>
    <table style="table-layout: fixed; width: 100%;" class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th style="width: 20%;" class="col-1"> Имя пользователя</th>
            <th style="width: 20%;" class="col-1"> Email</th>
            <th style="width: 35%;" class="col-4"> Текст задачи</th>
            <th style="width: 10%;" class="col-1"> Ред</th>
            <th style="width: 15%;" class="col-1"> Статус</th>
        </tr>
        </thead>

        <tbody>

        <?php if (!empty($taskList)) { ?>
            <?php foreach ($taskList as $task) { ?>
                <tr style="<?php if ($task['status'] == 0) echo('color: #ccc'); ?>">
                    <td class="vert-align"><?= $task['user'] ?></td>
                    <td class="vert-align"><?= $task['email'] ?></td>
                    <td class="vert-align" style="overflow: hidden;"><?= $task['description'] ?></td>
                    <td class="vert-align text-center">
                        <a class="update-record" href="/admin/update/<?= $task['id'] ?>" data-id="<?= $task['id'] ?>">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="vert-align text-center">
                        <?= ($task['status'] == 0) ?
                            ('<a href="/admin/done/' . $task['id'] . '"><i class="fa fa-check-square fa-lg"></i></a>') :
                            ('<a href="/admin/renew/' . $task['id'] . '"><i class="fa fa-square-o fa-lg"></i></a>') ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <h4>Список пуст</h4>
        <?php } ?>

        </tbody>

    </table>

    <?php if (empty($taskList)) {
        echo 'Список пуст.';
    }
    ?>

</div>

<?php include(ROOT . '/views/layouts/footer.php'); ?>

<script>
    // $('.update-record').on('click', function (e) {
    //
    //     e.preventDefault();
    //
    //     var id = $(this).attr('data-id');
    //
    //     console.log(id);
    //
    //     $.ajax({
    //         type: 'GET',
    //         url: '/admin/update/' + id,
    //     }).done(function (data) {
    //         $("#modalUpdateModal").modal('show');
    //         $("#modal-content").html(data);
    //     }).fail(function () {
    //         alert('Чтото пошло не так');
    //     });
    //
    // });
</script>
