@extends('admin.layouts.app')

@section('title', 'Events')

@push('css')
   <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/fullcalendar/fullcalendar.css')}}"> 
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row animated fadeInDown">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Draggable Events</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id='external-events'>
                            <p>Drag a event and drop into callendar.</p>
                            <div class='external-event navy-bg'>Go to shop and buy some products.</div>
                            <div class='external-event navy-bg'>Check the new CI from Corporation.</div>
                            <div class='external-event navy-bg'>Send documents to John.</div>
                            <div class='external-event navy-bg'>Phone to Sandra.</div>
                            <div class='external-event navy-bg'>Chat with Michael.</div>
                            <p class="m-t">
                                <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Striped Table </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            /* initialize the external events
             -----------------------------------------------------------------*/
    
    
            $('#external-events div.external-event').each(function() {
    
                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });
    
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1111999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
    
            });
    
    
            $('#calendar').fullCalendar({
                editable: true,
                droppable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

                events: [
                    { // this object will be "parsed" into an Event Object
                    title: 'The Title', // a property!
                    start: '2021-03-23', // a property!
                    end: '2021-03-23' // a property! ** see important note below about 'end' **
                    }
                ]
            });
        });
    
    </script>
@endpush