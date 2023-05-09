/* Se ejecuta una funcion justo cuando el DOM de la pagina se ha cargado.
    teniendo todas las funciones o eventos a la escucha justo al cargar
    la pagina.*/
document.addEventListener('DOMContentLoaded', function(){
    startApp();
});
/* Creamos una funcion principal (main) que nos permite organizar las funciones necesarias */
function startApp(){
    validateSaveCourse();
};

/* Funcion que validara el formulario de crear curso */
async function validateSaveCourse(){
    let form = document.querySelector('#guardarCurso');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const dataFormulario = new FormData(form);
    
        data = await fetch('/validar',{
            method:"POST",
            body:dataFormulario,
        })
        .then((res) => res.json())
        .then((data) => {
            return (data);
        })
        .catch((error) => {
            return (error);
        });

        if(data === 1){
            //Hacemos que haga la accion por default para guardar el curso\
            form.submit();
        }else{
            //imprimimos en patalla la tarjeta del curso que aparece
        }
    });
};