
  <div class="row">
        <div class="col-md-12">
            @if(count($ceksenet)>0)

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($yil_ay as $ay)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="{{ $ay->YIL.'_'.$ay->AY }}">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#a{{ $ay->YIL.'_'.$ay->AY }}" aria-expanded="true" aria-controls="a{{ $ay->YIL.'_'.$ay->AY }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $ay->YIL.' - '.$ay->AY }}. AY 
                                        </div>
                                        <div class="col-md-6 text-right">
                                            {{ number_format($ay->TUTAR,2,',','.') }}
                                        </div>
                                    </div>
                            </a>
                            </h4>
                        </div>
                        <div id="a{{ $ay->YIL.'_'.$ay->AY }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{ $ay->YIL.'_'.$ay->AY }}">
                            <div class="panel-body">
                                <table class="table table-stripped table-hover">
                                        <thead>
                                        <tr>
                                            <th>İşlem Tipi</th>
                                            <th>Belge Numarası</th>
                                            <th>Belge Tutarı</th>
                                            <th>Vade Tarih</th>
                                            <th>Banka</th>
                                            <th>Banka Çek No</th>
                                            
                                        </thead>
                                        <tbody>
                                        @foreach ($ceksenet as $senet)
                                            @if($senet->YIL == $ay->YIL && $senet->AY == $ay->AY)
                                            <?php
                                                $tarih = \Carbon\Carbon::parse($senet->VADETARIH);
                                            ?>
                                            <tr>
                                                <td>{{ $senet->ISLEMTIP }}</td>
                                                <td>{{ $senet->BELGENO }}</td>
                                                <td>{{ number_format($senet->TUTAR,2,',','.') }}</td>
                                                <td>{{ $tarih->format('d.m.Y') }}</td>
                                                <td>{{ $senet->BANKAKOD }}</td>
                                                <td>{{ $senet->BANKABELGENO }}</td>
                                                
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
              

                
            @else
                Çek Senet Kaydı Bulunamadı.
            @endif

        </div>

    </div>