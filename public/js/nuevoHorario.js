botonHorarioExtra();

function botonHorarioExtra() {
    let btnAgregar = document.getElementById('btnAgregar');
    let btnEliminar = document.getElementById('btnEliminar');

    let container = document.getElementById('containerButtons');

    let btn = document.getElementById('btn');
    let formulariosContainer = document.getElementById('formulariosContainer');
    let contador = 0;

    function agregarFormulario() {
        
        if(contador >= 0){
            btnEliminar.classList.remove('d-none');}
        
        if(contador < 5)
        {
            let formulario = document.createElement('div');
            formulario.classList.add('formulario','d-md-flex', 'd-lg-flex', 'justify-content-between', 'gap-5');
    
            formulario.innerHTML = `
                    <div class="mb-3 w-100">
                        <label for="dia${contador}">Día</label>
                        <select id="dia${contador}" class="form-select" name="dia[]">
                            <option selected disabled>Elegir</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                        </select>
                        <div class="alert alert-danger mt-2" role="alert" style="display: none"></div>
                    </div>
    
                    <div class="mb-3 w-100">
                        <label for="horario${contador}" class="validationDefault04">Hora de inicio del curso</label>
                        <input id="hora_inicio${contador}" type="time" name="hora_inicio[]" class="form-control"
                            min="07:00" max="21:00" value="">
                        <div class="alert alert-danger mt-2" role="alert" style="display: none"></div>
                    </div>
    
                    <div class="mb-3 w-100">
                        <label for="horario${contador}" class="validationDefault04">Hora final del curso</label>
                        <input id="hora_final${contador}" type="time" name="hora_final[]" class="form-control"
                            min="07:00" max="21:00" value="">
                        <div class="alert alert-danger mt-2" role="alert" style="display: none"></div>
                    </div>
                `;
    
            formulariosContainer.appendChild(formulario);
            contador++;
        }
    }

    function quitarFormulario() {
        if(contador == 1){
            btnEliminar.classList.add('d-none');}
        if (contador > 0) {
            let formulario = formulariosContainer.lastChild;
            formulariosContainer.removeChild(formulario);
            contador--;
        }
    }

    // Verificar si btnAgregar existe antes de agregar el evento
    if (btnAgregar) {
        btnAgregar.addEventListener('click', function() {
          agregarFormulario();
          // console.log(contador);
        });
      }
      
      // Verificar si btnEliminar existe antes de agregar el evento
      if (btnEliminar) {
        btnEliminar.addEventListener('click', function(){
          quitarFormulario();
        });
      }


    

}