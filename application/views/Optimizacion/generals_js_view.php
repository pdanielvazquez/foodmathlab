<script>

	 //Inicializacion del Toast par mostrar las alertas
 const Toast = Swal.mixin({
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    showLoaderOnConfirm: true
  });

/***
*
* swa_notification(icon, title, text, confirmButtonText, callback)
*
* icon: success, error, warning, info, question 
* text: Mensaje a mostrar en la alerta
* title: Titulo del alert
* confirmButtonText: Texto del boton de aceptar
* callback: funcion a ejecutar al aceptar el alert
*
***/
function swa_notification(icon, title, text, confirmButtonText, id){
    Toast.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonText: confirmButtonText,
      preConfirm: () => {
  
            var formData = new FormData()
            formData.append("id", id);
            formData.append("metodo", "delete_token");
  
                return fetch(URL,{
                      method: 'POST',
                      body: formData,
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error(response.statusText)
                      }
                      return response.json()
                  })
                  .catch(error => {
                      Swal.showValidationMessage(
                          `Request failed: ${error}`
                      )
                  })
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire({
                  title: 'Eliminado!',
          text: 'Los tokens han sido eliminados exitosamente',
          icon: 'success'
                }).then(function(){
            location.reload();
          });
          }
      });
  }


</script>