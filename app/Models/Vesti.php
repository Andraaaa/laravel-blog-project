<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;
class Vesti  {
    
    public $id;
    public $naslov;
    public $podnaslov;
    public $sadrzaj;
    public $slika;
    public $opis;
    public $korisnik_id;
    public $liga_id;

    
    public function getAll(){
        $rezultat=DB::table('vesti')
                ->orderByRaw('kreiran DESC')
                ->paginate(3);
        return $rezultat;
    }
    public function get(){
          $rezultat=DB::table('vesti')
                ->where([
                    'vest_id'=>$this->id
                        ])
                ->first();
        return $rezultat;
    }
  
    public function getVest($id){
       $rezultat=DB::select('select * from vesti where vest_id='.$id.';');
        return $rezultat;

    }    
   public function save(){
       $rezultat=DB::table('vesti')
               ->insert([
                   'naslov'=>$this->naslov,
                   'podnaslov'=>$this->podnaslov,
                   'sadrzaj'=>$this->sadrzaj,
                   'kreiran'=>time(),
                   'slika'=>$this->slika,
                   'opis'=>$this->opis,
                   'korisnik_id'=>$this->korisnik_id,
                   'liga_id'=>$this->liga_id
                     
               ]);
       return $rezultat;
   }
   public function update(){
        $data=[
            'naslov'=>$this->naslov,
            'podnaslov'=>$this->podnaslov,
            'sadrzaj'=>$this->sadrzaj,
            'opis'=>$this->opis,
            'liga_id'=>$this->liga_id,
            'korisnik_id'=>$this->korisnik_id,
            'izmena'=>time()
        ];
        if(!empty($this->slika)){
            $data['slika']=$this->slika;
        }
        $rezultat=DB::table('vesti')
                ->where('vest_id',$this->id)
                ->update($data);
        return $rezultat;
    }
  	public function delete(){
		$rezultat = DB::table('vesti')
					->where('vest_id',$this->id)
					->delete();
		return $rezultat;
	}
        public function search($pretraga){
            $rezultat=DB::table('vesti')
                    ->select('*')
                    ->join('lige as l','vesti.liga_id','=','lige.liga_id')
                    ->join('korisnik as k','vesti.korisnik_id','=','k.id')
                    ->where('vesti.naslov','like','%'.$pretraga.'%')
                    ->orWhere('lige.naziv_lige','like','%'.$pretraga.'%')
                    ->get();
            return $rezultat;
        }
}
