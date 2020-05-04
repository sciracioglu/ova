@extends('layouts.master')

@section('title')
    Tahsilat
@endsection

@section('content')
<div id='app'>
    <div class="accordion" id="tahsilat_yil">
        <div class="card" :id="yil.yil"  v-for='yil in yillar'>
            <div class="card-header">
                <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#yil'+yil.yil" @click='ac(yil)' aria-expanded="true" :aria-controls="'yil'+yil.yil">
                        <div class="row">
                            <div class="col-md-4"> @{{ yil.yil }}</div>
                            <div class="col-md-4" style="text-align:right;">
                                <span v-text='format(yil.evrak_tutar,"Evrak Tutar")'></span>
                            </div>
                            <div class="col-md-4" style="text-align:right;">
                                <span v-text='format(yil.tutar,"Tutar")'></span>
                            </div>
                        </div>
                    </a>
                 </h4>
                <div :id="'#yil'+yil.yil" class="collapse" :class='[yil == yil.yil ? "show" : ""]' aria-labelledby="headingOne" data-parent="#tahsilat_yil">
                    <div class="card-body">

                        <div class="accordion" id="tahsilat_ay">
                            <div class="card" :id="yil.yil+ay.ay"  v-for='ay in aylar'>
                                <div class="card-header">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#ay'+yil.yil+ay.ay" aria-expanded="false" :aria-controls="'ay'+yil.yil+ay.ay">
                                            <div class="row">
                                                <div class="col-md-4"> @{{ ay.ay }}</div>
                                                <div class="col-md-4" style="text-align:right;">
                                                    <span v-text='format(ay.evrak_tutar,"Evrak Tutar")'></span>
                                                </div>
                                                <div class="col-md-4" style="text-align:right;">
                                                    <span v-text='format(ay.tutar,"Tutar")'></span>
                                                </div>
                                            </div>
                                        </a>
                                    </h4>
                                    <div id="'#ay'+yil.yil+ay.ay" class="collapse" aria-labelledby="headingOne" data-parent="#tahsilat_ay">
                                        <div class="card-body">
                                                detay
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
    <div v-for='yil in yillar' class="row">
        <div class="col-md-2" >
            <span v-text='yil.yil'></span>
        </div>
        <div class="col-md-2" style="text-align:right;">
            Evrak Tutar : <span  v-text='format(yil.evrak_tutar)'></span>
        </div>
        <div class="col-md-2" style="text-align:right;">
            Tutar : <span v-text='format(yil.tutar)'></span>
        </div>
        <div v-if='yil != 0 && ay.yil === yil' v-for='ay in aylar' class="row">
            <div class="col-md-2" >
                <span v-text='ay.ay'></span>
            </div>
            <div class="col-md-2" style="text-align:right;">
                Evrak Tutar : <span  v-text='format(ay.evrak_tutar)'></span>
            </div>
            <div class="col-md-2" style="text-align:right;">
                Tutar : <span v-text='format(ay.tutar)'></span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var vue = new Vue({
    el:'#app',
    data:{
        yil:0,
        ay:0,
        yillar:{!! $yillar !!},
        aylar:{!! $aylar !!},
        tahsilatlar:{!! $tahsilatlar !!},
    },
    methods:{
        format(rakam,title){
                return  title + ' ' + numeral(rakam) . format('0,0.00');
        },
        ac(yil){
            this.yil = yil;
        }
    }
});
</script>
@endsection