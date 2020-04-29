@if(count($liste)>0)

    <table class="table table-stripped table-condensed table-hover">
        <thead>
        <tr>

            <th>Evrak No</th>
            <th>Evrak Tarihi</th>

            <th></th>

        </thead>
        <tbody>
        <?php
        $evraktip = \Illuminate\Support\Facades\Session::get('evraktip');
        ?>
        @foreach($liste as $s)
            <?php

            list($y, $a, $g) = explode('-', $s->EVRAKTARIH);

            ?>
            <tr>

                <td>{{ $s->EVRAKNO }}</td>
                <td>{{ $g }}.{{ $a }}.{{ $y }}</td>

                <td style="text-align: right">

                    <a href="/siparis/duzenle/{!! $s->EVRAKNO !!}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Duzenle</a>

                    <a href="/siparis/detay/{!! $s->EVRAKNO !!}" class="modallink btn btn-xs btn-primary" data-title="{{ $s->EVRAKNO }}" data-target="#bilgi">
                       <i class="fa fa-search"></i> Detay
                    </a>
                    {!! Form::open([
                    'method'=>'delete',
                    'data-remote',
                    'route'=>["siparis.destroy",$s->EVRAKNO],
                    'data-success-message'=> 'Sipariş Silindi.',
                    'data-failed-message'=> 'Sipariş Silinemedi!',
                    'data-success-trigger' => "SiparisListe()",

                    'style'=>"display:inline"]) !!}

                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Sipariş Sil</button>

                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    Sipariş kaydı bulunamadı.
@endif