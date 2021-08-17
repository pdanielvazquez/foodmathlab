<script>
  $(function() {
    var Toast = Swal.mixin({
      // toast: true,
      // position: 'top-end',
      timerProgressBar: true,
      showConfirmButton: true,
      timer: 6000
    });

    var editar = <?= $edicion ?>;
    if (editar>0){
      mensaje = '';
      icono = '';
      switch(editar){
        case 1:
          icono= 'success';
          mensaje = 'Imagen agregada exitosamente';
          break;
        case 2:
          icono= 'success';
          mensaje = 'Imagen eliminada exitosamente';
          break;
        case 3:
          icono= 'error';
          mensaje = 'Error al subir la Imagen';
          break;
        case 4:
          icono= 'warning';
          mensaje = 'Error al borrar la Imagen';
          break;

      }
      
      Toast.fire({
        icon: icono,
        title: mensaje,
      })  
    }
    
})
</script>