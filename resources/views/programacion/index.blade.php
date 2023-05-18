@extends('layouts.administrador')

@section('content')
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .fc .fc-col-header-cell-cushion {
    /* needs to be same precedence */
    padding-top: 5px;
    /* an override! */
    padding-bottom: 5px;
    /* an override! */
  }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Registro de Partidos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
          <li class="breadcrumb-item active">Registro de Partidos</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body">
            <div id='calendar'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Evento -->
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div id="event-content"></div>
    </div>
  </div>
</div>

<script>
  var programacion = <?php echo json_encode($programaciones); ?>

  function obtenerEventos(eventos) {

    var array = [];
    $.each(eventos, function(dmi, dmx) {

      var className = "";

      array.push({
        id: dmx.id,
        title: dmx.titulo,
        start: new Date(dmx.fecha),
        end: new Date(dmx.fecha),
        className: className,
        estado: dmx.estado,
        allDay: false
      });
    });

    return array;
  }

  $(function() {

    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        left: 'title',
      },
      navLinks: true,
      locale: 'es',
      eventLimit: true,
      selectable: true,
      themeSystem: 'bootstrap',
      //Random default events
      editable: true,
      defaultView: 'timeGridWeek',
      eventClick: function(info) {

        $('#modalCalendar').modal('show');
        $.post('<?php echo url('nueva-programacion'); ?>', {
          id: info.event.id,
        }, function(view) {
          $('#event-content').html(view);
        });

      },
      select: function(element) {

        let fecha = moment(element.start).format("YYYY-MM-DD HH:mm:ss");
        $('#modalCalendar').modal('show');
        $.post('<?php echo url('nueva-programacion'); ?>', {
          fecha: fecha,
          entidad: 'BEI',
          estado: 'I'
        }, function(view) {
          $('#event-content').html(view);
        });

        calendar.unselect();

      },
      events: obtenerEventos(programacion),

    });

    objCalendar = calendar;

    calendar.render();

  });
</script>
@endsection