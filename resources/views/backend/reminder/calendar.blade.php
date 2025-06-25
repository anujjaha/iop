@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
<link rel="stylesheet" href="{!! asset('js/plugins/fullcalendar/main.css') !!}">
<link rel="stylesheet" href="{!! asset('css/calendar-final.css') !!}">
<script src="{!! asset('js/calendar.js') !!}"></script>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($repository->moduleTitle) ? str_plural($repository->moduleTitle) : '' }} Listing
        </h3>
        <div class="card-tools">
           <a href="{!! route('admin.reminder.create') !!}" class="btn btn-xs btn-success">Create</a>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-12" id="calendar"></div>
    </div>
</div>
@endsection

@section('after-scripts')
<script type="text/javascript" src="{!! asset('js/plugins/moment/moment.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/fullcalendar/main.js') !!}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        generateCalendar();
    });

    function generateCalendar()
    {
        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');
        var calendar = new Calendar(calendarEl, {
            handleWindowResize: true,
          headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          themeSystem: 'bootstrap',
          //Random default events
          events: {!! $events !!},
            eventContent: function( info ) {
          return {html: info.event.title};
        },
        
            editable  : false,
          droppable : false, // this allows things to be dropped onto the calendar !!!
          drop      : function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
              // if so, remove the element from the "Draggable Events" list
              info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
          }
        });

        calendar.render();
    }

    var calendarInstance1 = new calendarJs( "calendar1", { 
        exportEventsEnabled: true,
        useAmPmForTimeDisplays: true
    });

    document.title += " v" + calendarInstance1.getVersion();
</script>

@endsection