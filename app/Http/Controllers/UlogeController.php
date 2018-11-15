<?php


namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Uloga;
use Illuminate\Http\Request;

class UlogeController extends Controller {
   
    private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();
    }
    public function addUloga($id=null){
        $uloge=new Uloga();
        $this->data['uloga']=$uloge->getAll();
        if(!empty($id)){
            $uloge->id=$id;
            $this->data['uloge']=$uloge->get();
        }
        return view('pages.dodajUlogu',$this->data);
    }
    public function save(Request $request){
       
        
        $naziv=$request->get('naziv');
        try{
            $uloga=new Uloga();
            $uloga->naziv=$naziv;
            
            $rezultat=$uloga->insert();
            if($rezultat==1){
                return redirect()->back()->with("message","Uspesno ste uneli ulogu!");
            }
            else{
                return redirect()->back()->with("message","Niste uneli ulogu!");
            }
        } catch (Exception $ex) {
            \Log::error("GRESKA",$ex.getMessage());
        }
    }
    public function update($id,Request $request){
        $naziv=$request->get('naziv');       
        
        try{
            $uloge=new Uloga();
            $uloge->id=$id;
            $uloge->naziv=$naziv;
            
            $rezultat=$uloge->update();
            
            if($rezultat==1){
                return redirect()->back()->with('message','Uspesno ste izmenili ulogu!');
            }
            else{
                return redirect()->back()->with('message','Niste izmenili ulogu!');
            }
        }
         catch(\Exception $ex) {
             \Log::error('GRESKA'.$ex->getMessage());
         }
         
    }
    public function delete($id){
        $uloge=new Uloga();
        
        $uloge->id=$id;
        
        $rezultat=$uloge->delete();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste obrisali ulogu');
        }
        else{
            return redirect()->back()->with('message','Niste obrisali ulogu');
        }
    }
}
