@extends('layouts.master')

@section('title')
Müsteri Satış Raporu
@endsection


@section('content')
    <div class="row" id='app'>
        <div class='col-md-3'>
            <form class="form-horizontal">
                <div class="form-group">
                    <label ><strong>Başlangıc Tarihi</strong></label>

                    <input class='form-control' type='text' name='baslangic' id='baslangic' />
                </div>
                <div class="form-group">
                    <label><strong>Bitis Tarihi</strong></label>

                    <input class='form-control' type='text' name='bitis' id='bitis' />
                </div>
                <div class="form-group">
                    <label ><strong>Bolge</strong></label>

                    <select name='bolge' id='bolge'  class='form-control'>
                            <option v-for='bolge in bolgeler' :value="bolge.KOD">@{{ bolge.ACIKLAMA }}</option>
                    </select>
                </div>
                <button class="btn btn-default" type="button" @click="detay()">Rapor Olustur</button>
            </form>
        </div>
        <div class='col-md-12' id='sonuc' style="margin-top:20px;"></div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
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
var vue = new Vue({
   el:'#app',
   data:{
      bolgeler:{!! $bolgeler !!},
      raporlar:null,

   },
   methods:{
     detay(){
         self=this;
              $.post("/musteri-satis",{'bolge':$('#bolge').val(),'baslangic':$('#baslangic').val(),'bitis':$('#bitis').val(),'_token':'{{ csrf_token() }}' },function(response){
                 $('#sonuc').html(response);
              })
          }
   }
})
</script>
@endsection