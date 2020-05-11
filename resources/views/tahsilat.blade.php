@extends('layouts.master')


@section('title')
   Tahsilat
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
      <div class="panel panel-default" v-for='yil in yillar'>
         <div class="panel-heading temel" role="tab" id="headingOne">
               <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" :href="'#a'+yil.yil" aria-expanded="true" aria-controls="collapseOne">
                     <div class="row">
                        <div class="col-md-8"> @{{ yil.yil }}</div>
                        <div class="col-md-4" style="text-align:right;">
                           <span v-text='format(yil.tutar,"Tutar : ")'></span>
                        </div>
                     </div>
                  </a>
               </h4>
         </div>
         <div :id="'a'+yil.yil" class="panel-collapse collapse" role="tabpanel">
               <div class="panel-body">
                  <div class="panel-group" :id="'ay'+yil.yil" role="tablist" aria-multiselectable="true">
                     <div class="panel panel-default" v-for='ay in aylar'  v-if='ay.yil == yil.yil'>
                        <div class="panel-heading temel" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" :data-parent="'#ay'+yil.yil" :href="'#b'+yil.yil+ay.ay" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="row">
                                          <div class="col-md-8">  @{{ ay.tam_ay }}</div>
                                          <div class="col-md-4" style="text-align:right;">
                                                <span v-text='format(ay.tutar,"Tutar : ")'></span>
                                          </div>
                                    </div>
                                 </a>
                              </h4>
                        </div>
                        <div :id="'b'+yil.yil+ay.ay" class="panel-collapse collapse" role="tabpanel">
                           <div class="panel-body">
                              <table class="table table-condenced table-hover">
                                    <thead>
                                       <tr>
                                             <th>Evrak Tipi</th>
                                             <th>Evrak Tarihi</th>

                                             <th>Evrak Tutar</th>
                                             <th>Evrak Döviz Cinsi</th>
                                             <th>Evrak Döviz Kuru</th>
                                             <th>Tutar</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr  v-for='tahsilat in tahsilatlar' v-if='tahsilat._EVRAKYIL == ay.yil && tahsilat._EVRAKAY == ay.tam_ay'>
                                             <td>@{{ tahsilat.EVRAKTIP }}</td>
                                             <td>@{{ tahsilat.EVRAKTARIH }}</td>
                                             <td v-text="format(tahsilat.EVRAKTUTAR)"></td>
                                             <td>@{{ tahsilat.EVRAKDOVIZCINS }}</td>
                                             <td v-text="format(tahsilat.EVRAKDOVIZKUR)">@{{ tahsilat.EVRAKDOVIZKUR }}</td>
                                             <td v-text="format(tahsilat.TUTAR)"  style="text-align: right;">@{{ tahsilat.TUTAR }}</td>
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


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
var vue = new Vue({
   el:'#app',
   data:{
      tahsilatlar:{!! $tahsilatlar !!},
      yillar:{!! $yillar !!},
      aylar:{!! $aylar !!},
   },
   methods:{
      url(id){
         return '#a'+id;
      },
      format(fiyat,msg=null){
          if(msg){
              return msg+": "+ numeral(fiyat).format('0,0.00');
          }
          return numeral(fiyat) . format('0,0.00');

      },
   }
})
</script>
@endsection
