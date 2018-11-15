<?php



namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Anketa;
use App\Models\Glasovi;
use Illuminate\Http\Request;

class AnketaController extends Controller {
    
      private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();     
    }
     public function anketa()
    {
      try {
            $anketa=new Anketa();
            $ankete = $anketa->getAll();
            return response($ankete, 200);
        }
        catch(\Exception $ex){
            \Log::error('Greska: ' . $ex->getMessage());
            return response(null, 500);}
    }
    public function glas(Request $request){
        try{
         $glas=new Glasovi();
         $glas->id_korisnik=session()->get('user')[0]->id_korisnik;
         $glas->korisnicko_ime=session()->get('user')[0]->korisnicko_ime;
         $glas->id_anketa=$request->get('anketa');
         $glas->insert();
         $anketa=new Anketa();
         $anketa->id=$request->get('anketa');
         $anketa->rezultat=$request->get('rez');
         $anketa->updateGlasovi();

             return redirect('/ajax/rezultat')->with('message','Uspesno ste glasali!');
             }
        catch(QueryException $ex){
          \Log::error($ex->getMessage());
        return redirect()->back()->with('message','Niste glassali');
     }
    }
    public function rezultat(){
        $anketa=new Anketa();
        $this->data['anketa']=$anketa->dohvatiSve();
        $glasovi=new Glasovi();
        $this->data['korisnik']=$glasovi->getAll();
        $glasovi->id_korisnik=session()->get('user')[0]->id_korisnik;

        $this->data['glasao']=$glasovi->get();
        return view('components.sidebar',$this->data);
    }
}
