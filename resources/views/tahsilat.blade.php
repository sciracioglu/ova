@extends('layouts.master')

@section('title')
    Tahsilat
@endsection

@section('content')
<div id='app'>
    <div class="list-group">
        <a href='#ay' @click='yilAta(yil.yil)' class="list-group-item list-group-item-action " :class="[isYear(yil) ? 'active' :'']" v-if='yil in yillar'>
            <div class="row">
                <div class="col-md-4">@{{ yil.yil }}</div>
                <div class="col-md-4" v-text='format(yil.evrak_tutar,"Evrak Tutar : ")'></div>
                <div class="col-md-4" v-text='format(yil.tutar,"Tutar : ")'></div>
            </div>
            <div class="list-group" v-if='yil == yil.yil' id='ay'>
                <a href='#detay' @click='ayAta(ay.ay)' class="list-group-item list-group-item-action" :class="[isMonth(ay) ? 'active' :'']"  v-if='ay in aylar'>
                    <div class="row">
                        <div class="col-md-4">@{{ ay.ay }}</div>
                        <div class="col-md-4" v-text='format(ay.evrak_tutar,"Evrak Tutar : ")'></div>
                        <div class="col-md-4" v-text='format(ay.tutar,"Tutar : ")'></div>
                    </div>
                    <div class="list-group" id='detay'>
                        <table class="table table-condenced table-hover">
                            <thead>
                                <tr>
                                    <th>Evrak Tipi</th>
                                    <th>Evrak Tarihi</th>
                                    <th>Hesap Kodu</th>
                                    <th>Ünvanı</th>
                                    <th>Karşı Hesap Kodu</th>
                                    <th>Karşı Hesap Kart Ünvan</th>
                                    <th>Evrak Tutar</th>
                                    <th>Evrak Döviz Cinsi</th>
                                    <th>Evrak Döviz Kuru</th>
                                    <th>Tutar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if='tahsilat._EVRAKYIL == yil && tahsilat._EVRAKAY == ay' v-for='tahsilat in tahsilatlar'>
                                    <td>@{{ tahsilat.EVRAKTIP }}</td>
                                    <td>@{{ tahsilat.EVRAKTARIH }}</td>
                                    <td>@{{ tahsilat.HESAPKOD }}</td>
                                    <td>@{{ tahsilat.CARKRT_UNVAN }}</td>
                                    <td>@{{ tahsilat.KARSIHESAPKOD }}</td>
                                    <td>@{{ tahsilat.CRKKRS_UNVAN }}</td>
                                    <td>@{{ tahsilat.EVRAKTUTAR }}</td>
                                    <td>@{{ tahsilat.EVRAKDOVIZCINS }}</td>
                                    <td>@{{ tahsilat.EVRAKDOVIZKUR }}</td>
                                    <td>@{{ tahsilat.TUTAR }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </a>
            </>
        </a>
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
        yil:'',
        ay:'',
        yillar:{!! $yillar !!},
        aylar:{!! $aylar !!},
        tahsilatlar:{!! $tahsilatlar !!},
    },
    methods:{
        format(rakam,title){
                return  title + ' ' + numeral(rakam) . format('0,0.00');
        },
        isYear(yil){
            if(this.yil == yil.yil){
                return true;
            }
            return false;
        },
        isMonth(yil, ay){
            if(this.yil == ay.yil && this.ay == ay.ay){
                return true;
            }
            return false;
        },
        yilAta(yil){
            this.yil = yil;
        },
        ayAta(ay){
            this.ay = ay;
        }
    }
});
</script>
@endsection