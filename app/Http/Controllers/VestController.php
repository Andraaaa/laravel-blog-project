<?php



namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Vesti;
use App\Models\Lige;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class VestController extends Controller {
    
    private $data=[];
     public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu(); 
        $liga=new Lige();
        $this->data['lige']=$liga->getAll();
    }
    public function add($id=null){
        $vest=new Vesti();
        $this->data['vesti']=$vest->getAll();
        if(!empty($id)){
          $vest->id=$id;
          $this->data['vest']=$vest->get();
        }
        return view('pages.dodajVest',$this->data);
    }
    public function sacuvaj(Request $request){
        $this->validate($request,[
           'naslov'=>'required',
           'podnaslov'=>'required',
           'sadrzaj'=>'required',
           'slika'=>'required|mimes:jpg,jpeg,png,gif|max:3000'
        ]);
        
        $photo=$request->file('slika');
        $exstension=$photo->getClientOriginalExtension();
        $tmp_path=$photo->getPathName();
        
        $folder='images/';
        $file_name=time().".".$exstension;
        $new_path= public_path($folder).$file_name;
        
       try{
           
           File::move($tmp_path,$new_path);
           
           $vest=new Vesti();
           $vest->naslov=$request->get('naslov');
           $vest->podnaslov=$request->get('podnaslov');
           $vest->sadrzaj=$request->get('sadrzaj');
           $vest->opis=trim($request->get('opis'));
           $vest->slika='images/'.$file_name;
           $vest->korisnik_id=1;
           $vest->liga_id=$request->get('ddlLiga');
         
           $vest->save();
           
           return redirect('/')->with('uspeh','Uspesno ste dodali vest!');
       } catch (\Illuminate\Database\QueryException $ex) {
           \Log::error($ex->getMessage());
           return redirect()->back()->with('neuspeh','Greska pri dodavanu vesti u bazu!');

       }
       catch(\Sympfony\Component\HttpFoundation\File\Exception\FileException $ex){
           \Log::error('Greska u radu sa fajlom!'.$ex->getMessage());
           return redirect()->back()->with('neuspeh','Greska pri unosu slike!');
       }
       catch(\ErrorException $ex){
           \Log::error('Greska u radua sa fajlom!'.$ex->getMessage());
           return redirect()->back()->with('neuspeh','GRESKA!');
       }
    }
    public function update($id,Request $request){
        $naslov=$request->get('naslov');
        $podnaslov=$request->get('podnaslov');
        $sadrzaj=$request->get('sadrzaj');
        $opis=$request->get('opis');
        $liga=$request->get('ddlLiga');
        
        $slika=$request->file('slika');
        
        $vest=new Vesti();
        
        $vest->id=$id;
        $vest->naslov=$naslov;
        $vest->podnaslov=$podnaslov;
        $vest->sadrzaj=$sadrzaj;
        $vest->liga_id=$liga;
        $vest->opis=$opis;
        
        $vest->korisnik_id=1;
        
        if(!empty($slika)){
            
            $odabrano=$vest->get();
            File::delete($odabrano->slika);
            
            $tmp_putanja=$slika->getPathName();
            $ime_fajla=time().'.'.$slika->getClientOriginalExtension();
            $putanja='images/'.$ime_fajla;
            $putanja_server=public_path($putanja);
            
            File::move($tmp_putanja,$putanja_server);
            
            $vest->slika=$putanja;
        }
        $rezultat=$vest->update();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste izmenili vest!');
        }
        else{
            return redirect()->back()->with('message','Niste izmenili vest!');
        }
        
    }
    public function delete($id){
        $vest=new Vesti();
        $vest->id=$id;
        
        $odabrana=$vest->get();
        
        File::delete($odabrana->slika);
        
        $rezultat=$vest->delete();
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste obrisali vest!');
        }
        else{
            return redirect()->back()->with('message','Niste obrisali vest!');
        }
    }
    
}
