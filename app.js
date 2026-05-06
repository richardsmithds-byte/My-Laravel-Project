setTimeout(() => {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
    }
}, 3000);

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.done-btn').forEach(button => {
        button.addEventListener('click', function (event) {

            event.preventDefault(); // IMPORTANT

            let taskId = this.getAttribute('data-id');

            fetch(`/tasks/${taskId}/done`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {

                    let form = this.closest('form');

                    if (form) {
                        form.classList.add('opacity-50');
                    }


                    let row = this.closest('.list-group-item');

                        if (row) {
                            row.classList.add('opacity-50');
                    
                    let taskName = row.querySelector('.task-name');

                        if (taskName) {
                            taskName.classList.add('text-decoration-line-through');
                            taskName.classList.add('text-success');
            }
        }

                    this.disabled = true;
                    this.innerText = 'Done';

                    console.log(data.message);
                }
            });

        });
    });

});