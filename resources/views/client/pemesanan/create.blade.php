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
        <li class="breadcrumb-item">
        <a>Pemesanan</a>
        </li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
</nav>
@endsection

@section('content')
<!-- <div class="row">
    <div class="col-lg-12 mb-4 order-0"> -->
        <div class="card mb-3">
            <div class="d-flex align-items-end row">
                <div class="card-body">
                    <h5 class="card-title text-center">Jadwal Pemeriksaan</h5><hr>
                    <div class="row">
                        <div class="col-lg-4">
                            {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
                            {{ csrf_field() }}
                                <div class="text-center mt-3">
                                    <div class="alert alert-success" role="alert">
                                        <span>Silahkan Isi Form Layanan Yang Akan Dipesan Pada Bagian Bawah</span>
                                    </div>
                                </div>
                                <input type="hidden" name="client" class="form-control" value="{{Auth::user()->id}}" readonly>
                            
                                <label for="nameBasic" class="form-label">Diskon</label>
                                <input type="hidden" name="diskon" class="form-control" value="{{$diskons->id}}" readonly>

                                <label for="nameBasic" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                                <label for="nameBasic" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                                <div class="alert alert-success" style="display:none" id="alert1" role="alert">
                                    <span>Jadwal Tersedia</span>
                                </div>
                                <div class="alert alert-danger" style="display:none" id="alert2" role="alert">
                                    <span>Jadwal Tidak Tersedia</span>
                                </div>
    
                        </div>
                        
                        <div class="col-lg-8 text-center">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="d-flex align-items-end row">
                <!-- <div class="col-sm-12"> -->
                    <div class="card-body">
                        <h5 class="card-title">Form Layanan</h5><hr>
                            <div class="text-center mt-3">
                                <div class="alert alert-success" role="alert">
                                    <span>Silahkan Masukan Jumlah Orang Yang akan diperiksa pada layanan yang di inginkan !</span><br>
                                    <span>Kosongkan jumlah orang yang akan diperiksa pada layanan yang tidak di pesan !</span>
                                </div>
                            </div>
                            <div class="row">
                                @for($i=0; $i<$total; $i++)
                                <div class="col-md-9">
                                    <label for="nameBasic" class="form-label">Layanan</label>
                                    <select id="layanan" name="layanan[]" class="form-control">
                                            <option value="{{$layanan[$i]->id}}">{{$layanan[$i]->nama_layanan}} - Rp. {{$layanan[$i]->harga}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="nameBasic" class="form-label">Total Terperiksa</label>
                                    <input type="text" name="total[]" class="form-control">
                                </div>
                                @endfor
                            </div>
                            <div class="modal-footer">    
                                <a href="{{url('admin/pemesanan/index')}}" class="btn btn-outline-secondary">Back</a>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        {{Form::close()}}
                    </div>
                <!-- </div> -->
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

@section('js')
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
                @foreach($jadwal as $d )
                {
                    title: '{{ $d->user->companies }}', //menampilkan title dari tabel
                    start: '{{ $d->tgl_mulai }}', //menampilkan tgl mulai dari tabel
                    end: '{{ Carbon\Carbon::createFromFormat('Y-m-d', $d->tgl_selesai)}}', //menampilkan tgl selesai dari tabel
                    display: 'auto'
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

    $('#form').attr('action', '{{ url('client/pemesanan/store') }}');

    $('#simpan').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
            data: formData,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success :function () {
                alert(data.success);
                location.reload();
            },
        });
    });

    // $( ".active" ).removeClass( "active" );
    $( "#client-menu-pemesanan" ).addClass( "active" );

    $("#tgl_mulai").change(function(){
        var tanggal = '{{ Carbon\Carbon::now()}}'
        var id = $("#tgl_mulai").val();
        if(id < tanggal){
            $('#tgl_mulai').val("");
             $('#alert1').hide();
            $('#alert2').hide();
        }else{
            jadwal_awal(id);
        }
    });

    $("#tgl_selesai").change(function(){
        var id1 = $("#tgl_mulai").val();
        var id = $("#tgl_selesai").val();
        if(id < id1){
            $('#tgl_selesai').val("");
            $('#alert1').hide();
            $('#alert2').hide();
        }else{
            jadwal_akhir(id);
        }
    });

    function jadwal_awal(tgl_mulai){
        $.ajax({
            type: 'GET',
            url: '{{url("client/pemesanan/jadwal")}}/'+tgl_mulai,
            dataType: "json",
            success :function (data) {
                console.log(data[0]);
                if(data[0] < data[1]){
                    $('#alert1').show();
                    $('#alert2').hide();
                } else {
                    $('#alert1').hide();
                    $('#alert2').show();
                    $('#tgl_mulai').val("");
                }   
            },
        });
    }

    function jadwal_akhir(tgl_akhir){
    $.ajax({
            type: 'GET',
            url: '{{url("client/pemesanan/jadwal")}}/'+tgl_akhir,
            dataType: "json",
            success :function (data) {
                console.log(data[0]);
                if(data[0] < data[1]){
                    $('#alert1').show();
                    $('#alert2').hide();
                } else {
                    $('#alert1').hide();
                    $('#alert2').show();
                    $('#tgl_selesai').val("");
                }   
            },
        });
    }
});
</script>
@endsection