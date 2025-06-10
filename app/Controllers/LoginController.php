<?php 
namespace App\Controllers;
use App\Models\M_user;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    private $login = '' ;
    public function __construct(){
      
        $this->login = new M_user();       
    }
    
    // show login form
    public function index()    {  

        $session = session();  
        $session->setFlashdata('msg', '');
    return view('logintes');
    }      

    //check user is exist or not
    public function login(){
          
        $data = array('username'=>$this->request->getVar('user_id'),'password'=>md5($this->request->getVar('password')));       
        $user =  $this->login->where($data); 
        $rows = $this->login->countAllResults();
        $session = session();          
        if($rows==1){
            return view('success');
        }else{
            $session->setFlashdata('msg', 'Invalid User');
            return view('logintes');
        } 
     }
}