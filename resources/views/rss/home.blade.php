@extends('layouts.administrador')

@section('content')
      <div class="container">
        <div class="row">
          <div class="col-md-12"  style="margin-top: 200px">
            <!-- general form elements disabled -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Generar RSS</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-sm-7">
                      <!-- select -->
                      <div class="form-group">
                        <label>Categoría</label>
                            <select class="form-control select2 categoria" name="categoria" id="categoria" required>
                                <option value="">Seleccione</option>
                                <?php if (count($cat)) : ?>
                                    <?php foreach ($cat as $key) : ?>
                                        <option <?php echo ($key && $key['categoria'] == $key['id']) ? "selected" : ""; ?> value="<?php echo $key['id']; ?>">
                                           
                                           <?php foreach (array_keys(config('locale.languages')) as $lang) : ?>
                                             <?php if ($lang != App::getLocale() AND $lang == 'en') : ?>
                                                        <?php echo $key['nombre']; ?>
                                             <?php  elseif ($lang != App::getLocale() AND $lang == 'es') : ?>
                                                    <?php  echo $key['nombre_ingles']; ?>
                                           <?php endif ; ?>
                                            <?php endforeach; ?>            
                                           

                                           
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Fecha </label>
                        <input type="date" class="form-control" id="fecha">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group" style="margin-top: 28px">
							<button type="submit" class="btn btn-primary">Generar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection