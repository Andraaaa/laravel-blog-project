<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Meni;


class KomentarController extends Controller{

    private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu(); 
    }
    public function add($id=null){
        $komentar=new Komentar();
        $this->data['komentari']=$komentar->getAll($id);
        return view('pages.vest',$this->data);
    }
    public function postavitiKomentar(Request $request,$id){
        
            try {
                $komentar=new Komentar();
                $komentar->tekst=$request->get('komentar');
                $komentar->vest_id=$id;
                $komentar->korisnik_id=session()->get('user')[0]->id;
                $rez=$komentar->unos();
                
                if($rez==1){
                return redirect()->back()->with('message', "Komentar je uspesno dodat.");
            }
            else{
                return redirect()->back()->with('message','Niste upisali komentar');
                }
            }
            catch (QueryException $ex) {
                \Log::error("Greska pri dodavanju komentara " . $ex->getMessage());
                return redirect()->back()->with('message', "Doslo je do greske.");
            }
                    return redirect()->back()->with('message', "Komentar ne sme biti prazan.");

        }
         public function update($id,Request $request){
        $tekst=$request->get('komentar');
       
        $komentar=new Komentar();
        $komentar->id=$id;
        $komentar->tekst=$tekst;
       
        
        $rezultat=$komentar->update();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste izmenili komentar!');
        }
        else{
            return redirect()->back()->with('message','Greska pri izmeni komentara!');
        }
        
    }
    public function delete($id){
        $komentar = new Komentar();
        $komentar->id=$id;
        
        $rezultat=$komentar->delete();
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste obrisali komentar');
        }
        else{
            return redirect()->back()->with('message','Brisanje komentara nije izvrseno!');
        }
     
    }
       
    }

