@extends('layouts.administrador')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Actualizar Contraseña</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Actualizar Contraseña</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <section class="content">
 	<div class="container-fluid">
 		<div class="row">
 			<div class="col-md-6 offset-sm-3">
 				<div class="card card-info">
	              <div class="card-header">
	                <h3 class="card-title">Actualizar Contraseña  de <?php echo auth()->user()->name ?>  </h3>
	              </div>
		              <form>
		              	<!-- ID para acciones de edicion o eliminacion de registro -->
						<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
						<!-- -->
						<!-- password hiddem -->
						<input type="hidden" name="password_actual" value="<?php echo $data ? $data['password'] : ''; ?>">
						<!-- password hiddem -->


		                <div class="card-body">
		                  <div class="form-group">
		                   <label>Contraseña </label>
		                    <input type="password" class="form-control input-sm" id="password" style="border: 1px solid #b9b9b9;" autocomplete="new-password"  placeholder="Contraseña mínimo de 8 caracteres">
		                  </div>
		                </div>
		                <!-- /.card-body -->

		                <div class="card-footer text-right">
		                 <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
		                </div>
		              </form>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <script>
    $('#btnSave').click(function() {

        if ($('#password').val() == '') {
            swal({
                type: "info",
                title: "¡El campo password es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        $.ajax({
            url: '<?php echo url('/guardar-contrasena') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                password: $('#password').val()
            },
            beforeSend: function() {
                $('#btnSave').html("Procesando <i class='fa fa-spinner fa-pulse'></i>").attr('disabled', true);
            },
            success: function(data) {

                if (typeof data.errorMessage != 'undefined') {
                    swal({
                        icon: 'error',
                        text: data.errorMessage,
                        showConfirmButton: true
                    });
                    $('#btnSave').html("Guardar Cambios").attr('disabled', false);
                    return false;
                }

                swal({
                    icon: 'success',
                    title: '¡Exito!',
                    text: 'Se han guardado los cambios realizados.',
                    showConfirmButton: true
                }).then(function(result) {
                    location.href = "<?php echo url('/') ?>"
                });
            },
            error: function() {
                $('#btnSave').html("Guardar Cambios").attr('disabled', false);
            }
        });
    });
</script>
@endsection