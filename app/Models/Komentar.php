<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;

class Komentar {
    public $id;
    public $tekst;
    public $vest_id;
    public $korisnik_id;
    
    public function unos(){
        $rezultat=DB::table('komentar')
                ->insert([
                    'tekst'=>$this->tekst,
                    'kreiran'=>time(),
                    'vest_id'=>$this->vest_id,
                    'korisnik_id'=>$this->korisnik_id
                    
                ]);
       return $rezultat;
    }

     public function getAll($id)
    {
         $this->id=$id;
         $rezultat=DB::table('komentar')
                 ->select('*')
                 ->join('korisnik','komentar.korisnik_id','=','korisnik.id')
                 ->where('komentar.vest_id',$this->id)
                 ->get();
       return $rezultat;
    }
    public function get(){
        $rezultat=DB::table('komentar')
                ->select('*')
                ->join('korisnik','komentar.korisnik_id','=','korisnik.id')
                ->join('vesti','komentar.vest_id','=','vesti.vest_id')
                ->where('komentar_id',$this->id)
                ->first();
        return $rezultat;
}
    public function update(){
        $data=[
            'tekst'=>$this->tekst,
        ];
        $rezultat=DB::table('komentar')
                ->where('komentar_id',$this->id)
                ->update($data);
        return $rezultat;
    }
    
    public function delete(){
        $rezultat=DB::table('komentar')
                ->select('*')
                ->where('komentar_id',$this->id)
                ->delete();
        return $rezultat;

    }
}
    
