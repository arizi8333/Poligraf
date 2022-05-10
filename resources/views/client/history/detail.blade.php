@extends('layouts._template')
@section('css')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
<style type="text/css">
    .rating{
  display : flex;
}

.rating input{
  position : absolute;
  left     : -100vw;
}

.rating label{
  width      : 48px;
  height     : 48px;
  padding    : 48px 0 0;
  overflow   : hidden;
  background : url("../../../Logo/stars.svg") no-repeat top right;
}

.rating:not(:hover) input:indeterminate + label,
.rating:not(:hover) input:checked ~ input + label,
.rating input:hover ~ input + label{
  background-position : -48px 0;
}

.rating:not(:hover) input:focus-visible + label{
  background-position : -96px 0;
}
</style>
@endsection

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
        <!-- <li class="breadcrumb-item">
        <a href="javascript:void(0);">Dashboard</a>
        </li> -->
        <li class="breadcrumb-item">
        <a href="{{url('client/history/index')}}">History</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
</nav>
@endsection

@section('content')
<!-- <div class="row">  
    <div class="col-lg-12 mb-4 order-0"> -->
        <div class="card mb-3">
            <div class="d-flex align-items-end row">
                <div class="card-body">
                    <h5 class="card-title text-center">Informasi Pemeriksaan</h5><hr>
                    <div class="row">
                        <div class="col-2">
                            <div>No Ref </div>
                            <div>Client</div>
                            <div>Perusahaan</div>
                            <div>Telp Perusahaan</div>
                            <div>No Hp</div>
                        </div>
                        <div class="col-4">
                            <div> : {{$data[0]->pemesanan->id}}</div>
                            <div> : {{$data[0]->pemesanan->user->nama}}</div>
                            <div> : {{$data[0]->pemesanan->user->companies}}</div>
                            <div> : {{$data[0]->pemesanan->user->telp_perusahaan}}</div>
                            <div> : {{$data[0]->pemesanan->user->no_hp}}</div>
                            <div class="m-2">
                                <button id="invoice" class="btn btn-sm btn-primary">Invoice</button>
                                <button id="kuitansi" class="btn btn-sm btn-primary">Kuitansi</button>
                                <button id="quotation" class="btn btn-sm btn-primary">Quotation</button>
                            </div>
                        </div>

                        <div class="col-3">
                            <div>Tanggal</div>
                            <div>Rating Pemeriksaan</div>
                        </div>

                        <div class="col-3">
                            <div> : {{ Carbon\Carbon::parse($data[0]->pemesanan->tgl_mulai)->format('d F Y') }} <b>sd</b> {{ Carbon\Carbon::parse($data[0]->pemesanan->tgl_selesai)->format('d F Y') }}</div>                          
                            @if($data1[0]->rating == 0 || $data1[0]->rating == null )
                                <span> : - </span>
                                <div class="m-3" style="float:right;"><button class="btn btn-sm btn-primary"  id="rating"><a style="text-decoration:none" href="#" class="text-white" title="Berikan Rating"><i class="bx bxs-star"></i></a></button></div>
                            @else
                                <div>
                                    <span> : {{$data1[0]->rating}} <i class="bx bxs-star"></i></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="d-flex align-items-end row">
                <div class="card-body">
                    <h5 class="card-title text-center">Detail Pemeriksaan</h5><hr>
                    <div class="row">
                        <div class="table-responsive mt-3">
                            <table class="table" id="table" width="100%">
                                <tr>
                                    <th>Terperiksa</th>
                                    <th>Layanan</th>
                                    <th>Case</th>
                                    <th>Hasil</th>
                                </tr>
                        @forelse ($data1 as $p)
                                <tr>
                                     <td>{{$p->nama_terperiksa}}</td>
                                    <td>{{$p->layanan->nama_layanan}}</td>
                                    @if($p->case == null)
                                    <td> - </td>
                                    @else
                                    <td>{{$p->case}}</td>
                                    @endif

                                    @if($p->hasil == null || $p->hasil == " ")
                                    <td>
                                        <a title="Tidak Tersedia" style="text-decoration:none" class="text-secondary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="" style="text-decoration:none" id="hasil" data-id="{{$p->id}}" class="text-primary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @endif
                                </tr>
                        @empty
                            <div class="alert alert-secondary" role="alert">
                                <span style="font-size:1.4em">Data Belum Dibuat! </span>
                            </div>
                        @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Form Input</h5><hr>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
                    {{ csrf_field() }}
                    <div class="row">
                        <input type="hidden" name="id" value="{{$data[0]->pemesanan->id}}"> 
                        <label for="nameBasic" class="form-label">Berikan Penilaian Anda</label>
                        <div class="rating">
                            <input id="rating1" type="radio" name="rating" value="1">
                            <label for="rating1">1</label>
                            <input id="rating2" type="radio" name="rating" value="2">
                            <label for="rating2">2</label>
                            <input id="rating3" type="radio" name="rating" value="3">
                            <label for="rating3">3</label>
                            <input id="rating4" type="radio" name="rating" value="4">
                            <label for="rating4">4</label>
                            <input id="rating5" type="radio" name="rating" value="5">
                            <label for="rating5">5</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <input type="submit" class="btn btn-primary" value="Save">
                </div>
                {{Form::close()}}
            </div>
            </div>
        </div>
       
    <!-- </div>
</div> -->

@endsection

@section('js')
<script>

$(document).ready( function () {
    
    $(document).on('click', '#hasil', function() {
        var id = $(this).data('id');
        window.open("{{ url('hasil') }}/"+id);
    });

    
    $(document).on('click', '#invoice', function() {
        var id = '{{$data1[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('invoice') }}/"+data_replace);
    });

    $(document).on('click', '#kuitansi', function() {
        var id = '{{$data1[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('kuitansi') }}/"+data_replace);
    });

    $(document).on('click', '#quotation', function() {
        var id = '{{$data1[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('quotation') }}/"+data_replace);
    });

    // $( ".active" ).removeClass( "active" );
    $( "#client-menu-history" ).addClass( "active" );

    $(document).on('click', '#rating', function() {
        $('#modal').modal('show');  
        var id = $(this).data('id');
        $("#id").val(id).change();
        $('#form').attr('action', '{{ url('client/history/rating') }}');  
    });

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
});
</script>
@endsection