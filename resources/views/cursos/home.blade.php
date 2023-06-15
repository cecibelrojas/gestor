@extends('layouts.administrador')

@section('content')
  <!-- Content Wrapper. Contains page content -->
 

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cursos y Talleres</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Cursos y Talleres</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('modais.events')
    @include('modais.fastEvents')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Eventos Rapidos</h4>
                </div>
                <div class="card-body">
                       <div id='external-events'>

                            <div id='external-events-list'>
                                @isset($fastEvents)
                                    @forelse($fastEvents as $fastEvent)
                                        <div id="boxFastEvent{{ $fastEvent->id }}"
                                            style="padding: 4px; border: 1px solid {{ $fastEvent->color }}; background-color: {{ $fastEvent->color }}"
                                            class='external-event fc-event event text-center'
                                            data-event='{"id":"{{ $fastEvent->id }}","title":"{{ $fastEvent->title }}","color":"{{ $fastEvent->color }}","start":"{{ $fastEvent->start }}","end":"{{ $fastEvent->end }}"}'>
                                            {{ $fastEvent->title }}
                                        </div>
                                    @empty
                                        <p>No hay eventos rápidos para Visualizar</p>
                                    @endforelse
                                @endisset

                            </div>
                            <p>
                                <input type='checkbox' id='drop-remove'/>
                                <label for='drop-remove'>eliminar después de arrastrar</label>
                                <button class="btn btn-sm btn-success" id="newFastEvent" style="font-size: 1em; width: 100%;">Crear Nuevo Evento</button>
                            </p>
                        </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                  <div
                      id='calendar'
                      data-route-load-events="{{ route('routeLoadEvents') }}"
                      data-route-event-update="{{ route('routeEventUpdate') }}"
                      data-route-event-store="{{ route('routeEventStore') }}"
                      data-route-event-delete="{{ route('routeEventDelete') }}"

                      data-route-fast-event-delete="{{ route('routeFastEventDelete') }}"
                      data-route-fast-event-update="{{ route('routeFastEventUpdate') }}"
                      data-route-fast-event-store="{{ route('routeFastEventStore') }}">
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <script>
   $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        left: 'title',
      },
      navLinks: true,
      locale: 'es',
      eventLimit: true,
      selectable: true,
      themeSystem: 'bootstrap',
      //Random default events
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
        drop: function(element) {
           let Event = JSON.parse(element.draggedEl.dataset.event);
            
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                element.draggedEl.parentNode.removeChild(element.draggedEl);

                Event._method = "DELETE";
                sendEvent(routeEvents('routeFastEventDelete'), Event);
            }
            
            let start = moment(`${element.dateStr} ${Event.start}`).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(`${element.dateStr} ${Event.end}`).format("YYYY-MM-DD HH:mm:ss");

            Event.start = start;
            Event.end = end;

            delete Event.id;
            delete Event._method;

            sendEvent(routeEvents('routeEventStore'), Event);
        },
        eventDrop: function(element){

            let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

            let newEvent = {
                _method:'PUT',
                title: element.event.title,
                id: element.event.id,
                start: start,
                end: end
            };

            sendEvent(routeEvents('routeEventUpdate'),newEvent,calendar);

        },
        eventClick: function(element){
            clearMessages('.message');
            resetForm("#formEvent");

            $("#modalCalendar").modal('show');
            $("#modalCalendar #titleModal").text('Alterar Evento');
            $("#modalCalendar button.deleteEvent").css("display","flex");

            let id = element.event.id;
            $("#modalCalendar input[name='id']").val(id);

            let title = element.event.title;
            $("#modalCalendar input[name='title']").val(title);

            let start = moment(element.event.start).format("DD/MM/YYYY HH:mm:ss");
            $("#modalCalendar input[name='start']").val(start);

            let end = moment(element.event.end).format("DD/MM/YYYY HH:mm:ss");
            $("#modalCalendar input[name='end']").val(end);

            let color = element.event.backgroundColor;
            $("#modalCalendar input[name='color']").val(color);

            let description = element.event.extendedProps.description;
            $("#modalCalendar textarea[name='description']").val(description);


        },
        eventResize: function(element){
            let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

            let newEvent = {
                _method:'PUT',
                title: element.event.title,
                id: element.event.id,
                start: start,
                end: end
            };

            sendEvent(routeEvents('routeEventUpdate'),newEvent);
        },
        select: function(element){

            clearMessages('.message');
            resetForm("#formEvent");
            $("#modalCalendar input[name='id']").val('');

            $("#modalCalendar").modal('show');
            $("#modalCalendar #titleModal").text('Agregar Evento');
            $("#modalCalendar button.deleteEvent").css("display","none");

            let start = moment(element.start).format("DD/MM/YYYY HH:mm:ss");
            $("#modalCalendar input[name='start']").val(start);

            let end = moment(element.end).format("DD/MM/YYYY HH:mm:ss");
            $("#modalCalendar input[name='end']").val(end);

            $("#modalCalendar input[name='color']").val("#3788D8");

            calendar.unselect();

        },
        eventReceive: function(element){
            element.event.remove();
        },
        events: routeEvents('routeLoadEvents'),

    });
    objCalendar = calendar;
    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })

  </script>
@endsection