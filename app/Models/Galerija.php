<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;
class Galerija {
    public $id;
    public $putanja;
    public $opis;
    
    public function addPic(){
        $rezultat=DB::table('galerija')
                ->insert([
                    'id'=>$this->id,
                    'putanja'=>$this->putanja,
                    'opis'=>$this->opis,
                    'kreiran'=>time()
                ]);
        return $rezultat;
    }
    public function getAll(){
        $rezultat=DB::table('galerija')
                ->select('*')
                ->get();
        return $rezultat;
    }
  public function get() {
		$rezultat = DB::table('galerija')
					->select('*')
					->where('id',$this->id)
					->first();
		return $rezultat;
	}
    public function delete(){
        $rezultat=DB::table('galerija')
                ->where('id',$this->id)
                ->delete();
        return $rezultat;
    }
    public function update(){
        $data=[
            'putanja'=>$this->putanja,
            'opis'=>$this->opis,
            'izmenjen'=>time()
        ];
        $rezultat=DB::table('galerija')
                ->where('id',$this->id)
                ->update($data);
        return $rezultat;
    }
}
