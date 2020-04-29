<table class='table table-condenced table-hover table-bordered'>
    <thead>
        <tr>
            <th class="text-center">Hesap Kodu</th>
            <th class="text-center">Ünvanı</th>
            <th class="text-center">Satış Miktar</th>
            <th class="text-center">Satış Miktar 2 Kg.</th>
            <th class="text-center">Satış Çuval Adeti</th>
            <th class="text-center">Satış Tutar</th>
            <th class="text-center">Alinan Fiyat Farkı - <br>Satış Primi Net Tutar</th>
            <th class="text-center">Çuval Başı<br>Satış Primi</th>
            <th class="text-center">Satış Prim Oranı</th>
            <th class="text-center">Satış Net Tutarı</th>
            <th class="text-center">Satıştan Alınan<br> Fiyat Farki Miktar</th>
            <th class="text-center">Satışdan<br>İade Miktar</th>
            <th class="text-center">Satışdan<br>İade Miktar 2 Kg.</th>
            <th class="text-center">Satışdan<br>İade Net Tutar</th>
        </tr>		  	  	  	  	  	  	  	  	  	  	  	  	
    </thead>
    <tbody>
            @php
            $top_01 = 0;
            $top_02 = 0;
            $top_03 = 0;
            $top_04 = 0;
            $top_05 = 0;
            $top_06 = 0;
            $top_07 = 0;
            $top_08 = 0;
            $top_09 = 0;
            $top_10 = 0;
            $top_11 = 0;
            $top_12 = 0;
 
         @endphp
        @foreach($veriler as $veri)
        <tr>
            <td>{{ $veri->HESAPKOD }}</td>
            <td>{{ $veri->CARKRT_UNVAN }}</td>
            <td class='text-right'>{{ number_format($veri->MIKTAR_17,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->MIKTAR2_17,2,',','.') }}</td>
            <td class='text-right'>{{ number_format($veri->SATIS_CUVAL_ADETI,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->NETTUTAR_17,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->NETTUTAR_20,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->CUVAL_BASI_SATIS_PRIMI,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->SATIS_PIRIM_ORANI,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->SATIS_NET_TUTARI,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->MIKTAR_20,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->MIKTAR_18,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->MIKTAR2_18,2,',','.')  }}</td>
            <td class='text-right'>{{ number_format($veri->NETTUTAR_18,2,',','.')  }}</td>
        </tr>
        @php
           $top_01 += $veri->MIKTAR_17;
           $top_02 += $veri->MIKTAR2_17;
           $top_03 += $veri->SATIS_CUVAL_ADETI;
           $top_04 += $veri->NETTUTAR_17;
           $top_05 += $veri->NETTUTAR_20;
           $top_06 += $veri->CUVAL_BASI_SATIS_PRIMI;
           $top_07 += $veri->SATIS_PIRIM_ORANI;
           $top_08 += $veri->SATIS_NET_TUTARI;
           $top_09 += $veri->MIKTAR_20;
           $top_10 += $veri->MIKTAR_18;
           $top_11 += $veri->MIKTAR2_18;
           $top_12 += $veri->NETTUTAR_18;
        @endphp
        @endforeach
        <tr>
            <th></th>
            <th></th>
            <th class="text-right">{{ number_format($top_01,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_02,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_03,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_04,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_05,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_06,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_07,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_08,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_09,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_10,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_11,2,',','.') }}</th>
            <th class="text-right">{{ number_format($top_12,2,',','.') }}</th>
        </tr>
    </tbody>
</table>
