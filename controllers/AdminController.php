<?php
/**
 * Created by PhpStorm.
 * User: dmytrobudonnyi
 * Date: 10.10.2018
 * Time: 16:03
 */

class AdminController
{

    //action for admin page
    public function actionIndex($filter)
    {
        $taskList = Task::getAllTasks();
        require_once(ROOT . '/views/main/admin.php');
        return true;
    }

    //action to Done task with id = $id
    public function actionDone($id)
    {
        $taskList = Task::getAllTasks();
        Task::doneTaskById($id);

        header("Location: /admin/id");
        return true;
    }

    //action renew finished task
    public function actionRenew($id)
    {
        $taskList = Task::getAllTasks();
        Task::renewTaskById($id);

        header("Location: /admin/id");
        return true;
    }

    //action to update description for task with id = $id
    public function actionUpdate($id)
    {
        $taskToUpdate = Task::getTaskById($id);
        $taskList = Task::getAllTasks('id', 1);

        if (isset($_POST['submit'])) {
            $description = htmlspecialchars($_POST['description']);
            Task::updateDescriptionTaskById($id, $description);

            header("Location: /admin/id");
            return true;
        }

        require_once(ROOT . '/views/main/admin_update.php');
        return true;
    }

    //action to update description for task with id = $id
    public function actionDelete($id)
    {
        $taskToUpdate = Task::getTaskById($id);
        $taskList = Task::getAllTasks();

        Task::deleteTask($id);

        header("Location: /admin/id");
        return true;


        require_once(ROOT . '/views/main/admin_update.php');
        return true;
    }

    //action for Logout from Admin account
    public function actionLogout()
    {
        session_destroy();

        header("Location: /index/id");
        return true;
    }
}
