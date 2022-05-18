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
        <a href="{{url('client/pemesanan/index')}}">Pemesanan</a>
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
                    <h5 class="card-title text-center">Detail Pemesanan</h5><hr>
                    <div class="row">
                        <div class="col-2">
                            <div>No Ref </div>
                            <div>Client</div>
                            <div>Perusahaan</div>
                            <div>Telp Perusahaan</div>
                            <div>No Hp</div>
                        </div>
                        <div class="col-4">
                            <div> : {{$pemesanan[0]->pemesanan->id}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->nama}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->companies}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->telp_perusahaan}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->no_hp}}</div>
                            <div class="m-2">
                                <button id="invoice" class="btn btn-sm btn-primary">Invoice</button>
                                @if($pemesanan[0]->pemesanan->status == 1)
                                    <button class="btn btn-sm btn-secondary">Kuitansi</button>
                                @elseif($pemesanan[0]->pemesanan->status == 2)
                                    <button id="kuitansi" class="btn btn-sm btn-primary">Kuitansi</button>
                                @endif
                                <button id="quotation" class="btn btn-sm btn-primary">Quotation</button>
                            </div>
                        </div>

                        <div class="col-3">
                            <div>Tenggat Waktu Pembayaran </div>
                            <div>Waktu Pembayaran</div>
                            <div>Diskon</div>
                            <div>Total Harga</div>
                            <div>Tanggal</div>
                        </div>

                        <div class="col-3">
                            <div> : {{$pemesanan[0]->pemesanan->jam_kadaluarsa}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->jam_pembayaran}}</div>
                            @if($pemesanan[0]->pemesanan->diskon->jumlah == 0)
                            <div> : - </div>
                            @else
                            <div> : {{$pemesanan[0]->pemesanan->diskon->jumlah}}%</div>
                            @endif
                            <div> : Rp. {{$pemesanan[0]->pemesanan->total_harga}}</div>
                            <div> : {{ Carbon\Carbon::parse($pemesanan[0]->pemesanan->tgl_mulai)->format('d F Y') }} <b>sd</b> {{ Carbon\Carbon::parse($pemesanan[0]->pemesanan->tgl_selesai)->format('d F Y') }}</div>
                            <div class="m-2">
                                @if($pemesanan[0]->pemesanan->bukti_pembayaran == null || $pemesanan[0]->pemesanan->bukti_pembayaran == " ")
                                    <button onClick="alert()" class="btn btn-sm btn-secondary">File Bukti</button>
                                @else
                                    <button id="bukti" class="btn btn-sm btn-primary">File Bukti</button>
                                @endif
                                <button id="edit" class="btn btn-sm btn-primary">Upload Bukti</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="d-flex align-items-end row">
                <div class="card-body">
                    <h5 class="card-title text-center">Detail Layanan</h5><hr>
                    <div class="row">
                        @foreach($pemesanan as $key => $layanan)
                        <div class="col-9">
                            <div> {{$key + 1}}. {{$layanan->layanan->nama_layanan}} / {{$layanan->jumlah_terperiksa}} Org</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Form Input</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                {{Form::open(array('method' => 'POST', 'id' => 'form', 'files' => 'true'))}}
                {{ csrf_field() }}
                    <div class="row">
                        <label for="nameBasic" class="form-label">File Bukti</label>
                        <input type="file" name="file" class="form-control">
                          
                        <input type="hidden" name="jam_pembayaran" value="{{Carbon\Carbon::now()->format('H:i:s')}}" class="form-control">
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

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');  
        var id = '{{$pemesanan[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        $('#form').attr('action', '{{ url('client/pemesanan/update') }}/'+data_replace);  
    });

    $(document).on('click', '#bukti', function() {
        var id = '{{$pemesanan[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('bukti') }}/"+data_replace);
    });

    $(document).on('click', '#invoice', function() {
        var id = '{{$pemesanan[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('invoice') }}/"+data_replace);
    });

    $(document).on('click', '#kuitansi', function() {
        var id = '{{$pemesanan[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('kuitansi') }}/"+data_replace);
    });

    $(document).on('click', '#quotation', function() {
        var id = '{{$pemesanan[0]->pemesanan_id}}';
        data_replace = id.replace(/\//g, '_');
        window.open("{{ url('quotation') }}/"+data_replace);
    });

    // $( ".active" ).removeClass( "active" );
    $( "#client-menu-pemesanan" ).addClass( "active" );

    function alert() {
        alert("Bukti Pembayaran Belum Tersedia");
    }
});
</script>
@endsection