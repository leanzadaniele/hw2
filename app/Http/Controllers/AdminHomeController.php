<?php 
namespace App\Http\Controllers;
 
use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminHomeController extends Controller
{
    
    public function showHome(){
        $error = "<p></p>";
        $user = Session::get('user');
        if($user == null || !$user->isAdmin()){
            return redirect()->route('login');
        }

        return view('admin_home', compact('user', 'error'));
    }

    public function saveAdmin(Request $request){
        //vedo se esiste l'utente e se è admin
        $userLogged = Session::get('user');
        $error = "<p></p>";
        $emailToCreate = $request->all()['newAdminEmail'];
        // Controllo se l'utente loggato è un Admin
        if($userLogged != null && $userLogged->isAdmin()){ // Controllo se L'utente da creare esiste ed è un amministratore
            $user = User::findForEmail($emailToCreate);
            
            if($user != null && $user->isAdmin()){
                $error = "<p class='err'> l'utente è già amministratore </p>";
            }else if($user != null){ // Allora è solo utente normale quindi posso aggiungerlo
                $newAdmin = new Admin();
                $newAdmin->admin_email = $emailToCreate;
                $newAdmin->id = $user->id;
                if($newAdmin->save()){
                    $error = "<p class='okStatus'>aggiunto con successo</p>";
                }else{
                    $error = "<p class='err'>errore</p>";
                }
                
            }
        }else{
            return redirect()->route('home');
        }
        return view('admin_home', compact('user', 'error'));
    }

    public function removeAdmin(){
        $error = "<p></p>";
        if(Admin::getAdminForID(Session::get('user')->id)->delete()){
            return redirect()->route('home');
        }
        return view('admin_home', compact('user', 'error'));
    }
    
}


/* 
 if(isset($_POST["newAdminEmail"])){
                    $emailADMIN = mysqli_real_escape_string($conn,$_POST["newAdminEmail"]);
                    $query = "select * from users where email = '$emailADMIN'"; //vedo se esiste l'utente
                    $res = mysqli_query($conn,$query);
                    if(mysqli_num_rows($res)>0){ //se esiste
                        $query = "select * from admins where admin_email = '$emailADMIN'";//vedo se è anche admin
                        $res = mysqli_query($conn,$query);
                        if(mysqli_num_rows($res)>0){ //se è già admin
                            echo("<p class='err'> l'utente è già amministratore </p>");
                        }
                        else{
                            $query = "select * from users where email = '$emailADMIN'";//vedo se è anche admin
                            $res = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($res);
                            $newAdminsId = $row["id"];
                            if(mysqli_query($conn,"insert into admins(id,admin_email) values('$newAdminsId','$emailADMIN')")){
                                echo("<p class='okStatus'>aggiunto con successo</p>");
                            }
                            else{
                                echo("<p class='err'>errore</p>");
                            }
                        }
                    }
                    else{
                        $errore = true;
                    }
                }

*/