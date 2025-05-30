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
        $_SESSION['tasks'][$_POST['concluir']]['concluida'] = !$_SESSION['tasks'][$_POST['concluir']]['concluida'];
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

function elementColor($priority) {
    $cssClass = '';
    if ($priority == 'low') {
        $cssClass = 'low';
    } elseif ($priority == 'medium') {
        $cssClass = 'medium';
    } elseif ($priority == 'high') {
        $cssClass = 'high';
    }
    return $cssClass;
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
<div class="container">
    <form action="index.php" method="POST">
        Task: <input type="text" name="task">
        <input type="radio" id="baixa" name="priority_task" value="low" checked>
        <label for="baixa">baixa</label>
        <input type="radio" id="media" name="priority_task" value="medium">
        <label for="media">média</label>
        <input type="radio" id="alta" name="priority_task" value="high">
        <label for="alta">alta</label>
        <br>
        <br>
        <div class="buttons-add">
            <input type="submit" name="submit" value="Add">
            <input type="submit" name="reset" value="Reset">
        </div>
        <br>
        <ul>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li><div class="task-item">
                        <p class="item <?= elementColor($task["prioridade"]) ?> <?= $task['concluida']? 'concluido' : ''?>"><?= htmlspecialchars($task['tarefa'])  ?></p>
                        <div class="buttons-task">
                        <form action="index.php" method="POST">
                            <button type="submit" name="concluir" value="<?= $index ?>"><?= !$task['concluida'] ? 'finalizar tarefa' : 'não finalizada'?></button>
                            <button type="submit" name="excluir" value="<?= $index ?>">Excluir</button>
                        </form>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul
    </form>

</div>

</body>
</html>
