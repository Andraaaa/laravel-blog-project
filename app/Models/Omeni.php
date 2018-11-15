<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;
class Omeni {
   
    public $ime_prezime;
    public $tekst;
    public $slika;
    
    public function getAll(){
        $rezultat=DB::table('omeni')
                ->select('*')
                ->get();
        return $rezultat;
    }
    
}
