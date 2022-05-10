@extends('layouts._template')

@section('css')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
@endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
        <!-- <li class="breadcrumb-item">
        <a href="javascript:void(0);">Dashboard</a>
        </li> -->
        <!-- <li class="breadcrumb-item">
        <a>Pemesanan</a>
        </li> -->
        <li class="breadcrumb-item active">Home</li>
    </ol>
</nav>
@endsection

@section('content')
<!-- <div class="row">
    <div class="col-lg-12 mb-4 order-0"> -->
        <div class="card">
            <div class="d-flex align-items-end row">
                <!-- <div class="col-sm-12"> -->
                    <div class="card-body">
                        <div class="row">
                            <h6 class="m-0 font-weight-bold text-primary">Jadwal Pemeriksaan</h6>
                            <div class="col-lg-12 text-center">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

@section('js')
<!-- <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialView: 'dayGridMonth', //listWeek
        events: [ 
            @foreach($data as $d )
            {
                title: '{{ $d->companies }}', //menampilkan title dari tabel
                start: '{{ $d->tgl_mulai }}', //menampilkan tgl mulai dari tabel
                end: '{{ Carbon\Carbon::createFromFormat('Y-m-d', $d->tgl_selesai)}}', //menampilkan tgl selesai dari tabel 
            },

            @endforeach
        ],
        eventDidMount: function(info) { 
            info.el.title = info.event.title; 
        },
        selectOverlap: function (event) {
            return event.rendering === 'background';
        }
    });

    calendar.render();
});

    $(document).ready( function () {

    // $( ".active" ).removeClass( "active" );
    $( "#instruktur-menu-home" ).addClass( "active" );
});
</script>
@endsection