function Itm(id){
    return document.getElementById(id);
}

function guardarTarea() {
    const idTarea = Itm('idTarea').value; // Obtén el ID de la tarea
    const titulo = Itm('titulo').value;
    const descripcion = Itm('descripcion').value;
    const prioridad = Itm('prioridad').value;

    const data = {
        idTarea: idTarea,
        titulo: titulo,
        descripcion: descripcion,
        prioridad: prioridad
    };

    const url = idTarea ? '../controller/crud/tareas-update.php' : '../controller/crud/tareas-save.php';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log(response);
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            alert('Tarea ' + (idTarea ? 'actualizada' : 'guardada') + ' exitosamente');
            Itm('tareaForm').reset();
            Itm('idTarea').value = '';
        } else {
            alert('Error al ' + (idTarea ? 'actualizar' : 'guardar') + ' la tarea: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al ' + (idTarea ? 'actualizar' : 'guardar') + ' la tarea');
    });
}


function cargarTareas() {
    fetch('../controller/crud/tareas-list.php')
    .then(response => response.json())
    .then(data => {
        const theader = Itm('tareasTableHead');
        const tbody = Itm('tareasTableBody');

        theader.innerHTML = '';
        const rowHead = document.createElement('tr');
        rowHead.innerHTML = `
        <th>Titulo</th>
        <th>Descripción</th>
        <th>Prioridad</th>
        <th>Estado</th>
    `;

    theader.appendChild(rowHead);


        tbody.innerHTML = '';

        data.tareas.forEach(tarea => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${tarea.titulo}</td>
                <td>${tarea.descripcion}</td>
                <td>${tarea.prioridad}</td>
                <td>${tarea.estado}</td>
                <td>
                    <button class="btn btn-primary" onclick="seleccionarTarea(${tarea.id})">Seleccionar</button>
                </td>
            `;

            tbody.appendChild(row);
        });
    })
    .catch(error => console.error('Error al cargar tareas:', error));
}

function seleccionarTarea(idTarea) {
    fetch(`../controller/crud/tareas-get.php?id=${idTarea}`)
    .then(response => {
        return response.text().then(text => {
            console.log(text);
            return JSON.parse(text);
        });
    })
    .then(tarea => {
        if (tarea.error) {
            console.error(tarea.error);
            alert(tarea.error);
            return;
        }

        Itm('idTarea').value = tarea.id || '';
        Itm('titulo').value = tarea.titulo || '';
        Itm('descripcion').value = tarea.descripcion || '';
        Itm('prioridad').value = tarea.prioridad || '';
        Itm('estado').value = tarea.estado || '';

        const modal = bootstrap.Modal.getInstance(Itm('tareaModal'));
        modal.hide();
    })
    .catch(error => console.error('Error al seleccionar la tarea:', error));
}


function eliminarTarea() {
    const idTarea = Itm('idTarea').value;

    if (!idTarea) {
        alert('Por favor selecciona una tarea para eliminar.');
        return;
    }

    const data = {
        idTarea: idTarea
    };

    fetch('../controller/crud/tareas-delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Tarea eliminada exitosamente');
            Itm('tareaForm').reset();
        } else {
            alert('Error al eliminar la tarea: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar la tarea');
    });
}

