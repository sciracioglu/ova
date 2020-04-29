
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Hesap Kodu</strong></label>

        <div class="col-sm-9 col-xs-9 col-md-9">
            <p class="form-control-static">{{ $musteri->HESAPKOD }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Unvan</strong></label>

        <div class="col-sm-9 col-xs-9 col-md-9">
            <p class="form-control-static">{{ $musteri->UNVAN }} {{ $musteri->UNVAN2 }}</p>
        </div>
    </div>


    <hr>
    <div class="form-group">
        <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Fatura Adresi</strong></label>

        <div class="col-sm-9 col-xs-9 col-md-9">
            <p class="form-control-static">
                {{ $musteri->FATURAADRES1 }} {{ $musteri->FATURAADRES2 }} {{ $musteri->FATURAADRES3 }} {{ $musteri->FATURAADRES4 }} {{ $musteri->FATURAADRES5 }} {{ $musteri->FATUARAADRESBINANO }}
                {{ $musteri->FATUARADRESBINAAD }} {{ $musteri->FATURAADRESDAIRENO }} {{ $musteri->FATURAADRESBOLGEAD }}</p>
        </div>
    </div>
    <hr>

            <div class="form-group">
                <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Vergi Dairesi</strong></label>

                <div class="col-sm-9 col-xs-9 col-md-9">
                    <p class="form-control-static">{{ $musteri->VERGIDAIRE }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Vergi Hesap No</strong></label>

                <div class="col-sm-9 col-xs-9 col-md-9">
                    <p class="form-control-static">{{ $musteri->VERGIHESAPNO }}</p>
                </div>
            </div>
    <hr>
            <div class="form-group">
                <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Telefon</strong></label>

                <div class="col-sm-9 col-xs-9 col-md-9">
                    <p class="form-control-static">{{ $musteri->TELEFON1 }} - {{ $musteri->TELEFON2 }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Faks</strong></label>

                <div class="col-sm-9 col-xs-9 col-md-9">
                    <p class="form-control-static">{{ $musteri->FAKS1 }} - {{ $musteri->FAKS2 }}</p>
                </div>
            </div>
    <div class="form-group">
        <label class="col-sm-3 col-xs-3 col-md-3 control-label"><strong>Email</strong></label>

        <div class="col-sm-9 col-xs-9 col-md-9">
            <p class="form-control-static">{{ $musteri->EMAIL1 }} </p>
        </div>
    </div>
    <hr>

</form>

