<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class Anketa
{
    public $id;
    public $naziv;
    public $rezultat;

    public function dohvatiSve(){
        $rezultat=DB::table('anketa')
        ->select('*')
        ->get();
        return $rezultat;
    }
    public function getAll()
    {
        $rezultat = DB::table('anketa')
            ->select('*')
            ->get();
        return $rezultat;
    }

    public function getAnketaById(){

        $rezultat = DB::table('anketa')
            ->select('*')
            ->where('id_korisnik',$this->id)
            ->first();
        return $rezultat;

    }

    public function insert(){

        $rezultat=DB::table('anketa')
            ->insert([
                'naziv'=>$this->naziv,
                'rezultat'=>0
            ]);
        return $rezultat;

    }

    public function updateGlasovi(){
        $rezultat=DB::update('UPDATE anketa SET rezultat = rezultat + 1 WHERE id='.$this->id);

        return $rezultat;
    }
    public function update(){
        $rezultat=DB::table('anketa')
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
            ]);
        return $rezultat;
    }

    public function delete(){
        $rezultat=DB::table('anketa')
            ->where('id',$this->id)
            ->delete();
        return $rezultat;
    }
}