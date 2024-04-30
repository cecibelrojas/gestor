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
                        <select class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
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