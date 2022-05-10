@extends('layouts._template')

@section('breadcrumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
        <!-- <li class="breadcrumb-item">
        <a href="javascript:void(0);">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
        <a href="javascript:void(0);">Library</a>
        </li> -->
        <li class="breadcrumb-item active">Profile</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-4 order-0">
        {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
        {{ csrf_field() }}
        <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Nama User</label>
                <input type="text" name="nama" id="nama" value="{{Auth::user()->nama}}" class="form-control" />
            </div>
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">No Telp</label>
                <input type="text" name="no_telp" id="no_telp" value="{{Auth::user()->no_hp}}" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Perusahaan</label>
                <input type="text" name="companies" id="companies" value="{{Auth::user()->companies}}" class="form-control" />
            </div>
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Telp Perusahaan</label>
                <input type="text" name="telp" id="telp" value="{{Auth::user()->telp_perusahaan}}" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Address</label>
                <input type="text" name="address" id="address" value="{{Auth::user()->address}}" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{Auth::user()->email}}" class="form-control" />
            </div>
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>
        </div>
        
        <div class="row">
            <input type="submit" class="btn btn-primary" value="Save">
            {{Form::close()}}
        </div>
    </div>
    <div class="col-sm-10 mb-4 order-0">
        
    </div>
</div>
@endsection

@section('js')
<script>
    
    $(document).ready( function () { 
        $('#form').attr('action', '{{ url('profile/update') }}');     
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