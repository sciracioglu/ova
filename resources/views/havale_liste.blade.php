@if(isset($havaleler) && $havaleler->count()>0)
    <table class='table table-hover table-condenced table-striped'>
        <thead>
            <tr>
                <th>Hesap Kodu</th>
                <th>Unvan</th>
                <th>Tarih</th>
                <th>No</th>
                <th>Aciklama</th>
                <th>Tutar</th>
                <th>Tipi</th>
                <th>Banka</th>
            </tr>
        </thead>
        <tbody>
            @php($toplam=0)
    @foreach ($havaleler as $havale)
            @php($toplam += $havale->EVRAKTUTAR)
            <?php
            list($tar, $sat) = explode(' ',$havale->EVRAKTARIH);
            list($y,$a,$g) = explode('-',$tar);
            ?>
        <tr>
            <td>{{$havale->HESAPKOD}}</td>
            <td>{{ $havale->CARKRT_UNVAN}}</td>
            <td>{{$g.'/'.$a.'/'.$y}}</td>
            <td>{{$havale->EVRAKNO}}</td>
            <td>{{$havale->ACIKLAMA1}}</td>
            <td class='text-right'>{{number_format($havale->EVRAKTUTAR,2,'.',',')}}</td>
            <td>{{$havale->EVRAKTIPI}}</td>
            <td>{{$havale->CRKKRS_UNVAN}}</td>
        </tr>
    @endforeach
        <tr>
            <th colspan='5'>Toplam </th>
            <th class='text-right'>{{ number_format($toplam,2,'.',',') }}</th>
            <th></th>
            <th></th>
        </tr>
        </tbody>
    </table>

@endif