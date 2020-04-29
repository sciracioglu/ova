<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('sevk',"Sevk Yeri") !!}
			{!! Form::select('sevk',$svk,'',['class'=>'form-control','required','onchange'=>'SevkAdres($(this).val())']) !!}
		</div>

	</div>
	<div class="col-md-8 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('adres',"Sevk Adresi") !!}
			<div id="sevkAdres"></div>
		</div>

	</div>
	
</div>

<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('odeme',"Ödeme Tipi") !!}
			{!! Form::select('odeme', $odm,'02',['class'=>'form-control','required']) !!}
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="form-group">
			{!! Form::label('teslim',"Teslim Tarihi") !!}
			<div class="input-group">
				{!! Form::text('teslim',date('d/m/Y'),['class'=>'form-control','required','placeholder'=>"Teslim Tarihi"]) !!}
				<span class="input-group-addon"><i class="fa fa-calendar"></i> </span>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-sm-3 col-xs-3">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">

					{!! Form::label('opsiyon',"Opsiyon") !!}
					<div class="input-group">
						{!! Form::select('opsiyon', ['30'=>'30','60'=>'60','90'=>'90','120'=>'120','150'=>'150','180'=>'180'],'120',['class'=>'form-control','required','onchange'=>'TarihHesap()']) !!}
						<span class="input-group-addon">Gün</span>
					</div></div>


			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-12 control-label">Vade Tarihi</label>
					<div class="col-sm-12">
						<p class="form-control-static" id="tarih_hesap"></p>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('nakliye',"Nakliye Tipi") !!}
			{!! Form::select('nakliye', $nak,'1',['class'=>'form-control','required']) !!}
		</div>
	</div>
	<div class="col-md-8 col-sm-6 col-xs-6">
		<div class="form-group">
			{!! Form::label('aciklama',"Açıklama") !!}
			{!! Form::text('aciklama',null,['class'=>'form-control','placeholder'=>"Açıklama"]) !!}
		</div>
	</div>
</div>
<hr style='margin:2px 0 2px;'>