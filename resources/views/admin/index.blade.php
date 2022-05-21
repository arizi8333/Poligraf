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
    <div class="col-sm-4 mb-4 order-0">
        
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('Logo/unicons/wallet.png')}}" alt="Credit Card" class="rounded">
              </div>
            </div>
            <span>Pemesanan Masuk</span>
            <h3 class="card-title text-nowrap mb-1">{{$pemesanan}}</h3>
          </div>
        </div>

    </div>

    <div class="col-sm-4 mb-4 order-0">
        
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('Logo/unicons/chart.png')}}" alt="Credit Card" class="rounded">
              </div>
            </div>
            <span>Instruktur</span>
            <h3 class="card-title text-nowrap mb-1">{{$user}}</h3>
          </div>
        </div>

    </div>

    <div class="col-sm-4 mb-4 order-0">
        
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('Logo/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
              </div>
            </div>
            <span>Layanan</span>
            <h3 class="card-title text-nowrap mb-1">{{$layanan}}</h3>
          </div>
        </div>

    </div>

    <div class="col-lg-4 mb-4 order-0">
      <b class="font-weight-bold">Filter Tahun</b>
      <input type="number" name="tahun" id="tahun" value="2022" min="2022" placeholder="2022" class="form-control">
    </div>
    <div class="col-lg-12 mb-4 order-0">
        <canvas id="grapik" style="min-height: 300px; height: 350px; max-height: 350px; max-width: 100%; display: block; width: 487px;" width="487" height="250"></canvas>
    </div>
    
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/2.0.2/luxon.min.js" integrity="sha512-frUCURIeB0OKMPgmDEwT3rC4NH2a4gn06N3Iw6T1z0WfrQZd7gNfJFbHrNsZP38PVXOp6nUiFtBqVvmCj+ARhw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    
    $(document).ready( function () { 
    var tahun = $('#tahun').val(2022);  
    graphline(tahun);

    function graphline(tahun){
      $.ajax({
          url: '{{ url('grapik/admin') }}/'+tahun,
          method: "GET",
          dataType: "json",
          success: function (data) {
              var label = [];
              var value = [];
              var bg = ['rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'];
              var bc= [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                      ];
              console.log(data[0]);
              for (var i in data[0]) {
                  var nama = data[0][i]["layanan"].split(' ')[0];
                  label.push(nama);
                  value.push(data[0][i]["total"]);
                  // console.log(data[0][i]["max(pemasukan)"]);
              }

              
              console.log(label);
              console.log(value);
              var ctx = $('#grapik').get(0).getContext('2d');
              var chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: label,
                      datasets: [{
                        label: "Layanan",
                        backgroundColor: bg, 
                        borderColor: bc,
                        borderWidth: 1,
                        data: value
                      }]
                  },
                  options: {    
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4
                        }],
                        yAxes: [{
                            display: true,
                            stacked: true,
                            ticks: {
                                stepSize: 1,
                                min: 0, // minimum value
                            },
                            scaleLabel: {
                              display: true,
                              labelString: 'Total Pemesanan'
                            }
                        }]
                    }
                  }
              });
          }
      });  
    }

    $(document).on('change', '#tahun', function() {
        var id = $('#tahun').val();
        graphline(id);
    });

    $( "#admin-menu-dashboard" ).addClass( "active" );

});
</script>
@endsection