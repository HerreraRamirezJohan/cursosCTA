// /* Se ejecuta una funcion justo cuando el DOM de la pagina se ha cargado.
//     teniendo todas las funciones o eventos a la escucha justo al cargar
//     la pagina.*/
// document.addEventListener('DOMContentLoaded', function(){
//     startApp();
// });
// /* Creamos una funcion principal (main) que nos permite organizar las funciones necesarias */
// function startApp(){

// };

class Validaciones{
    constructor(url){
        this.url = url;
    }
    /* Funcion que validara el formulario de crear curso */
    async  validateSaveCourse(){
        let form = document.querySelector('#guardarCurso');
        /* Hacer esto solo si existe el formulario en el DOM */
        if(form !== null){
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                let url = "{{route('validar')}}";
                console.log(url);
                const dataFormulario = new FormData(form);
            
                data = await fetch('cursosCTA/public/validar',{
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
                    console.log(data)
                }else{
                    console.log(data)
                    //imprimimos en patalla la tarjeta del curso que aparece
                }
            });
        }
    };
    
}