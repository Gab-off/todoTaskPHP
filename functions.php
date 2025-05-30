<?php

function initializeTasks()
{
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
}

function submitTask($taskDescription, $priority)
{
    $_SESSION['tasks'][] = [
        'tarefa' => filterTask($taskDescription),
        'concluida' => false,
        'prioridade' => filterTask($priority)
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

function excluirTask($excluir)
{
    unset($_SESSION['tasks'][$excluir]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    header('Location: index.php');
    exit;
}

function toogleTaskConcluded($concluir)
{
        $_SESSION['tasks'][$concluir]['concluida'] = !$_SESSION['tasks'][$concluir]['concluida'];
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