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
        <a href="{{url('admin/pemeriksaan/index')}}">Pemeriksaan</a>
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
                            <div> : {{$pemesanan[0]->pemesanan->id}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->nama}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->companies}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->telp_perusahaan}}</div>
                            <div> : {{$pemesanan[0]->pemesanan->user->no_hp}}</div>
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
                                    <th>Instruktur</th>
                                    <th>Terperiksa</th>
                                    <th>Layanan</th>
                                    <th>Case</th>
                                    <th>Hasil</th>
                                </tr>
                        @forelse ($pemeriksaan as $p)
                                <tr>
                                    <td>{{$p->user->nama}}</td>
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
                                <span style="font-size:1.4em">Silahkan Pilih Instruktur Terlebih Dahulu ! </span>
                                <button id="add" style="float:right;margin-right:30px" class="btn btn-primary" title="Tambah Instruktur"><i class="bx bxs-user-plus"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel1">Form Input</h5>
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
                        <input type="hidden" name="id" value="{{$pemesanan[0]->pemesanan->id}}">
                        <label for="nameBasic" class="form-label">Instruktur</label>
                        <select name="instruktur" class="form-control">
                            @foreach($user as $u)
                            <option value="{{$u->id}}">{{$u->nama}}</option>
                            @endforeach
                        </select>
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

    $(document).on('click', '#add', function() {
        $('#modal').modal('show');  
        $('#form').attr('action', '{{ url('admin/pemeriksaan/create') }}');  
    });

    $(document).on('click', '#hasil', function() {
        var id = $(this).data('id');
        window.open("{{ url('hasil') }}/"+id);
    });

    // $( ".active" ).removeClass( "active" );
    $( "#admin-menu-pemeriksaan" ).addClass( "active" );

    
});
</script>
@endsection