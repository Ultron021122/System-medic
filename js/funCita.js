const formulariop = document.querySelector("#form");
formulariop.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('form'));
    let Paciente_ID         = datos.get('NombreP');
    let Fecha               = datos.get('Fecha');
    let Hora                = datos.get('Hora');
    let Medico_ID           = datos.get('NombreM');
    let Motivo              = datos.get('Motivo');
    let mensajes =  document.querySelector("#mensajes");
    mensajes.innerHTML = "";
    if (Paciente_ID == "") {
        let tipo_mensaje = "Debes de seleccionar un paciente";
        error(tipo_mensaje);
        return false;
    } else if (Fecha == "") {
        let tipo_mensaje = "Debes de ingresar una Fecha";
        error(tipo_mensaje);
        return false;
    } else if(Hora == "") {
        let tipo_mensaje = "Debes de ingresar una hora";
        error(tipo_mensaje);
        return false;
    } else if(Medico_ID  == ""){
        let tipo_mensaje = "Debes de seleccionar un médico";
        error(tipo_mensaje);
        return false;
    } else if(Motivo == ""){
        let tipo_mensaje = "Debes de ingresar el motivo de la cita";
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
        console.log('success', data);
        if(data == "existe"){
            Swal.fire(
                '¡Error!',
                'La cita ya existe.',
                'error'
            )
        } else if (data == "ocurrio") {
            Swal.fire(
                '¡Ocurrio un error!',
                'No se pudo completar la tarea.',
                'error'
            )
        } else {
            Swal.fire(
                '¡Agregado!',
                'La cita ha sido guardado.',
                'success'
            )
        }
        formulariop.reset();

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