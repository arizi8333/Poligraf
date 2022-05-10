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
        <li class="breadcrumb-item active">Pemeriksaan</li>
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
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table" id="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Client</th>
                                        <th>Telp</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
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
            ajax: "{{ url('/admin/pemeriksaan/data') }}",
                "columns": [
                    {
                        "data": "id",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { "data": "user.companies"},
                    { "data": "user.telp_perusahaan"},
                    { 
                        "data": "tgl_mulai",
                        class: "text-center",
                    },
                    { 
                        "data": "tgl_selesai",
                        class: "text-center",
                    },
                    {
                        data: 'id',
                        sClass: 'text-center',
                        render: function(data) {
                            data_replace = data.replace(/\//g, '_');
                            return '<a style="text-decoration:none" href="#" data-id="'+data_replace+'" id="edit" class="text-primary" title="Detail"><i class="bx bx-dots-vertical"></i></a>';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');
        var id = $(this).data('id');
        $("a").attr("href", "{{url('admin/pemeriksaan/edit')}}/"+id)  
    });

    // $( ".active" ).removeClass( "active" );
    $( "#admin-menu-pemeriksaan" ).addClass( "active" );
});
</script>
@endsection