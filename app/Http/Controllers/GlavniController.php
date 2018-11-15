<?php



namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Vesti;
use App\Models\Komentar;
use App\Models\Anketa;
use App\Models\Omeni;

class GlavniController extends Controller{
   private $data=[];
    public function __construct() {
        $meni=new Meni();
        $this->data['menu']=$meni->getMenu();
        $anketa=new Anketa();
        $this->data['anketa']=$anketa->getAll();
    }
    public function index(){
        $vest=new Vesti();
        $this->data['vesti']=$vest->getAll();
        return view('pages.home',$this->data);
    }
    public function vest($id){
        $vest=new Vesti();
        $this->data['vest']=$vest->getVest($id);
        $komentar=new Komentar();
        $this->data['komentar']=$komentar->getAll($id);
        return view ('pages.vest',$this->data);
    }
    public function getJa(){
        $ja=new Omeni();
        $this->data['ja']=$ja->getAll();
        return view ('pages.omeni',$this->data);
    }
    
   
}
