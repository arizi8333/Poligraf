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
        <a href="{{url('instruktur/pemeriksaan/index')}}">Pemeriksaan</a>
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
                        </div>

                        <div class="col-3">
                            <div>Tanggal</div>
                        </div>

                        <div class="col-3">
                            <div> : {{ Carbon\Carbon::parse($data[0]->pemesanan->tgl_mulai)->format('d F Y') }} <b>sd</b> {{ Carbon\Carbon::parse($data[0]->pemesanan->tgl_selesai)->format('d F Y') }}</div>
                            @if($data[0]->pemesanan->status == 3)
                                <div class="alert alert-success"><span>Selesai</span></div>
                            @else
                                <div class="alert alert-warning"><span>Belum Selesai</span></div>
                            @endif                            
                            <div class="m-3" style="float:right;"><button class="btn btn-sm btn-primary"  id="konfirmasi"><a style="text-decoration:none" href="#" class="text-white" title="Konfirmasi Pemeriksaan"><i class="bx bx-calendar-check"></i></a></button></div>
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
                                    <th>Riwayat</th>
                                    <th>Persetujuan</th>
                                    <th>Action</th>
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

                                    @if($p->riwayat_kesehatan == null || $p->riwayat_kesehatan == " ")
                                    <td>
                                        <a title="Tidak Tersedia" style="text-decoration:none" class="text-secondary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="" style="text-decoration:none" id="riwayat" data-id="{{$p->id}}" class="text-primary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @endif

                                    @if($p->berkas_persetujuan == null || $p->berkas_persetujuan == " ")
                                    <td>
                                        <a title="Tidak Tersedia" style="text-decoration:none" class="text-secondary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="" style="text-decoration:none" id="persetujuan" data-id="{{$p->id}}" class="text-primary"><i class="bx bxs-file-blank"></i></a>
                                    </td>
                                    @endif

                                    <td>
                                        <a style="text-decoration:none" href="#" data-id="{{$p->id}}" id="edit" class="text-primary" title="Detail"><i class="bx bx-dots-vertical"></i></a>
                                    </td>
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
                        <input type="hidden" name="id" id="id">
                        <label for="nameBasic" class="form-label">Nama Terperiksa</label>
                        <input type="text" name="nama" id="nama" class="form-control">

                        <label for="nameBasic" class="form-label">Case</label>
                        <input type="text" name="case" id="case" class="form-control">

                        <label for="nameBasic" class="form-label">Hasil</label>
                        <input type="file" name="file" id="file" class="form-control"><br>

                        <label for="nameBasic" class="form-label">Riwayat Kesehatan</label>
                        <input type="file" name="file_kesehatan" id="file_kesehatan" class="form-control"><br>

                        <label for="nameBasic" class="form-label">Berkas Persetujuan</label>
                        <input type="file" name="file_persetujuan" id="file_persetujuan" class="form-control"><br>
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

    $(document).on('click', '#konfirmasi', function() {
            var id = "{{$data[0]->pemesanan->id}}";
            data_replace = id.replace(/\//g, '_');
            if (confirm("Apakah Pemeriksaan Telah Selesai ?")){
                $.ajax({
                    url : "{{ url('instruktur/pemeriksaan/selesai') }}/"+data_replace,
                    success :function () {
                        location.reload();
                    }
                })
            }
    });

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');  
        var id = $(this).data('id');
        $("#id").val(id).change();
        $('#form').attr('action', '{{ url('instruktur/pemeriksaan/update') }}');  
    });

    $(document).on('click', '#hasil', function() {
        var id = $(this).data('id');
        window.open("{{ url('hasil') }}/"+id);
    });

    $(document).on('click', '#riwayat', function() {
        var id = $(this).data('id');
        window.open("{{ url('riwayat_kesehatan') }}/"+id);
    });

    $(document).on('click', '#persetujuan', function() {
        var id = $(this).data('id');
        window.open("{{ url('berkas_persetujuan') }}/"+id);
    });

    // $( ".active" ).removeClass( "active" );
    $( "#instruktur-menu-pemeriksaan" ).addClass( "active" );

    
});
</script>
@endsection