<?php



namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Korisnik;
use App\Models\Anketa;
use Illuminate\Http\Request;

class RegisterController extends Controller {
   
    private $data=[];
    
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu(); 
        $anketa=new Anketa();
        $this->data['anketa']=$anketa->getAll();
        
        
    }
    public function register(){
        return view('pages.register',$this->data);
    }
    public function registerSave(Request $request){
        $this->validate($request,[
           'ime'=>'regex:/^[A-Z][a-z]{2,30}*$/', 
           'prezime'=>'regex:/^[A-Z][a-z]{2,20}*/',
           'korisnicko_ime'=>'unique:korisnik,korisnicko_ime',
            
                
        ]);
        
        $ime=$request->get('Ime');
        $prezime=$request->get('Prezime');
        $korisnicko_ime=$request->get('username');
        $lozinka=$request->get('pass');
        
        try{
            $korisnik=new Korisnik();
            $korisnik->ime=$ime;
            $korisnik->prezime=$prezime;
            $korisnik->korisnicko_ime=$korisnicko_ime;
            $korisnik->lozinka=$lozinka;
            $korisnik->uloga_id=2;
            
           $rezultat=$korisnik->save();
           
           if($rezultat==1){
               return redirect()->back()->with('message','Uspesno ste se registrovali!');
           }
           else{
               return redirect()->back()->with('message','Greska pri unosu!');
           }
        }
        catch(\Exception $ex){
             \Log::error('GRESKA'.$ex->getMessage());
             return redirect()->back()->with('message','Greska pri unosu!');
        }
    
}
}
