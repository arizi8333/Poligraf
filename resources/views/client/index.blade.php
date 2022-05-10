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
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome {{Auth::user()->nama}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
    $(document).ready( function () {

    // $( ".active" ).removeClass( "active" );
    $( "#client-menu-home" ).addClass( "active" );
});
</script>
@endsection