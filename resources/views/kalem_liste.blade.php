@if(count($kalemler)>0)
    <table class="table table-bordered table-condensed table-hover">
        <thead>
        <tr>
            <th class="text-center">Mal Adı</th>
            <th class="text-center">Miktar</th>
            <th class="text-center">Fiyat</th>
            <th class="text-center">Iskonto</th>
            <th class="text-center">KDV</th>
            <th class="text-center">Toplam</th>
            <th></th>

        </thead>
        <tbody>
        <?php
        $genTop = 0;
        $genIsk = 0;
        $genKdv = 0;
        ?>
        @foreach($kalemler as $k)
            <?php
            $tutar = $k->FIYAT * $k->MIKTAR;
            $kdv = $tutar * $k->KDVORAN / 100;
            $iskonto = $tutar *$k->ISKONTOORAN / 100;
            $netTutar = $tutar - $iskonto + $kdv;

            $genTop += $netTutar;
            $genIsk += $k->ISKONTOORAN;
            $genKdv += $kdv;
            ?>
            <tr>
                <td>{{ $k->MALAD }}</td>
                <td class="text-right">{{ number_format($k->MIKTAR,0) }}</td>

                <td class="text-right">{{ number_format($k->FIYAT,2,',','.') }} <i class="fa fa-try"></i></td>
                <td class="text-right">{{ number_format($iskonto,2,',','.') }} <i class="fa fa-try"></i></td>
                <td class="text-right">{{ number_format($kdv,2,',','.') }} <i class="fa fa-try"></i></td>
                <td class="text-right">{{ number_format($netTutar,2,',','.') }} <i class="fa fa-try"></i></td>
                <td style="text-align: right">
                    {!! Form::open([
                    'method'=>'delete',
                    'data-remote',
                    'route'=>["siparis.kalem.destroy",$k->HID],
                    'data-success-message'=> 'Kalem Silindi',
                    'data-failed-message'=> 'Kalem Silinemedi',
                    'data-success-trigger' => "KalemListe()",
                    'style'=>"display:inline"]) !!}

                    <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Sil</button>

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="3">Genel Toplam</th>
                <th class="text-right">{{ number_format($genIsk,2,',','.') }} <i class="fa fa-try"></i></th>
                <th class="text-right">{{ number_format($genKdv,2,',','.') }} <i class="fa fa-try"></i></th>
                <th class="text-right">{{ number_format($genTop,2,',','.') }} <i class="fa fa-try"></i></th>
                <th></th>
            </tr>
        </tfoot>

    </table>
@else
    Sipariş kaydı bulunamadı.
@endif
