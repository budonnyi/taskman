<?php
if ($_SESSION['user'] != 'admin') {
    header("Location: /index/id");
} ?>

<?php include(ROOT . '/views/layouts/header.php'); ?>

    <div class="container">
        <h4>Редактировать запись <?= $taskToUpdate['id'] ?></h4>
        <div class="row">
            <div class="col-md-6">
                <?php if (isset($taskToUpdate)) { ?>
                    <form action="" method="POST" class="form-group">
                        <textarea class="form-control" name="description"
                                  rows="8"><?= $taskToUpdate['description'] ?></textarea>
                        <button type="submit" name="submit" class="btn btn-primary margines">
                            Update
                        </button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

<?php include(ROOT . '/views/layouts/footer.php'); ?>
