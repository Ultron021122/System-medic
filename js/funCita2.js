const eliminar = (id) =>{
    Swal.fire({
    title: 'Estas seguro de eliminar el registro',
    text: "Ya no se podrá recuperar el registro",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = "./model/consultasCita.php";
            var formdata = new FormData();
            formdata.append('tipo_operacion', 'eliminar');
            formdata.append('id', id);
            fetch(url, {
                method: 'post',
                body: formdata
            }).then(data => data.json())
            .then(data => {
                // console.log('Success:', data);
                pintar_tabla_resultados(data);
                Swal.fire(
                'Eliminado', 
                'El registro se elimino correctamente.',
                'success'
                )
            })
            .catch(error => console.error('Error:', error));
           
        }
    })
}

const pintar_tabla_resultados = (data) =>{
    let tab_datos = document.querySelector("#tabla-cita");
    tab_datos.innerHTML = "";
    for(let item of data){
        tab_datos.innerHTML +=`
            <tr>
                <td scope="row">${item.ID}</td>
                <td>${item.Fecha}</td>
                <td>${item.Hora}</td>
                <td>${item.Nombre_paciente} ${item.Apellidos_paciente}</td>
                <td>${item.Nombre_medico} ${item.Apellidos_medico}</td>
                <td>${item.Motivo}</td>
                <td>
                    <button class='btn btn-info btn-sm' onclick='editar(${item.ID});'><i class='fa-solid fa-pen-to-square sizeSimbol'></i></button>
                </td>
                <td>
                    <button class='btn btn-danger btn-sm' onclick='eliminar(${item.ID});'><i class='fa-solid fa-delete-left sizeSimbol'></i></button>
                </td>
            </tr>
        `;
    }
}

