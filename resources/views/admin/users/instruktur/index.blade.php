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
        <li class="breadcrumb-item">
        <a>User</a>
        </li>
        <li class="breadcrumb-item active">Instruktur</li>
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
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Hp</th>
                                        <th>Email</th>
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

    
    <!-- Modal -->
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
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Nama Instruktur</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Enter Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">No Hp</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Enter No Handphone" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Enter Addrees" />
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-0">
                <label for="emailBasic" class="form-label">Perusahaan</label>
                <input type="text" name="perusahaan" id="perusahaan" class="form-control" placeholder="Enter Companies" />
                </div>
                <div class="col mb-0">
                <label for="dobBasic" class="form-label">Telp Perusahaan</label>
                <input type="text" name="telp" id="telp" class="form-control" placeholder="Enter Telp Companies"/>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-0">
                <label for="emailBasic" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="xxxx@gmail.com" />
                </div>
                <div class="col mb-0">
                <label for="dobBasic" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
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
            ajax: "{{ url('/admin/instruktur/data') }}",
                "columns": [
                    {
                        "data": "id",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { "data": "nama"},
                    { "data": "address"},
                    { 
                        "data": "no_hp",
                        sClass: 'text-center',
                    },
                    { 
                        "data": "email",
                        sClass: 'text-center',
                    },
                    {
                        data: 'id',
                        sClass: 'text-center',
                        render: function(data) {
                            return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="edit" class="text-primary" title="edit"><i class="bx bxs-pencil"></i></a> &nbsp;'+
                                '<a style="text-decoration:none" href="#" data-id="'+data+'" id="delete" class="text-primary" title="hapus"><i class="bx bxs-trash"></i></a>';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

    $(document).on('click', '#add', function() {
        $('#modal').modal('show');  
        $('#nama').val("");
        $('#no_hp').val("");
        $('#alamat').val("");
        $('#telp').val("");
        $('#perusahaan').val("");
        $('#email').val("");
        $('#password').val("");
        $('#form').attr('action', '{{ url('admin/instruktur/create') }}');     
    });

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');
        var id = $(this).data('id');
        $.ajax({   
            type: "get",
            url: "{{ url('/admin/instruktur/edit') }}/"+id,
            dataType: "json",
            success: function(data) {
                console.log(data[0].id);
                event.preventDefault();
                var nama=data[0].nama
                var companies=data[0].companies
                var no_hp=data[0].no_hp
                var telp_perusahaan=data[0].telp_perusahaan
                var address=data[0].address
                var email=data[0].email

                $('#nama').val(nama).change();
                $('#perusahaan').val(companies).change();
                $('#no_hp').val(no_hp).change();
                $('#telp').val(telp_perusahaan).change();
                $('#alamat').val(address).change();
                $('#email').val(email).change();
                $('#form').attr('action', '{{ url('admin/instruktur/update') }}/'+id);
            }
        });        
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
                $('#modal').modal('hide');
                location.reload();
            },
        });
    });

    $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            if (confirm("Anda Yakin ingin menghapus data?")){
                $.ajax({
                    url : "{{ url('admin/instruktur/delete') }}/"+id,
                    success :function () {
                        location.reload();
                    }
                })
            }
    });

    // $( ".active" ).removeClass( "active" );
    $( "#admin-menu-instruktur" ).addClass( "active" );
});
</script>
@endsection