<?php
session_start();

require_once 'functions.php';
require_once 'handle_post.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-do-list</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
    <form id="taskForm" action="index.php" method="POST">
        <input id="taskText" type="text" name="task" placeholder="Insert your task here">
<!--        TODO: verificar onde colocar isso na hora que a task vai para a view-->
<!--        <div class="priority-level">-->
<!--            <input type="radio" id="baixa" name="priority_task" value="low" checked>-->
<!--            <label for="baixa">baixa</label>-->
<!--            <input type="radio" id="media" name="priority_task" value="medium">-->
<!--            <label for="media">média</label>-->
<!--            <input type="radio" id="alta" name="priority_task" value="high">-->
<!--            <label for="alta">alta</label>-->
<!--        </div>-->
            <input id="submitButton" type="submit" name="submit" value="ADD">

<!--            TODO: retirar o submit-->
<!--            <input type="submit" name="reset" value="Reset">-->
    </form>
        <br>
        <ul>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li><div class="task-item">
                        <p class="item <?= showTaskPriority($task["prioridade"]) ?> <?= $task['concluida']? 'concluido' : ''?>"><?= htmlspecialchars($task['tarefa'])  ?></p>
                        <div class="buttons-task">
                        <form class="taskActionButtonsForm" action="index.php" method="POST">
                            <button type="submit" name="concluir" value="<?= $index ?>"><?= !$task['concluida'] ? 'finalizar tarefa' : 'não finalizada'?></button>
                            <button class="delete" type="submit" name="excluir" value="<?= $index ?>">Excluir</button>
                        </form>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul

</div>

<script src="script.js"></script>
</body>
</html>
