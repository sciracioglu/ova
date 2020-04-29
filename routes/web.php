<?php

Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
Route::post('/login', 'LoginController@postLogin');

Route::group(['middleware' => 'login'], function () {
    Route::get('/', 'AnaSayfaController@index');
    Route::post('/', ['as' => 'sec', 'uses' => 'AnaSayfaController@musteriSec']);

    Route::get('siparis', 'MusteriController@siparis');
    Route::post('siparis', [
        'as' => 'siparis', 'uses' => 'MusteriController@postSiparis']);
    Route::put('siparis/{id}', ['as' => 'siparis.update', 'uses' => 'MusteriController@siparisGuncel']);

    Route::get('siparis/urun', 'MusteriController@urunListe');
    Route::get('siparis/urunfiyat', 'MusteriController@urunFiyat');
    Route::get('siparis/urunsevk', 'MusteriController@urunSevk');
    Route::get('siparis/kalem', 'MusteriController@kalemListe');
    Route::get('siparis/detay/{id}', 'MusteriController@siparisDetay');
    Route::get('siparis/duzenle/{id}', 'MusteriController@siparisDuzenle');
    Route::get('siparis/opsiyon', 'MusteriController@opsiyon');

    Route::delete('siparis/kalem/{id}', ['as' => 'siparis.kalem.destroy', 'uses' => 'MusteriController@kalemSil']);

    Route::get('siparis/liste', 'MusteriController@siparisListe');
    Route::get('siparis_liste', 'MusteriController@siparisler');

    Route::delete('siparis/{id}', ['as' => 'siparis.destroy', 'uses' => 'MusteriController@siparisSil']);

    Route::get('cari', 'MusteriController@cari');
    Route::get('bakiye', 'MusteriController@bakiye');
    Route::get('risk', 'MusteriController@risk');
    Route::get('satis', 'MusteriController@satis');
    Route::get('satis_analiz', 'MusteriController@satis_analiz');
    Route::get('satis_analiz_miktar', 'MusteriController@satis_analiz_miktar');
    Route::get('geciken', 'MusteriController@geciken_bakiye');
    Route::get('detay', 'MusteriController@bakiye_detay');

    Route::get('ceksenet', 'MusteriController@cekSenet');

    Route::post('havale', 'HavaleController@store');
    Route::get('havale/create', 'HavaleController@create');

    Route::get('musteri', 'MusteriController@musteri');
    Route::get('siparislerim', 'MusteriController@siparislerim');

    Route::get('ciro/create', 'CiroController@create');
    Route::post('ciro', 'CiroController@store');

    Route::get('prim', 'PrimController@index');

    Route::get('musteri-satis', 'MusteriController@musteriSatisForm');
    Route::post('musteri-satis', 'MusteriController@musteriSatis');

    // mail gonderme
    Route::post('satis_analiz_miktar_mail', 'MailGonderController@satis_analiz_miktar');
    Route::post('satis_analiz_mail', 'MailGonderController@satis_analiz');
    Route::post('satis_mail', 'MailGonderController@satis');
    Route::post('risk_mail', 'MailGonderController@risk');
    Route::post('cari_mail', 'MailGonderController@cari');
    Route::post('cek_mail', 'MailGonderController@cek');
    Route::post('geciken_mail', 'MailGonderController@geciken_bakiye');
    Route::post('bakiye_detay', 'MailGonderController@bakiye_detay');

    Route::get('logout', 'LoginController@logout');
});
