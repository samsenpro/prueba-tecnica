function capitalizar(palabra) {
    return palabra.charAt(0).toUpperCase() + palabra.slice(1);
}

function cargarTareas() {
    fetch('../controller/dashboard/dashboard-list.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.card-title[data-count="pendientes"]').textContent = data.conteo.pendientes;
            document.querySelector('.card-title[data-count="completadas"]').textContent = data.conteo.completadas;

            const tareasContainer = document.querySelector('.row.tareas');
            tareasContainer.innerHTML = '';

            if (data.tareas.length === 0) {
                tareasContainer.innerHTML = '<p>No hay tareas para mostrar.</p>';
                return;
            }

            data.tareas.forEach(tarea => {
                const prioridadCapitalizada = capitalizar(tarea.prioridad);
                const estadoCapitalizado = capitalizar(tarea.estado);

                const tareaCard = `
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${tarea.titulo}</h5>
                                <p class="card-text">${tarea.descripcion}</p>
                                <p class="card-text"><strong>Prioridad:</strong> ${prioridadCapitalizada}</p>
                                <p class="card-text"><strong>Estado:</strong> ${estadoCapitalizado}</p> <!-- Muestra el estado capitalizado -->
                                <button class="btn btn-primary" onclick="cambiarEstado(${tarea.id})">Marcar como Completada</button>
                            </div>
                        </div>
                    </div>
                `;
                tareasContainer.insertAdjacentHTML('beforeend', tareaCard);
            });
        })
        .catch(error => {
            console.error('Error al cargar tareas:', error);
        });
}


document.addEventListener('DOMContentLoaded', cargarTareas);



function cambiarEstado(id) {
    const estado = 'completada';

    fetch('../controller/dashboard/dashboard-update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id, estado: estado })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Estado actualizado exitosamente.');
            cargarTareas(); // Vuelve a cargar las tareas para reflejar los cambios
        } else {
            alert('Error al actualizar el estado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error al actualizar el estado:', error);
        alert('Error al actualizar el estado');
    });
}
