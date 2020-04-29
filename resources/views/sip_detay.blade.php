<h4>{{ $siparis->SEVKUNVAN }}</h4>
<hr>
<form class="form-horizontal">
        <div class="form-group">
            {!! Form::label('sevk',"Sevk Yeri") !!}
            <p>{{ $siparis->TESLIMADRES1 }} {{ $siparis->TESLIMADRES2 }}{{ $siparis->TESLIMADRES3 }}{{ $siparis->TESLIMADRES4 }}{{ $siparis->TESLIMADRES5 }}</p>
            <p>{{ $siparis->TELEFON1 }}</p>
        </div>

<div class="row">

    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            {!! Form::label('teslim',"Teslim Tarihi") !!}
                {{ $siparis->TESLIMTARIH }}

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            {!! Form::label('opsiyon',"Opsiyon") !!}
                {{ $siparis->OPSIYONGUN }} Gun
        </div>
    </div>
</div>
    </form>

<hr>

<div class="row">
    <div class="col-md-12" id="kalemler">
        @include('kalem_liste')
    </div>
</div>

