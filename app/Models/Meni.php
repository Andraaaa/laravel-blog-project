<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class Meni {
    public $id;
    public $naziv;
    public $putanja;
    
    public function getMenu(){
        $rezultat=DB::table('meni')
                ->get();
        return $rezultat;
    }
    public function get(){
        $rezultat=DB::table('meni')
                ->where('meni_id',$this->id)
                ->first();
        return $rezultat;
    }
    public function save(){
        $rezultat=DB::table('meni')
                ->insert([
                    'naziv'=>$this->naziv,
                    'putanja'=>$this->putanja
                ]);
        return $rezultat;
    }
    public function update(){
        $data=[
            'meni_id'=>$this->id,
            'naziv'=> $this->naziv,
            'putanja'=>$this->putanja
        ];
        $rezultat=DB::table('meni')
                ->where('meni_id',$this->id)
                ->update($data);
        return $rezultat;
    }
    public function delete(){
        $rezultat=DB::table('meni')
                ->where('meni_id',$this->id)
                ->delete();
        return $rezultat;
    }
}
