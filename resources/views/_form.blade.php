<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="form-group">
            {!! Form::label('malkod','Ürün Bilgisi') !!}


            {!! Form::hidden('malkod',null,['class'=>'form-control','required','readonly']) !!}
            <div class="input-group">
                {!! Form::text('malad',null,['class'=>'form-control','required','readonly','id'=>'malad']) !!}
                            <span class="input-group-btn">
                               <a href="/siparis/urun" class="modallink btn btn-primary" data-title="Urun Listesi" data-target="#bilgi"><i class="fa fa-search"></i>
                               </a>
                            </span>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
        <div class="form-group">
            {!! Form::label('urun_fiyat',"Liste Fiyatı") !!}
            <div class="input-group">
                {!! Form::text('urun_fiyat',null,['class'=>'form-control']) !!}
                <span class="input-group-addon"><i class="fa fa-try"></i> </span>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
        <div class="form-group">
            {!! Form::label('oran',"İskonto") !!}
            <div class="input-group">
                <span class="input-group-addon">%</span>
                {!! Form::text('oran',null,['class'=>'form-control','required','placeholder'=>trans(""),'min'=>'0','max'=>'100','onblur'=>'FiyatHesap()']) !!}

            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
        <div class="form-group">
            {!! Form::label('fiyat',"Fiyat") !!}
            <div class="input-group">
                {!! Form::text('fiyat',null,['class'=>'form-control','required','onblur'=>'IskontoHesap()']) !!}
                <span class="input-group-addon"><i class="fa fa-try"></i> </span>
            </div>
        </div>
    </div>

    <div class="col-md-1 col-sm-2 col-xs-3">
        <div class="form-group">
            {!! Form::label('kdv',"KDV") !!}
            <div class="input-group">

                {!! Form::text('kdv',null,['class'=>'form-control','readonly']) !!}

            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-3">
        <div class="form-group">
            {!! Form::label('miktar',"Miktar") !!}
            {!! Form::text('miktar',null,['class'=>'form-control','required','placeholder'=>trans("")]) !!}
        </div>
    </div>


</div>