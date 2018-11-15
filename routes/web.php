<?php


Route::get('/','GlavniController@index');
Route::get('/vest/{id?}','GlavniController@vest')->name('vest');

//O meni
Route::get('/ja','GlavniController@getJa');

//Galerija
Route::get('/galerija','GalleryController@galerija');

//Postavljanje komentara na odredjenu vest
Route::post('/komentar/{vestId}', 'KomentarController@postavitiKomentar')->name('postavitiKomentar');

//Logovanje
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');

//Registracija
Route::get('/register','RegisterController@register')->name('register');
Route::post('/register/save','RegisterController@registerSave')->name('regSave');

//Anketa

Route::group(['prefix'=>'/ajax'],function(){
    Route::post('/anketa/glas','AnketaController@glas');
    Route::get('/rezultat','AnketaController@rezultat'); 
});
Route::group(['middleware'=>'admin'],function(){
    //Administriranje vesti
    Route::get('/vesti/{id?}','VestController@add')->name('vestAdd');
    Route::post('/vesti/save','VestController@sacuvaj')->name('saveVest');
    Route::post('/vesti/update/{id}','VestController@update');
    Route::get('/vesti/delete/{id}','VestController@delete');
    
    //Administriranje korisnika
    Route::get('/korisnik/{id?}','KorisnikController@addKorisnik')->name('add');
    Route::post('/korisnik/save','KorisnikController@save')->name('save');
    Route::post('/korisnik/update/{id}','KorisnikController@update');
    Route::get('/korisnik/delete/{id}','KorisnikController@delete');
    
    //Administriranje uloga
    Route::get('/uloga/{id?}','UlogeController@addUloga')->name('ulogeAdd');
    Route::post('/uloga/save','UlogeController@save');
    Route::post('/uloga/update/{id}','UlogeController@update');
    Route::get('/uloga/delete/{id}','UlogeController@delete');
    
    //Administriranje galerije
    Route::get('/gallery/{id?}','GalleryController@addPic')->name('addPic');
    Route::post('/gallery/save','GalleryController@savePic');
    Route::post('gallery/update/{id}','GalleryController@updatePic');
    Route::get('/gallery/delete/{id}','GalleryController@delPic');
    
    //Administriranje menija
    Route::get('/meni/{id?}','MeniController@add')->name('addMeni');
    Route::post('/meni/save','MeniController@save');
    Route::post('/meni/update/{id}','MeniController@update');
    Route::get('/meni/delete/{id}','MeniController@delete');
    
    //Administriranje komentara 
    Route::get('/komentar/{id?}','KomentarController@add')->name('addKomentar');
    Route::get('/komentar/delete/{id}','KomentarController@delete');
   
    //Administriranje ankete
    Route::get('/anketa/{id?}','AnketaController@show')->name('prikaziAnketu');
    Route::post('/anketa/save','AnketaController@save')->name('unesi');
    Route::post('/anketa/update/{id}','AnketaController@update');
    Route::get('/anketa/delete/{id}','AnketaController@delete');
    
});