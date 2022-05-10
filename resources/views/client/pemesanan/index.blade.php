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
        <li class="breadcrumb-item active">Pemesanan</li>
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
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Table Data</h6>
                            </div>
                            <div class="col-2">
                                <div class="text-center">
                                <a href="#" id="add" class="btn btn-primary btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="bx bx-plus"></i>
                                    </span>
                                    <span class="text">New</span>
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table" id="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Waktu Tenggat</th>
                                        <th>Total Harga / Rp</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size:13px;">

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
        
        var table = $('#table').DataTable( {
            language: {
                "emptyTable": "Tidak Ada Data Tersimpan"
            },
            ajax: "{{ url('/client/pemesanan/data') }}",
                "columns": [
                    {
                        "data": "id",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { 
                        "data": "tgl_mulai",
                        class: "text-center",
                    },
                    { 
                        "data": "tgl_selesai",
                        class: "text-center",
                    },
                    { 
                        "data": "jam_kadaluarsa",
                        class: "text-center",
                    },
                    { 
                        "data": "total_harga",
                        class: "text-center",
                        render: function (data) {
                            return "<span>Rp. "+data+"</span>";
                        }
                    },
                    { 
                        "data": "bukti_pembayaran",
                        class: "text-center",
                        render: function (data) {
                            if(data == null){
                                return "<span class='badge bg-danger'>Not - Avaible</span>";
                            }else{
                                return "<span class='badge bg-success'>Avaible</span>";
                            }
                        }
                    },
                    { 
                        "data": "status",
                        class: "text-center",
                        render: function (data) {
                            if(data == 0){
                                return "<span class='badge bg-danger'>Rejected</span>";
                            }else if(data == 1){
                                return "<span class='badge bg-secondary'>Waiting</span>";
                            }else if(data == 2){
                                return "<span class='badge bg-success'>Diterima</span>";
                            }
                        }
                    },
                    {
                        data: 'id',
                        sClass: 'text-center',
                        render: function(data) {
                            data_replace = data.replace(/\//g, '_');
                            return '<a style="text-decoration:none" href="#" data-id="'+data_replace+'" id="edit" class="text-primary" title="Detail"><i class="bx bx-dots-vertical"></i></a> &nbsp;'+
                                '<a style="text-decoration:none" href="#" data-id="'+data_replace+'" id="delete" class="text-primary" title="hapus"><i class="bx bxs-trash"></i></a>';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

    $(document).on('click', '#add', function() {
        $("a").attr("href", "{{url('client/pemesanan/create')}}")    
    });

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');
        var id = $(this).data('id');
        $("a").attr("href", "{{url('client/pemesanan/edit')}}/"+id)  
    });

    $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            if (confirm("Anda Yakin ingin menghapus data?")){
                $.ajax({
                    url : "{{ url('client/pemesanan/delete') }}/"+id,
                    success :function () {
                        location.reload();
                    }
                })
            }
    });

    // $( ".active" ).removeClass( "active" );
    $( "#client-menu-pemesanan" ).addClass( "active" );
});
</script>
@endsection