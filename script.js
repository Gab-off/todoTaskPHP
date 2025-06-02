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
        button.addEventListener('click', async function (e) {
            const indexTask = button.dataset.taskIndex;
            const priorityPriority = button.dataset.priority;

            try {
            const response = await fetch("requests.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },

                body: new URLSearchParams({
                    index: indexTask,
                    priority: priorityPriority,

                })

            });

            if (!response.ok) {
                throw new Error(`Erro de rede ou servidor: ${response.status} - ${response.statusText}`);
            }

            const data = await response.json();
            if (data.status === "ok") {
                const classesParaRemover = ['low', 'medium', 'high'];

                button.classList.remove(...classesParaRemover); // Usa o spread para clareza

                button.classList.add(data.new_priority); // Tenta adicionar a nova classe
                button.dataset.priority = data.new_priority;


            } else {
                console.error("Erro do servidor:", data.status);
                alert("Erro ao atualizar a prioridade: " + data.status);
            }

            } catch (error) {
                console.error("Erro na requisição Fetch:", error);
                alert("Não foi possível conectar ou houve um erro: " + error.message);
            }

        })
    }
)

deleteButton.forEach((button) => {
    button.addEventListener('click', function (e) {
        let confirmation = confirm("Deseja realmente excluir a tarefa?");
        if (!confirmation) {
            e.preventDefault();
        }
    })
})

