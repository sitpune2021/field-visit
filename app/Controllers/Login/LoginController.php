<?php
namespace App\Controllers\Login;
use App\Controllers\BaseController;
use App\Models\Login\LoginModel;

class LoginController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct() {

        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->LoginModel = new LoginModel($db);

        //print_r($db);
        
    }

/** Login - Nikita Nanaware**/
    public function signIn()
    {
        
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        if($this->validate($rules))
        {
            $result = $this->LoginModel->checkUsernamePass();
            //print_r($result);die;
           if(!empty($result))
           {
               
                $session = session();
                $id         = $result['id'];
                $username   = $result['username'];
                $name       = $result['name'];
                $user_type  = $result['user_type'];
                session()->set('id',$id);
                session()->set('username',$username);
                session()->set('name',$name);
                session()->set('user_type',$user_type);
                $this->session->set('id',$id);
                $this->session->set('username',$username);
                $this->session->set('name',$name);
                $this->session->set('user_type',$user_type);
  
                 if($user_type == 1)
                {
                    return $this->response->redirect(site_url('adminDashboard')); 
                }
                else if($user_type == 2)
                {
                    return $this->response->redirect(site_url('employeeDashboard')); 
                }
                else{
                    //session distroy
                    return $this->response->redirect(site_url('/')); 
                }
                
           }else
           {
               $invalid = 'Provide valid credentials for login.';
               session()->set('invalidLoginD',$invalid);
               $this->session->set('invalidLoginD',$invalid);
              return $this->response->redirect(site_url('/')); 
           }      
          
        }else
        {
            session()->remove('invalidLoginD');
            $data['validation'] = $this->validator;
            echo view('login',$data);
        }
    }
   
    /** Session destroy - Nikita Nanaware**/
    public function distroySession()
    {
        $session = session();
        $session->set(array('pageName' => '','transactionId' => '','amount' => '','fullName' => ''));
        //$session->destroy(); 
    }
    
}
