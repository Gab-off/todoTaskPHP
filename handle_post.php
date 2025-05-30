<?php
require_once 'functions.php';

initializeTasks();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['submit'])) {
        if(!empty($_POST['task'])) {
            submitTask($_POST['task'], $_POST['priority_task']);
        }
    } elseif(isset($_POST['reset'])) {
        resetTasks();
    } elseif(isset($_POST['excluir'])) {
        excluirTask($_POST['excluir']);
    } elseif(isset($_POST['concluir'])) {
        toogleTaskConcluded($_POST['concluir']);
    }
}