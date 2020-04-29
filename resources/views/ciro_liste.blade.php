@if(isset($cirolar) && count($cirolar)>0)
    <table class='table table-hover table-condenced table-striped table-bordered'>
        <thead>
            <tr>
                <th class='text-center'>Mal Kodu</th>
                <th class='text-center'>Mal Adı</th>
                <th class='text-center'>Net Satış Tutarı</th>
                <th class='text-center'>Net Satış Miktarı</th>
                <th class='text-center'>Net Satış Kg</th>
            </tr>
        </thead>
        <tbody>
            @php($toplam=0)
            @php($toplamm=0)
            @php($toplamkg=0)
    @foreach ($cirolar as $ciro)
            @php($toplam += $ciro->NetSatisTutar)
            @php($toplamm += $ciro->NetSatisMiktar)
            @php($toplamkg += $ciro->NetSatisKg)
            
        <tr>
            <td>{{ $ciro->MALKOD}}</td>
            <td>{{$ciro->STKKRT_MALAD}}</td>
            <td class='text-right'>{{number_format($ciro->NetSatisTutar,2,'.',',') }}</td>
            <td class='text-right'>{{number_format($ciro->NetSatisMiktar,2,'.',',')}}</td>
            <td class='text-right'>{{number_format($ciro->NetSatisKg,2,'.',',')}}</td>
        </tr>
    @endforeach
        <tr>
            <th colspan='2'>Toplam </th>
            <th class='text-right'>{{ number_format($toplam,2,'.',',') }}</th>
            <th class='text-right'>{{ number_format($toplamm,2,'.',',') }}</th>
            <th class='text-right'>{{ number_format($toplamkg,2,'.',',') }}</th>
        </tr>
        </tbody>
    </table>

@endif