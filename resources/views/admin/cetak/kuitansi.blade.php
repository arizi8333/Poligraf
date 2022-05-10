<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .div-class {
        position: relative;
    }

    .inner-image {
        position: absolute;
    }
    
</style>
</head>
<body>
    <div class="row">
        <div class="text-center">
            <table class="text-center" style="width:100%;">
                <tr>
                    <td style="width:20%">
                        <img src="{{public_path('Logo/logo-1.png')}}" width="120">
                    </td>
                    <td style="width:60%">
                        <div style="font-size:15px"><b>PT. POLIGRAF INDONESIA</b></div>
                        <div style="font-size:15px"><b><i>RISK ASSESSMENT SERVICES</i></b></div><br>
                        <div style="font-size:14px">TAMAN WISMA ASRI 2</div>
                        <div style="font-size:14px">BLOK CC40/03 - KOTA BEKASI - JAWA BARAT 17121</div>
                        <div style="font-size:14px">021 - 8897 4097 / 0812 - 77 366636 (hotline)</div>
                        <div style="font-size:14px"><u>sales@poligrafindonesia.id</u> - <u>www.poligrafindonesia.id</u></div>
                    </td>
                    <td style="width:20%">
                        <img src="{{public_path('logo/logo-2.png')}}" width="110">
                    </td>
                </tr>
            </table>
            <hr style="border: 1px solid black;margin-bottom:0px">
            <hr style="border: 2px solid black;margin-top:1px;margin-bottom:30px">

            <div style="font-size:16px;letter-spacing:4px"><b><u>KUITANSI</u></b></div>
            <div style="font-size:13px;"><b><u>No. {{str_replace('QT','LOP/Paid',$data[0]->pemesanan_id)}}</u></b></div>
        </div>
        <div style="margin-left:60px;margin-right:60px;margin-top:20px;">
            <table style="width:100%;font-size:13px;">
                <tr>
                    <td style="width:40%">Sudah terima dari</td>
                    <td style="width:60%">
                        : {{$data[0]->pemesanan->user->companies}}
                    </td>
                </tr>
                <tr>
                    <td style="width:40%"><b>Jumlah uang</b></td>
                    <td style="width:60%">
                        : <b>Rp. {{$data[0]->pemesanan->total_harga}}</b>
                    </td>
                </tr>
                <tr>
                    <td style="width:40%">Terbilang</td>
                    <td style="width:60%;text-transform: capitalize;">
                        : {{ Riskihajar\Terbilang\Facades\Terbilang::make($data[0]->pemesanan->total_harga)}} Rupiah
                    </td>
                </tr>
                <tr>
                    <td style="width:40%">Untuk Pembayaran</td>
                    <td style="width:60%">
                        : 
                    </td>
                </tr>
            </table>

            <table style="margin-top:40px;width:100%;font-size:13px;border: 1px solid;">
                    <tr style="border: 1px solid;text-align: center">
                        <th width="30px" height="35px" style="border: 1px solid;">No</th>
                        <th height="35px" style="border: 1px solid;">
                            Nama Barang / Jasa
                        </th>
                        <th height="35px" width="50px" style="border: 1px solid;">
                            Qty
                        </th>
                        <th height="35px" style="border: 1px solid;">
                            Harga Satuan Rp
                        </th>
                        <th height="35px" style="border: 1px solid;">
                            Total Harga Rp
                        </th>
                    </tr>
                    @foreach($data as $key => $d)
                    <tr style="border: 1px solid">
                        <td style="border: 1px solid;text-align: center">{{$key+1}}</td>
                        <td style="border: 1px solid;">{{$d->layanan->nama_layanan}}</td>
                        <td style="border: 1px solid;text-align: center">{{$d->jumlah_terperiksa}}</td>
                        <td style="border: 1px solid;text-align: center">{{$d->layanan->harga}}</td>
                        <td style="border: 1px solid;text-align: center">{{$d->layanan->harga * $d->jumlah_terperiksa}}</td>
                    </tr>
                    @endforeach
                    <tr style="border: 1px solid;">
                        <th height="35px" style="padding-right:10px;border: 1px solid;text-align: right" colspan="4">Total Payment Yang Harus Dibayarkan</th>
                        <th height="35px" style="border: 1px solid;text-align: center">{{$data[0]->pemesanan->total_harga}}</th>
                    </tr>
            </table>

            <div style="margin-top:30px;font-size:13px">
                <table style="width:100%;font-size:13px;">
                    <tr>
                        <td style="width:60%"></td>
                        <th style="width:40%">Jakarta, {{Carbon\Carbon::now()->format('d F Y')}}</th>
                    </tr>
                    <tr>
                        <td style="width:60%">Mengetahui</td>
                        <td style="width:40%">
                            Yang menerima,
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <img src="{{public_path('Logo/TTD-Stamp-Transparent.png')}}" width="130px">
                        </td>
                    </tr>
                    <tr>
                        <td>( ..................... )</td>
                        <td>
                            <u>Agung Prasetya, S.Si</u>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            Direktur
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>