<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Korisnik;
class LoginController extends Controller {
 
    public function login(Request $request){
     
        $korisnickoIme=$request->get('username');
        $lozinka=$request->get('pass');
        
        $korisnik=new Korisnik();
        $korisnik->korisnicko_ime=$korisnickoIme;
        $korisnik->lozinka=$lozinka;
        
        $loginKorisnik=$korisnik->login();
        
        if(!empty($loginKorisnik)){
            $request->session()->push('user',$loginKorisnik);
            return redirect()->back()->with('uspeh','Uspesno ste se ulogovali!');
        }
        return redirect()->back()->with('neuspeh','Niste registrovani!');
    }
    public function logout(Request $request){
        $request->session()->forget("user");
        $request->session()->flush();
        return redirect("/");
    }
}
