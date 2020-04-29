@extends('layouts.master')


@section('title')
   Prim ve İadeler
@stop


@section('content')
<style>
.temel:hover{
   background: -moz-linear-gradient(top, rgba(161,219,255,0.6) 0%, rgba(161,219,255,0.6) 100%);
background: -webkit-linear-gradient(top, rgba(161,219,255,0.6) 0%,rgba(161,219,255,0.6) 100%);
background: linear-gradient(to bottom, rgba(161,219,255,0.6) 0%,rgba(161,219,255,0.6) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99a1dbff', endColorstr='#99a1dbff',GradientType=0 );
}
</style>
<div id='app'>
   <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

         <div class="panel panel-default" v-for='tip in tipler' >
               <div class="panel-heading temel" role="tab" id="headingOne">
                 <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#c'+tip.EVRAKTIP" aria-expanded="true" aria-controls="collapseOne">
                        <div class="row">
                                 <div class="col-md-6"> @{{ tip.EVRAKTIPAD }}</div>
                                 <div class="col-md-2" style="text-align:right;">
                                    <span v-text='format(tip.GENELNETTOPLAM,"Net Toplam",1)'></span>
                                 </div>
                                 <div class="col-md-2" style="text-align:right;">
                                    <span v-text='format(tip.GENELKDV,"Kdv",1)'></span>
                                 </div>
                                 <div class="col-md-2" style="text-align:right;">
                                    <span v-text='format(tip.GENELTOPLAM,"Toplam",1)'></span>
                                 </div>
                              </div> 
                   </a>
                 </h4>
               </div>
               <div :id="'c'+tip.EVRAKTIP" class="panel-collapse collapse" role="tabpanel">
                 <div class="panel-body">
                   <div class="panel-group" :id="'tip'+tip.EVRAKTIP" role="tablist" aria-multiselectable="true">

      <div class="panel panel-default" v-for='yil in yillar' v-if='yil.EVRAKTIP == tip.EVRAKTIP' >
        <div class="panel-heading temel" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" :data-parent="'#tip'+tip.EVRAKTIP" :href="'#a'+tip.EVRAKTIP+yil.EVRAKYIL" aria-expanded="true" aria-controls="collapseOne">
               <div class="row">
                  <div class="col-md-6"> @{{ yil.EVRAKYIL }}</div>
                  <div class="col-md-2" style="text-align:right;">
                     <span v-text='format(yil.GENELNETTOPLAM,"Net Toplam")'></span>
                  </div>
                  <div class="col-md-2" style="text-align:right;">
                     <span v-text='format(yil.GENELKDV,"Kdv")'></span>
                  </div>
                  <div class="col-md-2" style="text-align:right;">
                     <span v-text='format(yil.GENELTOPLAM,"Toplam")'></span>
                  </div>
               </div>
            </a>
          </h4>
        </div>
        <div :id="'a'+tip.EVRAKTIP+yil.EVRAKYIL" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            <div class="panel-group" :id="'ay'+yil.EVRAKYIL" role="tablist" aria-multiselectable="true">

               <div class="panel panel-default" v-for='ay in aylar'  v-if='tip.EVRAKTIP == ay.EVRAKTIP && ay.EVRAKYIL == yil.EVRAKYIL'>
                 <div class="panel-heading temel" role="tab" id="headingOne">
                   <h4 class="panel-title">
                     <a role="button" data-toggle="collapse" :data-parent="'#ay'+yil.EVRAKYIL" :href="'#b'+tip.EVRAKTIP+yil.EVRAKYIL+ay.EVRAKAY" aria-expanded="true" aria-controls="collapseOne">
                           <div class="row">
                                 <div class="col-md-6">  @{{ ay.EVRAKAY }}. AY</div>
                                 <div class="col-md-2" style="text-align:right;">
                                       <span v-text='format(ay.GENELNETTOPLAM,"")'></span>
                                 </div>
                                 <div class="col-md-2" style="text-align:right;">
                                       <span v-text='format(ay.GENELKDV,"")'></span>
                                 </div>
                                 <div class="col-md-2" style="text-align:right;">
                                       <span v-text='format(ay.GENELTOPLAM,"")'></span>
                                 </div>
                              </div>   
                     </a>
                   </h4>
                 </div>
                 <div :id="'b'+tip.EVRAKTIP+yil.EVRAKYIL+ay.EVRAKAY" class="panel-collapse collapse" role="tabpanel">
                   <div class="panel-body">
                     <table class="table table-condenced table-hover">
                        <thead>
                           <tr>
                              <th>Mal Kod</th>
                              <th>Mal Ad</th>
                              <th style="text-align: right;font-size: 14px;">Miktar</th>
                              <th style="text-align: right;font-size: 14px;">Net Tutar</th>
                              <th style="text-align: right;font-size: 14px;">KDV</th>
                              <th style="text-align: right;font-size: 14px;">Toplam</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for='veri in veriler' v-if='tip.EVRAKTIP == veri.EVRAKTIP && veri.EVRAKAY == ay.EVRAKAY && veri.EVRAKYIL == ay.EVRAKYIL'>
                              <td>@{{ veri.MALKOD }}</td>
                              <td>@{{ veri.MALAD }}</td>
                              <td style="text-align: right;font-size: 14px;">
                                 <span v-text='format(veri.MIKTAR,"")'></span>
                              </td>
                              <td style="text-align: right;font-size: 14px;">
                                    <span v-text='format(veri.NETTUTAR,"")'></span>
                              </td>
                              <td style="text-align: right;font-size: 14px;">
                                 <span v-text='format(veri.KDV,"")'></span>   
                              </td>
                              <td style="text-align: right;font-size: 14px;">
                                 <span v-text='format(veri.TOPLAM,"")'></span>   
                              </td>
                             
                           </tr>
                        </tbody>
                     </table>
                   </div>
                 </div>
               </div>

            </div>
          </div>
        </div>
      </div>

   </div>
</div>
</div>
</div>


   </div>


</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
<script>
var vue = new Vue({
   el:'#app',
   data:{
      veriler:{!! $veriler !!},
      yillar:{!! $yillar !!},
      aylar:{!! $aylar !!},
      tipler:{!! $tipler !!},
      yil:null,
      ay:null,
   },
   methods:{
      url(id){
         return '#a'+id;
      },
      format(fiyat,msg,ust=0){
         if(ust ==1){
            return msg+": "+ parseFloat(fiyat).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');   
         }
         return parseFloat(fiyat).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      },
   }
})
</script>
@endsection