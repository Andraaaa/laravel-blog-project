<?php



namespace App\Http\Controllers;
use App\Models\Meni;
use Illuminate\Http\Request;


class MeniController extends Controller {
   
    private $data=[];
    
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();
    }
    public function add($id=null){
        $meni=new Meni();
        $this->data['meni']=$meni->getMenu();
        if(!empty($id)){
            $meni->id=$id;
            $this->data['menus']=$meni->get();
        }
        return view('pages.dodajMeni',$this->data);
    }
    public function save(Request $request){
        $naziv=$request->get('naziv');
        $putanja=$request->get('putanja');
        
        $meni=new Meni();
        
        $meni->naziv=$naziv;
        $meni->putanja=$putanja;
        $rezultat=$meni->save();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste uneli novu stavku menija!');
        }
        else{
            return redirect()->back()->with('message','Niste uneli novu stavku menija!');
        }
    }
    public function update($id,Request $request){
        $naziv=$request->get('naziv');
        $putanja=$request->get('putanja');
        
        $meni=new Meni();
        $meni->naziv=$naziv;
        $meni->putanja=$putanja;
        $meni->id=$id;
        
        $rezultat=$meni->update();
        
        if($rezultat==1){
             return redirect()->back()->with('message','Uspesno ste izmenili stavku menija');
        }
        else{
            return redirect()->back()->with('message','Niste uspeli da izmenite stavku menija');
        }
    }
     public function delete($id){
        $meni=new Meni();
        $meni->id=$id;
        
        $rezultat=$meni->delete();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste obrisali stavku iz menija!');
        }
        else{
            return redirect()->back()->with('message','Niste uspeli da obrisete stavku iz menija!');
        }
}
}
    