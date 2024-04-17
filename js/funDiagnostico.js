const insertar = (idMedico, idExpediente) => {
    Swal.fire({
        title: 'Insertar diagnóstico',
        html: `
                <form id="insert_form" class="text-start">
                    <input type="text" value="insert" name="tipo_operacion" hidden="true">
                    <!-- ID del medico -->
                    <input type="number" value="${idMedico}" hidden="true" name="ID_medico" class="form-control">
                    <input type="number" value="${idExpediente}" hidden="true" name="ID_expediente" class="form-control">
                    <hr>
                    <div class="form-group row">
                        <label for="Examen_fisico" class="col-sm-5 col-form-label">Examen físico</label>
                        <div class="col-sm-7">
                            <input type="text" name="Examen_fisico" id="Examen_fisico" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Observaciones" class="col-sm-5 col-form-label">Observaciones</label>
                        <div class="col-sm-7">
                            <input type="text" name="Observaciones" id="Observaciones" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Medicacion" class="col-sm-5 col-form-label">Medicación</label>
                        <div class="col-sm-7">
                            <input type="text" name="Medicacion" id="Medicacion" class="form-control" required>
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
                    const datos = document.querySelector("#insert_form");
                    const datos_insert = new FormData(datos);
                    var url = "./model/consultasDiagnostico.php";
                    fetch(url, {
                        method: 'post',
                        body: datos_insert
                    })
                    .then(data => data.json())
                    .then(data =>{ 
                        console.log('Success:', data);
                        if(data == "existe"){
                            Swal.fire(
                                '¡Error!',
                                'Hubo un problema.',
                                'error'
                            )
                        } else if (data == "ocurrio") {
                            Swal.fire(
                                '¡Ocurrio un error!',
                                'No se pudo completar la tarea.',
                                'error'
                            )
                        } else {
                            pintar_resultados(data);
                            Swal.fire(
                                'Éxito',
                                'Se agregó con éxito',
                                'success'
                            )
                        } 
                    }).catch(function(error){
                        console.error('Error:', error)
                    }); 
        }
    })
}

const pintar_resultados = (data) =>{
    let tab_datos = document.querySelector("#card-diagnostico");
    tab_datos.innerHTML = "";
    for(let item of data){
        tab_datos.innerHTML +=`
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 d-none d-lg-block">
                            <img src="resource/img/diagnostico.png" class="cover-new mt-2" alt="...">
                        </div>
                        <div class="col-sm-12 col-md-8 d-flex flex-column align-items-left">
                            <div class="card-body">
                                <h4 class="card-title2">Diagnóstico N°${item.ID_diagnostico}</h4>
                                <p class="card-text">Realizado: ${item.FechaD}<br>
                                Médico: ${item.Nombre} ${item.Apellidos}<br>
                                Especialidad: ${item.Especialidad}</p>
                            </div>
                        </div>
                    </div>
                    <!--Examen físico -->
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body">
                                <h5 class="card-subtitle">Examen físico</h5>
                                <hr style="margin: 0.5rem 0;">
                                <p class="card-text">${item.Examen_fisico}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Observaciones -->
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body">
                                <h5 class="card-subtitle">Observaciones</h5>
                                <hr style="margin: 0.5rem 0;">
                                <p class="card-text">${item.Observaciones}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Medicación -->
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body">
                                <h5 class="card-subtitle">Medicación</h5>
                                <hr style="margin: 0.5rem 0;">
                                <p class="card-text">${item.Medicacion}</p>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="diagnostico.php?nd=${item.ID_diagnostico}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-print sizeSimbol"></i></a>
                                    <button type="button" class="btn btn-info" onclick='editar(${item.ID_diagnostico})'><i class='fa-solid fa-pen-to-square sizeSimbol'></i></button>
                                    <button type='button' class='btn btn-danger' onclick='eliminar(${item.ID_diagnostico}, ${item.ID_expediente})'><i class='fa-solid fa-delete-left sizeSimbol'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
}

const eliminar = (id, idExpediente) =>{
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
            var url = "./model/consultasDiagnostico.php";
            var formdata = new FormData();
            formdata.append('tipo_operacion', 'eliminar');
            formdata.append('id', id);
            formdata.append('idExpediente', idExpediente);
            fetch(url, {
                method: 'post',
                body: formdata
            }).then(data => data.json())
            .then(data => {
                // console.log('Success:', data);
                pintar_resultados(data);
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

const editar = (id) => {
    //alert(id);
    var url = "./model/consultasDiagnostico.php";
    var formData = new FormData();
    formData.append('tipo_operacion','editar');
    formData.append('id',id);
    fetch(url,{
        method:'post',
        body:formData
    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        for(let item of data){
            var ID_diagnostico = item.ID_diagnostico;
            var Fecha_diagnostico = item.FechaD;
            var Medicacion = item.Medicacion;
            var Observaciones = item.Observaciones;
            var Examen_fisico = item.Examen_fisico;
            var ID_medico = item.MedicoID;
            var Especialidad = item.Especialidad;
            var Nombre = item.Nombre;
            var Apellidos = item.Apellidos;
            var ID_expediente = item.ID_expediente;
        }
        Swal.fire({
            title: 'Actualizar información',
            html: `
              <form id="update_form" class="text-start">
                <input type="text" value="update" name="tipo_operacion" hidden="true">
                <!-- ID del medico -->
                <input type="number" value="${ID_diagnostico}" hidden="true" name="ID_diagnostico" class="form-control">
                <input type="number" value="${ID_expediente}" hidden="true" name="ID_expediente" class="form-control">
                <hr>
                <div class="form-group row">
                    <label for="Fecha_diagnostico" class="col-sm-5 col-form-label">Realizado</label>
                    <div class="col-sm-7">
                        <input type="text" name="Fecha_diagnostico" value="${Fecha_diagnostico}" id="Fecha_diagnostico" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Examen_fisico" class="col-sm-5 col-form-label">Examen físico</label>
                    <div class="col-sm-7">
                        <input type="text" name="Examen_fisico" value="${Examen_fisico}" id="Examen_fisico" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Observaciones" class="col-sm-5 col-form-label">Observaciones</label>
                    <div class="col-sm-7">
                        <input type="text" name="Observaciones" value="${Observaciones}" id="Observaciones" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Medicacion" class="col-sm-5 col-form-label">Medicación</label>
                    <div class="col-sm-7">
                        <input type="text" name="Medicacion" value="${Medicacion}" id="Medicacion" class="form-control" required>
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
                var url = "./model/consultasDiagnostico.php";
                fetch(url, {
                    method: 'post',
                    body: datos_actualizar
                })
                .then(info => info.json())
                .then(info =>{ 
                    console.log('Success:', info);
                    pintar_resultados(info);
                    Swal.fire(
                        'Exito',
                        'Se actualizo con exito',
                        'success'
                    )
                      
                })
                .catch(function(error){
                    console.error('Error:', error)
                }); 

            }
        })
             
    })
    .catch(function (error){
        console.error('error',error);
    }); 
}
