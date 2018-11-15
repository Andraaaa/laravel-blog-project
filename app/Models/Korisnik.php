<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;
class Korisnik {
    public $id;
    public $ime;
    public $prezime;
    public $korisnicko_ime;
    public $lozinka;
    public $uloga_id;
    
    
    public function login(){
        $rezultat=DB::table('korisnik')
                ->select('korisnik.*','uloga.naziv')
                ->join('uloga','korisnik.uloga_id','=','uloga.id')
                ->where([
                  'korisnicko_ime'=>$this->korisnicko_ime,
                   'lozinka'=>md5($this->lozinka)
                ])->first();
        return $rezultat;
    }
    public function save(){
        $rezultat=DB::table('korisnik')
                ->insert([
                    'ime'=>$this->ime,
                    'prezime'=>$this->prezime,
                    'korisnicko_ime'=>$this->korisnicko_ime,
                    'lozinka'=>md5($this->lozinka),
                    'kreiran'=>time(),
                    'uloga_id'=>$this->uloga_id
                ]);
        return $rezultat;
        
    }
    public function getAll(){
        $rezultat=DB::table('korisnik')
                ->select('korisnik.*','uloga.naziv')
                ->join('uloga','korisnik.uloga_id','=','uloga.id')
                ->get();
        return $rezultat;
    }
    public function get(){
        $rezultat=DB::table('korisnik')
                ->select('*')
                ->where('id',$this->id)
                ->first();
        return $rezultat;
    }
    public function update(){
        $data=[
            'ime'=>$this->ime,
            'prezime'=>$this->prezime,
            'korisnicko_ime'=>$this->korisnicko_ime,
            'lozinka'=>md5($this->lozinka),
            'izmena'=>time(),
            'uloga_id'=>$this->uloga_id
        ];
        $rezultat=DB::table('korisnik')
                ->where('id',$this->id)
                ->update($data);
        return $rezultat;
    }
    
    public function delete(){
        $rezultat=DB::table('korisnik')
                ->select('*')
                ->where('id',$this->id)
                ->delete();
        return $rezultat;

    }
}