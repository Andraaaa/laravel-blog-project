<?php



namespace App\Http\Controllers;
use App\Models\Galerija;
use App\Models\Meni;
use App\Models\Anketa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller {
    
    private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();
        $anketa=new Anketa();
        $this->data['anketa']=$anketa->getAll();
    }
    public function galerija(){
        $gal=new Galerija();
        $this->data['galerija']=$gal->getAll();
        return view('pages.galerija',$this->data);
    }
    public function addPic($id=null){
        $galerija=new Galerija();
        $this->data['galerija']=$galerija->getAll();
        if(!empty($id)){
            $galerija->id=$id;
            $this->data['slika']=$galerija->get();
        }
        return view('pages.dodajGaleriju',$this->data);
    }


    public function savePic(Request $request){


        $slika=$request->file('slika');
        $ekstenzija=$slika->getClientOriginalExtension();
        $tmp_path=$slika->getPathName();

        $folder='images/';
        $file_name=time().".".$ekstenzija;
        $new_path= public_path($folder).$file_name;

        try{

            File::move($tmp_path,$new_path);
            
            $galerija=new Galerija();
            $galerija->opis=trim($request->get('opis'));
            $galerija->putanja='images/'.$file_name;
            
            $rezultat=$galerija->addPic();
            if($rezultat==1){
               return redirect()->back()->with('message','Uspesno ste dodali sliku u galeriju!'); 
            }
            else{
                return redirect()->back()->with('message','Niste uspeli da dodate sliku u galeriju!');
            } 
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());

        }
        catch(\Sympfony\Component\HttpFoundation\File\Exception\FileException $ex){
            \Log::error('Greska u radu sa fajlom!'.$ex->getMessage());
            return redirect()->back()->with('message','Greska pri unosu slike!');
        }
        catch(\ErrorException $ex){
            \Log::error('Greska u radu sa fajlom!'.$ex->getMessage());
            return redirect()->back()->with('message','GRESKA!');
        }

    }

    public function updatePic($id,Request $request){
         
        $slika=$request->file('slika');     
        $opis=$request->get('opis');
        
       
        
        $galerija=new Galerija();
        
        $galerija->id=$id;
        $galerija->opis=$opis;
        
        if(!empty($slika)){
            
            $odabrana_slika=$galerija->get();
            File::delete($odabrana_slika->putanja);
            
            $tmp_putanja=$slika->getPathName();
            $ime_fajla=time().'.'.$slika->getClientOriginalExtension();
            $putanja='images/'.$ime_fajla;
            $putanja_server=public_path($putanja);
            
            File::move($tmp_putanja,$putanja_server);
            
            $galerija->putanja=$putanja;
        }
        $rezultat=$galerija->update();
        
        if($rezultat==1){
            return redirect()->back()->with('message','Uspesno ste izmenili vest!');
        }
        else{
            return redirect()->back()->with('message','Niste izmenili vest!');
        }
        
    }
    public function delPic($id){

        $galerija= new Galerija();
        $galerija->id=$id;



        $odabrana_slika = $galerija->get();
        File::delete($odabrana_slika->putanja);

        $rezultat = $galerija->delete();
        if($rezultat == 1){
            return redirect()->back()->with('message','Uspesno ste obrisali sliku iz galerije!');
        }
        else {
            return redirect()->back()->with('message','Niste uspeli da obrisete sliku iz galerije!');
        }



    }
}


