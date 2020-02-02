<?php

class MainController
{
    //main action for user show tasks with needed filter
    public function actionIndex($filter = 'id', $page = '1')
    {
        if (!$filter) {
            $filter = 'id';
        }

        $_SESSION['filter'] = $filter;
        $_SESSION['desc'] = $_SESSION['desc'] == 'ASC'?'DESC':'ASC';

        $taskList = Task::getTasks($filter, $page);

        if ((!empty($_POST['user'])) &&
            (!empty($_POST['email'])) &&
            (!empty($_POST['description']))) {

            //email validation on php - email or invalid emeil to DB
            $email = (filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL)) ?
                htmlspecialchars($_POST['email']) : "invalid e-mail";

            //create task and save it to DB
            Task::createTask(
                htmlspecialchars($_POST['user']),
                $email,
                htmlspecialchars($_POST['description']),
                1);

            //send user to main page
            header("Location: /index/id");
            return true;
        }

        //login user throw login form
        if (isset($_POST['login'], $_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if (htmlspecialchars($_POST['login']) !== 'admin'
                || htmlspecialchars($_POST['password']) !== '123') {
                $_SESSION['error'] = 'Неверный логин или пароль';
                $errorEnter = 'Неверный логин или пароль';
                unset($_POST);
            } else {
                $_SESSION['user'] = 'admin';
                $taskList = Task::getAllTasks();
                require_once(ROOT . '/views/main/admin.php');
                return true;
            }
        }

        require_once(ROOT . '/views/main/index.php');
        return true;
    }

}
