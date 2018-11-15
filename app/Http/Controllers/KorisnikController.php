<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Uloga;
use App\Models\Korisnik;
use Illuminate\Http\Request;


class KorisnikController extends Controller{
   
    private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();
        $uloge=new Uloga();
        $this->data['uloge']=$uloge->getAll();
    }
    public function addKorisnik($id=null){
        $korisnik=new Korisnik();
        $this->data['listaj']=$korisnik->getAll();
        if(!empty($id)){
            $korisnik->id=$id;
            $this->data['korisnik'] = $korisnik->get();
        }
        return view('pages.dodajKorisnika',$this->data);
    }
    public function save(Request $request){
        $this->validate($request,[
			'korisnickoIme' => 'unique:korisnik,korisnicko_ime',
			'ddlUloga' => 'required|not_in:0',
		
		]);
        
        $ime=$request->get('tbIme');
        $prezime=$request->get('tbPrezime');
        $korisnicko_ime=$request->get('username');
        $lozinka= md5($request->get('pass'));
        $uloge=$request->get('ddlUloga');
        
        try{
        
            $korisnik=new Korisnik();
            $korisnik->ime=$ime;
            $korisnik->prezime=$prezime;
            $korisnik->korisnicko_ime=$korisnicko_ime;
            $korisnik->lozinka=$lozinka;
            $korisnik->uloga_id=$uloge;
        
            $rezultat=$korisnik->save();
        
            if($rezultat==1){
                return redirect()->back()->with('message','Upisali ste u bazu!');
            }
            else {
            return redirect()->back()->with('message','Greska pri unosu!');
			}
    }
    catch(\Exception $ex){
        \Log::error('GRESKA'.$ex->getMessage());
    }
}
    public function update($id,Request $request){
        $ime=$request->get('tbIme');
        $prezime=$request->get('tbPrezime');
        $korisnicko_ime=$request->get('username');
        $lozinka=$request->get('pass');
        $uloge=$request->get('ddlUloga');
        
        $korisnik=new Korisnik();
        $korisnik->id=$id;
        $korisnik->ime=$ime;
        $korisnik->prezime=$prezime;
        $korisnik->korisnicko_ime=$korisnicko_ime;
        $korisnik->lozinka=$lozinka;
        $korisnik->uloga_id=$uloge;
        
        $rezultat=$korisnik->update();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste izmenili korisnika!');
        }
        else{
            return redirect()->back()->with('message','Greska pri izmeni korisnika!');
        }
        
    }
    public function delete($id){
        $korisnik = new Korisnik();
        $korisnik->id=$id;
        
        $rezultat=$korisnik->delete();
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste obrisali korisnika');
        }
        else{
            return redirect()->back()->with('message','Brisanje nije izvrseno!');
        }
     
    }
    
}