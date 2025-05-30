<?php
if (!isset($_SESSION)) {
    session_start();
}
function initializeTasks()
{
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
}

function submitTask()
{
    $_SESSION['tasks'][] = [
        'tarefa' => filterTask($_POST['task']),
        'concluida' => false,
        'prioridade' => filterTask($_POST['priority_task'])
    ];
    header('Location: index.php');
    exit;
}

function resetTasks()
{
    $_SESSION['tasks'] = [];
    header('Location: index.php');
    exit;
}

function excluirTask()
{
    unset($_SESSION['tasks'][$_POST['excluir']]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    header('Location: index.php');
    exit;
}

function toogleTaskConcluded()
{
        $_SESSION['tasks'][$_POST['concluir']]['concluida'] = !$_SESSION['tasks'][$_POST['concluir']]['concluida'];
        header('Location: index.php');
        exit;
}

function filterTask($task)
{
    $task = htmlspecialchars($task);
    $task = trim($task);
    $task = stripcslashes($task);
    return $task;
}

function showTaskPriority($priority)
{
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