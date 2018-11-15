<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;


class Lige {
    
    public function getLiga3(){
        $rezultat=DB::table('lige')
                ->select('*')
                ->where('liga_id','<','4')
                ->get();
        return $rezultat;
    }
    public function getLiga5(){
        $rezultat=DB::table('lige')
                ->select('*')
                ->where('liga_id','>','3')
                ->get();
        return $rezultat;
    }
    public function getAll(){
        $rezultat=DB::table('lige')
                ->select('*')
                ->get();
        return $rezultat;
    }
}
