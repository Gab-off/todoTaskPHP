const taskForm = document.getElementById("taskForm");
const taskText = document.getElementById("taskText");
const deleteButton = document.querySelectorAll('.delete');
const spanButtons = document.querySelectorAll('.spanPriority');

if (taskForm) {
    taskForm.addEventListener('submit', function (e) {
        const taskValue = taskText.value.trim();
        if (taskValue === "" && e.submitter.name === "submit") {
            alert("Por favor, digite uma tarefa antes de adicionar!");
            e.preventDefault();
        }
    })
}

spanButtons.forEach((button) => {
    button.addEventListener('click', function (e) {
        const indexTask = button.getAttribute('data-task-index');
        const priorityPriority = button.getAttribute('data-priority');

        const response = await fetch()
    })
})

deleteButton.forEach((button) => {
    button.addEventListener('click', function (e) {
        let confirmation = confirm("Deseja realmente excluir a tarefa?");
        if (!confirmation) {
            e.preventDefault();
        }
    })
})

