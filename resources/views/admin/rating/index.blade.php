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
        <div class="card">
            <div class="d-flex align-items-end row">
                <!-- <div class="col-sm-12"> -->
                    <div class="card-body">
                        <h5>Filter</h5>
                            <label for="nameBasic" class="form-label">Bulan</label>
                            <input type="month" name="bulan" id="bulan" class="form-control" />
                    </div>
            </div>
        </div>
                    
        <div class="card m-3" id="tabel" style="display:none">
            <div class="d-flex align-items-end row">
                <!-- <div class="col-sm-12"> -->
                    <div class="card-body" id="tabel-print">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Rating Laporan</h6>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Instruktur</th>
                                        <th>Email</th>
                                        <th class="text-center">Total Pemeriksaan</th>
                                        <th class="text-center">Rating</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody  id="data-tabel" style="font-size:13px;">

                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- </div> -->

                <div class="row" style="display:none" id="btn-print">
                    <div class="col-3">
                        <button class="btn btn-danger" onclick="printFunc();">Print</button>
                    </div>
                </div>
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

     $(document).on('change', '#bulan', function() {
        var id = $('#bulan').val();
        $( "#btn-print" ).hide();
		var dt = new Date( id);
		var year = dt.getFullYear();
		var month =  (dt.getMonth() +1);

		if(month < 10){
			month = "0" + month;
		}
        $('#data-tabel').find('tr').remove().end();
        $.ajax({
			url: '{{ url('admin/rating/data') }}/'+year+"/"+month,
			dataType: "json",
			success: function(data) {
				var kk = jQuery.parseJSON(JSON.stringify(data[0]));
				console.log(kk)
				$.each(kk, function(k, v) {
                    var keterangan = "";
                    var kelas = "";
                    if(v.rating <=2){
                        keterangan ="Evaluasi";
                        kelas ="text-warning";
                    }else if(v.rating >2 && v.rating <=3){
                        keterangan ="Kurang Memuaskan";
                        kelas ="text-danger";
                    }else if(v.rating >3 && v.rating <=4){
                        keterangan ="Baik";
                        kelas ="text-info";
                    }else if(v.rating >4 && v.rating <=5){
                        keterangan ="Sangat Memuaskan";
                        kelas ="text-success";
                    }
					$('#data-tabel').append($('<tr/>', )
                        .append($('<td/>',{class:'span', html: k+1}))
                        .append($('<td/>',{class:'span', html: v.nama}))
                        .append($('<td/>',{class:'span', html: v.email}))
                        .append($('<td/>',{class:'text-center span', html: v.total+" x"}))
						.append($('<td/>',{class:'text-center span', html: v.rating+" / 5 <i class='bx bxs-star'>"}))
                        .append($('<td/>',{class:'text-center span '+kelas, html: keterangan}))
                    )

                    $( "#btn-print" ).show();
				})

                $( "#tabel" ).show();
			}
		});
    });

    // $( ".active" ).removeClass( "active" );
    $( "#admin-menu-rating" ).addClass( "active" );
});

function printFunc() {
    var divToPrint = document.getElementById('tabel-print');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write("<h3 align='center'>PT POLIGRAF INDONESIA</h3>");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}
</script>
@endsection