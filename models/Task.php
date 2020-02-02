<?php
/**
 * Created by PhpStorm.
 * User: dmytrobudonnyi
 * Date: 10.10.2018
 * Time: 15:55
 */

class Task
{

    //get paginated task list
    public static function getTasks($filter, $page = 1)
    {
        $db = Db::getConnection();

        $pages = 3;
        $offset = ($page - 1) * $pages;

            $filter = $_SESSION['filter'];

        $sql = "SELECT * FROM tasks ORDER BY {$filter} {$_SESSION['desc']} LIMIT {$pages} OFFSET {$offset}";

        $taskList = array();

        $result = $db->query($sql);
        $i = 0;

        while ($row = $result->fetch()) {
            $taskList[$i] = $row;
            $i++;
        }

        return $taskList;
    }

	//get Tasklist for admin side
    public static function getAllTasks()
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM tasks";

        $result = $db->query($sql);
        $i = 0;
		$taskList = array();
        while ($row = $result->fetch()) {
            $taskList[$i] = $row;

            $i++;
        }
        return $taskList;
    }

    public static function getTaskQuantity()
    {
        $db = Db::getConnection();
        $sql = "SELECT count(*) FROM tasks";

        $result = $db->query($sql)->fetch();

        $quantity = (int)$result[0];

        return $quantity;
    }

    //get only one needed task by ID
    public static function getTaskById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM tasks WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    //set done label to needed task by ID
    public static function doneTaskById($id)
    {
        $_SESSION['user'] = 'admin';

        $db = Db::getConnection();
        $sql = 'UPDATE tasks SET status = 1 WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    //renew finished label to needed task by ID
    public static function renewTaskById($id)
    {
        $_SESSION['user'] = 'admin';

        $db = Db::getConnection();
        $sql = 'UPDATE tasks SET status = 0 WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }


    //create task with loaded parameters
    public static function createTask($user, $email, $description, $status)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO tasks (
                    user,
                    email,
                    description,
                    status)
                VALUES (
                    :user,
                    :email,
                    :description,
                    :status)';

        $result = $db->prepare($sql);

        $result->bindParam(':user', $user, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        $result->execute();

        return true;
    }

    //update description for needed task
    public static function updateDescriptionTaskById($id, $description)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE tasks SET description = :description WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':description', $description, PDO::PARAM_STR);

        return $result->execute();
    }

    //delete needed task
    public static function deleteTask($id)
    {
        $db = Db::getConnection($id);
        $sql = 'DELETE FROM tasks WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }
}
