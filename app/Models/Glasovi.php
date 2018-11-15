<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;
class Glasovi {
     public $id;
     public $id_korisnik;
     public $korisnicko_ime;
     public $id_anketa;
     
     public function getAll(){
        $rezultat=DB::table('glasovi')
            ->select('*')
            ->get();
        return $rezultat;
    }

    public function get(){
        $rezultat=DB::table('glasovi')
            ->select('*')
            ->where('id_korisnik',$this->id_korisnik)
            ->first();
        return $rezultat;
    }

    public function insert(){
        $rezultat=DB::table('glasovi')
            ->insert([
                'id_korisnik'=>$this->id_korisnik,
                'korisnicko_ime'=>$this->korisnicko_ime,
                'id_anketa'=>$this->id_anketa
            ]);
        return $rezultat;
    }
    
}
