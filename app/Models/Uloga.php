<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;

class Uloga {

   public $id;
   public $naziv;
   
   public function getAll(){
       $rezultat=DB::table('uloga')
               ->select('*')
               ->get();
       return $rezultat;
   }
   
   public function get(){
       $rezultat=DB::table('uloga')
               ->select('*')
               ->where([
                   'id'=>$this->id
               ])->first();
       return $rezultat;
   }
   public function update(){
       $data=[
           'naziv'=>$this->naziv
       ];
       $rezultat=DB::table('uloga')
               ->where('id',$this->id)
               ->update($data);
       return $rezultat;
   }
   public function insert(){
       $rezultat=DB::table('uloga')
               ->insert([
                   'id'=>$this->id,
                   'naziv'=>$this->naziv
               ]);
       return $rezultat;
   }
   public function delete(){
       $rezultat=DB::table('uloga')
               ->where('id',$this->id)
               ->delete();
       return $rezultat;
   }
}
