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
            var url = "./model/consultasMedico.php";
            var formdata = new FormData();
            formdata.append('tipo_operacion', 'eliminar');
            formdata.append('id', id);
            fetch(url, {
                method: 'post',
                body: formdata
            }).then(data => data.json())
            .then(data => {
                // console.log('Success:', data);
                if (data == "error") {
                    '¡Error!',
                    'No se pudo eliminar el registro.',
                    'error'
                } else {
                    pintar_tabla_resultados(data);
                    Swal.fire(
                    'Eliminado', 
                    'El registro se elimino correctamente.',
                    'success'
                    )
                }
            })
            .catch(error => console.error('Error:', error));
           
        }
    })
}

const pintar_tabla_resultados = (data) =>{
    let tab_datos = document.querySelector("#tabla-medico");
    tab_datos.innerHTML = "";
    for(let item of data){
        tab_datos.innerHTML +=`
            <tr>
                <td>${item.ID}</td>
                <td>${item.CURP}</td>
                <td>${item.Nombre} ${item.Apellidos}</td>
                <td>${item.Especialidad}</td>
                <td>${item.Fecha_contratacion}</td>
                <td>
                    <button class='btn btn-info btn-sm' onclick='editar(${item.ID});'><i class='fa-solid fa-pen-to-square sizeSimbol'></i></button>
                </td>
                <td>
                    <button class='btn btn-danger btn-sm' onclick='eliminar(${item.ID_user});'><i class='fa-solid fa-delete-left sizeSimbol'></i></button>
                </td>
            </tr>
        `;
    }
}

const editar = (id) => {
    //alert(id);
    var url = "./model/consultasMedico.php";
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
            var ID = item.ID;
            var Nombre = item.Nombre;
            var Apellidos = item.Apellidos;
            var Sexo = item.Sexo;
            var Fecha_nacimiento = item.Fecha_nacimiento;
            var Direccion = item.Direccion;
            var Telefono = item.Telefono;
            var Email = item.Email;
            var Especialidad = item.Especialidad;
            var Fecha_contratacion = item.Fecha_contratacion;
            var Cedula = item.Cedula_medica;
            var sexos = ['Masculino', 'Femenino'];
            var especialidades = ['Anestesiología', 'Anatomía Patológica', 'Cardiología', 'Dermatología','Gastroenterología', 'Ginegología', 'Hematología', 'Infectología','Nefrología', 'Neurología','Neumología', 'Oftalmología','Ortopedia', 'Otorrinolaringología','Pediátria', 'Psiquiatría','Urología'];
            var gen;
            var auxiliar;
            sexos.forEach(function(opc){
                if (opc == Sexo) {
                    gen += `<option value="${opc}" selected>${opc}</option>`;
                } else {
                    gen += `<option value="${opc}">${opc}</option>`;
                }
            })
            especialidades.forEach(function(especial){
                if (especial == Especialidad) {
                    auxiliar += `<option value="${especial}" selected>${especial}</option>`;
                } else {
                    auxiliar += `<option value="${especial}">${especial}</option>`;
                }
            })
        }


        Swal.fire({
            title: 'Actualizar información',
            html: `
              <form id="update_form" class="text-start">
                <input type="text" value="update" name="tipo_operacion" hidden="true">
                <!-- ID del recepcionista -->
                <input type="number" value="${ID}" hidden="true" name="ID" class="form-control">
                <hr>
                <div class="form-group row">
                    <label for="Nombre" class="col-sm-3 col-form-label">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text" value="${Nombre}" name="Nombre" id="Nombre" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Apellidos" class="col-sm-3 col-form-label">Apellidos</label>
                    <div class="col-sm-9">
                        <input type="text" value="${Apellidos}" name="Apellidos" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Sexo" class="col-sm-3 col-form-label">Género</label>
                    <div class="col-sm-9">
                        <select name="Sexo" id="Sexo" class="form-control" required>
                            <option value="" class="form-text text-center"> Selecciona una opción </option>
                            ${gen}
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Fecha_nacimiento" class="col-sm-6 col-form-label">Fecha de nacimiento</label>
                    <div class="col-sm-6">
                        <input type="date" value="${Fecha_nacimiento}" name="Fecha_nacimiento" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Fecha_contratacion" class="col-sm-6 col-form-label">Fecha de contratación</label>
                    <div class="col-sm-6">
                        <input type="date" value="${Fecha_contratacion}" name="Fecha_contratacion" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Dirección" class="col-sm-3 col-form-label">Dirección</label>
                    <div class="col-sm-9">
                        <input type="text" value="${Direccion}" name="Direccion" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Telefono" class="col-sm-3 col-form-label">Teléfono</label>
                    <div class="col-sm-9">
                        <input type="tel" value="${Telefono}" name="Telefono" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email" class="col-sm-3 col-form-label">Correo</label>
                    <div class="col-sm-9">
                        <input type="email" value="${Email}" name="Email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Especialidad" class="col-sm-4 col-form-label">Especialidad</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="Especialidad" name="Especialidad" required>
                            <option value="" class="form-text text-center"> Selecciona una opción </option>
                            ${auxiliar}
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Cedula" class="col-sm-3 col-form-label">Cedula</label>
                    <div class="col-sm-9">
                        <input type="text" value="${Cedula}" name="Cedula" class="form-control" required>
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
                var url = "./model/consultasMedico.php";
                fetch(url, {
                    method: 'post',
                    body: datos_actualizar
                })
                .then(data => data.json())
                .then(data =>{ 
                    console.log('Success:', data);
                    pintar_tabla_resultados(data);
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

const formulariop = document.querySelector("#busqueda");
const tabla = document.querySelector("#tabla-medico");
formulariop.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('busqueda'));
    let nombre_medico      = datos.get('nombre_medico');
    datos.append('tipo_operacion', 'buscar');
    let mensajes =  document.querySelector("#mensajes");
    mensajes.innerHTML = "";
    if (nombre_medico == "") {
        let tipo_mensaje = "Debes de ingresar un nombre para buscar";
        error(tipo_mensaje);
        return false;
    }
    var url = "./model/consultasMedico.php";
    fetch(url,{
        method:'post',
        body:datos
    })
    .then (data => data.json())
    .then (data => {
        console.log('success', data);
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