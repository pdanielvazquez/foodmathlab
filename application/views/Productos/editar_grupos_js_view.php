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
    var mensaje = 'Datos actualizados exitosamente';
    if (editar==1){
      Toast.fire({
        icon: 'success',
        title: mensaje,
      })  
    }
})
</script>