<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\Login\LoginModel;

class Login extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->LoginModel = new LoginModel($db);
	}
	
	/************ API Login - Nikita Nanaware ****************/	
	public function do_login()
	{	
	    $validationRules = 
        [
            'username'  => 'required',
            'password'  => 'required'
        ];

        $validationMessages = 
        [
            'username' => [
                'required' => 'Please enter username.'
            ],
            'password'  => [
                'required' => 'Please enter password.'
            ]
        ];
        
	    $json_data = json_decode(trim(file_get_contents("php://input")), true);
	    $username = $json_data['username'] ?? '';
        $password = $json_data['password'] ?? '';
			    
        if (!empty($username) && !empty($password))
		{
			$result = $this->LoginModel->checkUsernamePassword($username,$password);
			
			if(!empty($result))
			{
			    $loginId=$result['id'];
			    $db = db_connect('default');
                $query = $db->query("SELECT * FROM tbl_users WHERE login_id = $loginId");
                $user = $query->getRowArray();
                $UserId = $user['id'];
                $result['user_id'] = $UserId;
				$response = array('status'=>'success','message'=>'Successfully logged In.', 'details'=>$result);
		    }else
			{
				$response = array('status'=>'failed','message'=>'Invalid Credentials', 'details'=>'');
			}
		}
		else
		{
			$response = array('status'=>'error','message'=>'Parameter Missing.');
		}
		echo json_encode($response);

	}
	
}