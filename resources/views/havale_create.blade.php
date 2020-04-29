@extends('layouts.master')


@section('title')
  Gelen Havale ve Kredi Karti Tahsilatlari
@stop


@section('content')
<div class="row">
    <div class="col-md-12">
        <form>
            <div class='row'>
                <div class='col-md-3 col-sm-3 col-xs-4'>
                        <div class='form-group'>
                                <input type='text' id='baslangic' name='baslangic' placeholder='Baslangic Tarihi' class='form-control' />
                            </div>
                </div>
                <div class='col-md-3 col-sm-3 col-xs-4'>
                        <div class='form-group'>
                                <input type='text' id='bitis' name='bitis' placeholder='Bitis Tarihi' class='form-control' />
                            </div>
                </div>
                <div class='col-md-3 col-sm-3 col-xs-4'>
                        <button type='button' class='btn btn-primary' onclick='tahsilat();'>Tamam</button>
                </div>
            
            
                
        </form>
    </div>
    <div class='col-md-12' id='sonuc'></div>
</div>
@stop

@section('scripts')
<script>
        $( function() {
            $('#baslangic').datetimepicker({
                timepicker:false,
                format:'d/m/Y'
            });
            $('#bitis').datetimepicker({
                timepicker:false,
                format:'d/m/Y'
            });
          } );

          function tahsilat(){
              $.post("/havale",{'tarih1':$('#baslangic').val(),'tarih2':$('#bitis').val(),'_token':'{{ csrf_token() }}' },function(response){
                 $('#sonuc').html(response);
              })
          }
</script
@stop