<?php
$i = 0;
?>

@foreach($grup_liste as $g)
    <?php
            $i++;
            ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#a{{ $i }}" aria-expanded="true" aria-controls="a{{ $i }}">
                        {{ $g->GRUPKOD }}
                    </a>
                </h4>
            </div>
            <div id="a{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div style="" aria-expanded="true" id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                    <ul class="list-group">

    @foreach($urun_liste as $u)
        @if($u->GRUPKOD == $g->GRUPKOD)
                        <li class="list-group-item">
                            {{ $u->MALAD }}
                                <a href="#" class="close" data-dismiss="modal" onclick="UrunFiyat('{{ $u->MALKOD }}'); UrunSec('{{ $u->MALKOD }}','{{ $u->MALAD }}');"> <i class="fa fa-check-square-o"></i> </a>
                            </li>
          @endif
    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach