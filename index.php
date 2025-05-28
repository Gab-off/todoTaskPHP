<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (!empty($_POST['task'])) {
            $_SESSION['tasks'][] = [
                    'tarefa' => filterTask($_POST['task']) ,
                    'concluida' => false,
                    'prioridade' => filterTask($_POST['priority_task'])
            ];
            header('Location: index.php');
            exit;
        }
    } elseif (isset($_POST['reset'])) {
        $_SESSION['tasks'] = [];
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['excluir'])) {
        unset($_SESSION['tasks'][$_POST['excluir']]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']);
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['concluir'])) {
        $_SESSION['tasks'][$_POST['concluir']]['concluida'] = true;
        header('Location: index.php');
        exit;
    }

}


function filterTask($task) {
    $task = htmlspecialchars($task);
    $task = trim($task);
    $task = stripcslashes($task);
    return $task;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-do-list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="index.php" method="POST">
    Task: <input type="text" name="task">
    <input type="radio" id="baixa" name="priority_task" value="baixa" checked>
    <label for="baixa">baixa</label>
    <input type="radio" id="media" name="priority_task" value="media">
    <label for="media">média</label>
    <input type="radio" id="alta" name="priority_task" value="alta">
    <label for="alta">alta</label>
    <br>
    <br>
    <input type="submit" name="submit" value="Add">
    <input type="submit" name="reset" value="Reset">
    <br>
    <ul>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
        <li><p class="<?= $task['concluida']? 'concluido' : ''?>"><?= htmlspecialchars($task['tarefa'])  ?></p>
                <form action="index.php" method="POST">
                    <button class="<?= $task['concluida']? 'displayNone' : '' ?>" type="submit" name="concluir" value="<?= $index ?>">Concluir</button>
                    <button type="submit" name="excluir" value="<?= $index ?>">Excluir</button>


                </form>
        </li>
        <?php endforeach; ?>
    </ul
</form>
</body>
</html>