const editar = (id) => {
    //alert(id);
    var url = "./model/consultasCita.php";
    var formData = new FormData();
    formData.append('tipo_operacion','editar');
    formData.append('id',id);
    fetch(url,{
        method:'post',
        body:formData
    })
    .then(data => data.json())
    .then(data => {
        // Cargar datos a actualizar
        for(let item of data){
            var ID = item.ID;
            var Fecha = item.Fecha;
            var Hora = item.Hora;
            var Nombre_paciente = item.Nombre_paciente;
            var Nombre_medico = item.Nombre_medico;
            var Apellidos_paciente = item.Apellidos_paciente;
            var Apellidos_medico = item.Apellidos_medico;
            var Motivo = item.Motivo;
            var Paciente_ID = item.Paciente_ID;
            var Medico_ID = item.Medico_ID;
            var Recepcionista_ID = item.Recepcionista_ID;
        }
        var horarios = ["09:00:00", "09:20:00", "09:40:00", "10:00:00", "10:20:00", "10:40:00", "11:00:00", "11:20:00", "11:40:00", "12:00:00", "12:20:00", "12:40:00", "13:00:00", "13:20:00", "13:40:00", "14:00:00", "14:20:00", "14:40:00", "15:00:00", "15:20:00", "15:40:00", "16:00:00", "16:20:00", "16:40:00", "17:00:00", "17:20:00", "17:40:00", "18:00:00", "18:20:00"];
        var hora;
        horarios.forEach(function(tiempo){
            if (tiempo == Hora) {
                hora += `<option value="${Hora}" selected>${Hora}</option>`;
                console.log('Hora', Hora)
            } else {
                hora += `<option value="${tiempo}">${tiempo}</option>`;
            }
        })
        var url = "./model/consultasMedico.php";
        var buscar = new FormData();
        buscar.append('tipo_operacion','mostrar');
        fetch(url, {
            method: 'post',
            body: buscar
        })
        .then(info => info.json())
        .then(info =>{
            var medicos;
            console.log('Success', info);
            for(let temp of info){
                if (Medico_ID == temp.ID) {
                    medicos += `<option value="${Medico_ID}" selected>${Nombre_medico} ${Apellidos_medico}</option>`;
                } else {
                    medicos += `<option value="${temp.ID}">${temp.Nombre} ${temp.Apellidos}</option>`;
                }
            }
            Swal.fire({
                title: 'Actualizar información',
                html: `
                  <form id="update_form" class="text-start">
                    <input type="text" value="update" name="tipo_operacion" hidden="true">
                    <!-- ID del recepcionista -->
                    <input type="number" value="${ID}" hidden="true" name="ID" class="form-control">
                    <input type="number" value="${Recepcionista_ID}" hidden="true" name="Recepcionista_ID" class="form-control">
                    <hr>
                    <div class="form-group row">
                        <label for="Fecha" class="col-sm-3 col-form-label">Fecha</label>
                        <div class="col-sm-9">
                            <input type="date" value="${Fecha}" name="Fecha" id="Fecha" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Hora" class="col-sm-3 col-form-label">Hora</label>
                        <div class="col-sm-9">
                            <select name="Hora" id="Hora" class="form-control" required>
                                ${hora}
                            </select>    
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="NombreM" class="col-sm-3 col-form-label">Médico</label>
                        <div class="col-sm-9">
                            <select name="NombreM" id="NombreM" class="form-control" required>
                                ${medicos}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="NombreP" class="col-sm-3 col-form-label">Paciente</label>
                        <div class="col-sm-9">
                            <select name="NombreP" id="NombreP" class="form-control" required>
                                <option value="${Paciente_ID}" class="form-text" selected>${Nombre_paciente} ${Apellidos_paciente}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Motivo" class="col-sm-3 col-form-label">Motivo</label>
                        <div class="col-sm-9">
                            <input type="text" value="${Motivo}" name="Motivo" class="form-control" required>
                        </div>
                    </div>
                </form>  
                
                `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
                }).then((result) => {
                if (result.value) {
                    const datos = document.querySelector("#update_form");
                    const datos_actualizar = new FormData(datos);
                    var url = "./model/consultasCita.php";
                    fetch(url, {
                        method: 'post',
                        body: datos_actualizar
                    })
                    .then(data => data.json())
                    .then(data =>{ 
                        console.log('Success:', data);
                        if(data == "existe"){
                            Swal.fire(
                                '¡Error!',
                                'Ya existe una cita.',
                                'error'
                            )
                        } else if (data == "ocurrio") {
                            Swal.fire(
                                '¡Ocurrio un error!',
                                'No se pudo completar la tarea.',
                                'error'
                            )
                        } else {
                            pintar_tabla_resultados(data);
                            Swal.fire(
                                'Exito',
                                'Se actualizo con exito',
                                'success'
                            )
                        } 
                    })
                    .catch(function(error){
                        console.error('Error:', error)
                    }); 
                }
            })
        })             
    })
    .catch(function (error){
        console.error('error',error);
    }); 
}

const formulariop = document.querySelector("#busqueda");
const tabla = document.querySelector("#tabla-cita");
formulariop.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('busqueda'));
    let nombre_medico      = datos.get('nombre_cita');
    datos.append('tipo_operacion', 'buscar');
    let mensajes =  document.querySelector("#mensajes");
    mensajes.innerHTML = "";
    if (nombre_medico == "") {
        let tipo_mensaje = "Debes de ingresar un nombre para buscar";
        error(tipo_mensaje);
        return false;
    }
    var url = "./model/consultasCita.php";
    fetch(url,{
        method:'post',
        body:datos
    })
    .then (data => data.json())
    .then (data => {
        // console.log('success', data);
        if (data == "ocurrio") {
            Swal.fire(
                '¡Ocurrio un error!',
                'No se pudo completar la tarea.',
                'error'
            )
        } else {
            if (data != 0) {
                pintar_tabla_resultados(data);
                Swal.fire(
                    '¡Búsqueda realizada!',
                    'Se encontraron registros.',
                    'success'
                )
            } else {
                Swal.fire(
                    '¡Búsqueda realizada!',
                    'No se encontraron registros.',
                    'error'
                )
            }
        }
        // formulariop.reset();
    })
    .catch(function(error){
        console.log('error',error);
    });
});

const error = (tipo_mensaje) => {
    mensajes.innerHTML +=`
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger d-flex" role="alert">
                <svg class="bi flex-shrink-0 me-3" width="42" height="42" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div class="">
                    <h4 class="alert-heading"> Error!!!</h4>
                    <p> *${tipo_mensaje}</p>
                </div>
            </div>
        </div>
    </div>
    `;
}