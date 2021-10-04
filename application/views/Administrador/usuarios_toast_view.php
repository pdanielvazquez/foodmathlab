<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      showConfirmButton: false,
      timer: 6000
    });

    var editar = <?= $edicion ?>;
    if (editar>0){
      var mensaje = '';
      switch(editar){
        case 1:
          mensaje = 'Acceso a secciones actualizado';
          break;
        case 2:
          mensaje = 'Laboratorios actualizados';
          break;
        case 3:
          mensaje = 'Acceso a etiquetados actualizado';
          break;
        case 4:
          mensaje = 'Acceso a índices actualizado';
          break;
        case 5:
          mensaje = 'Usuario creado exitosamente';
          break;
      }
      Toast.fire({
        icon: 'success',
        title: mensaje,
      })  
    }
})
</script>