@extends('layouts._template')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
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
        <li class="breadcrumb-item active">Rating</li>
    </ol>
</nav>
@endsection

@section('content')
<!-- <div class="row">
    <div class="col-lg-12 mb-4 order-0"> -->
                
        <div class="card m-3" id="tabel">
            <div class="d-flex align-items-end row">
                <!-- <div class="col-sm-12"> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Rating Pemeriksaan</h6>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Ref</th>
                                        <th>Perusahaan</th>
                                        <th class="text-center">Tanggal Mulai</th>
                                        <th class="text-center">Tanggal Selesai</th>
                                        <th class="text-center">Rating</th>
                                    </tr>
                                </thead>
                                <tbody  id="data-tabel" style="font-size:13px;">
                                    @forelse($datas as $key => $data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->perusahaan}}</td>
                                        <td class="text-center">{{$data->tgl_mulai}}</td>
                                        <td class="text-center">{{$data->tgl_selesai}}</td>
                                        <td class="text-center">{{$data->rating}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>Belum ada pemeriksaan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {

     

    // $( ".active" ).removeClass( "active" );
    $( "#instruktur-menu-rating" ).addClass( "active" );
});
</script>
@endsection