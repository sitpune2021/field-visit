<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\Login\LoginModel;

class Register extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->LoginModel = new LoginModel($db);
	}
	

	/************ API Registration - Nikita Nanaware ****************/
	public function do_register()
	{	
		$validationRules = 
        [
            'first_name' => 'required|alpha',
            'last_name'  => 'required|alpha',
            'mobile'     => 'required|exact_length[10]',
            'password'   => 'required|min_length[8]',
            // 'address'    => 'required'
        ];

        $validationMessages = 
        [
            'first_name' => [
                'required' => 'Please enter first name.',
                'alpha'    => 'First name should contain only letters.'
            ],
            'last_name'  => [
                'required' => 'Please enter last name.',
                'alpha'    => 'Last name should contain only letters.'
            ],
            'mobile'     => [
                'required'    => 'Please enter mobile number.',
                'exact_length' => 'Mobile number must be exactly 10 digits.',
                'is_unique'   => 'This mobile number is already registered.'
            ],
            'password'     => [
                'required'    => 'Please enter password.',
                'exact_length' => 'Password atleast 8 characters long.'
            ]
            // 'address'     => [
            //     'required'    => 'Please enter address.'
            // ]
        ];
        
        $json_data  = json_decode(trim(file_get_contents("php://input")), true);
	    $first_name = $json_data['first_name'] ?? '';
        $last_name  = $json_data['last_name'] ?? '';
        $mobile     = $json_data['mobile'] ?? '';
        $password   = $json_data['password'] ?? '';
        // $address    = $json_data['address'] ?? '';
        
		if(isset($first_name) && isset($last_name) && isset($mobile) && isset($password))
		{
		     $db = db_connect('default');
             $builder = $db->table('login_master');
             $mobileExists = $builder->where('mobile', $mobile)
                            ->where('isdeleted', 0)
                            ->countAllResults();
        
            if ($mobileExists > 0) {
                return $this->response->setJSON(['status' => 'fail', 'message' => 'This mobile number is already registered.', 'details' => '']);
            }

			if ($this->validate($validationRules, $validationMessages))
			{
			    
                $db = db_connect('default');
                
                $builder = $db->table('login_master');
                $regData = array(
                    'name'     => $first_name.'  '.$last_name,
                    'mobile'   => $mobile,
                    'username' => $mobile,
                    'password' => $password,
                    'user_type'=> 3
                );
				$result = $builder->insert($regData);
				
				$loginId = $db->insertID();
				$builder2 = $db->table('tbl_users');
                $userData = array(
                    'login_id' => $loginId,
                    'name'     => $first_name.'  '.$last_name,
                    'mobile'   => $mobile,
                    'username' => $mobile,
                    'password' => $password,
                    // 'address'  => $address,
                    'role_id'  => 3
                );
				$result = $builder2->insert($userData);
				
				if(!empty($result))
				{
				    $userData['id'] = $db->insertID();
					$response = array('status'=>'success','message'=>'Registered Successfully.', 'details'=>$userData);
			
				}else
				{
					$response = array('status'=>'fail','message'=>'Failed', 'details'=>'');
				}
			}
			else
			{
				$validationErrors = $this->validator->getErrors();
				$response = [
					'status' => 'error',
					'message' => 'Validation failed',
					'details' => $validationErrors
				];
				return $this->response->setJSON($response);
			}
		}
		else
		{
			$response = array('status'=>'error','message'=>'Parameter Missing.');
		}
		echo json_encode($response);
	}
	
public function update_profile()
{
    $user_id = $this->request->getPost('user_id');
    $name    = $this->request->getPost('name');
    $mobile  = $this->request->getPost('mobile');
    $address = $this->request->getPost('address');
    $image   = $this->request->getPost('image'); // optional old image name
    $newImage = '';

    if (!empty($user_id) && !empty($name) && !empty($mobile) && !empty($address)) {
        $db = db_connect();

        // Check if user exists
        $query = $db->query("SELECT * FROM tbl_users WHERE id = $user_id");
        $userD = $query->getRowArray();
        if (!$userD) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'User not found.']);
        }

        $loginId = $userD['login_id'];

        // Check if mobile already exists for another user
        $builder = $db->table('login_master');
        $mobileExists = $builder->where('mobile', $mobile)
                                ->where('isdeleted', 0)
                                ->where('id !=', $loginId)
                                ->countAllResults();

        if ($mobileExists > 0) {
            return $this->response->setJSON(['status' => 'fail', 'message' => 'This mobile number is already registered.']);
        }

        // Handle image upload
        $uploadedFile = $this->request->getFile('image');
        if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $newImage = rand(1111, 9999) . '.' . $uploadedFile->getClientExtension();
            $upload_path = FCPATH . "public/Backend-Assets/images/User/";
            $uploadedFile->move($upload_path, $newImage);

            // Delete old image if present
            if (!empty($image)) {
                $old_file = $upload_path . $image;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }

            $image = $newImage;
        }

        // Update tbl_users
        $userData = [
            'name'     => $name,
            'mobile'   => $mobile,
            'username' => $mobile,
            'address'  => $address,
            'image'    => $image
        ];
        $db->table('tbl_users')->where('id', $user_id)->update($userData);

        // Update login_master
        $loginData = [
            'name'     => $name,
            'mobile'   => $mobile,
            'username' => $mobile
        ];
        $db->table('login_master')->where('id', $loginId)->update($loginData);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Profile Updated Successfully.']);
    }

    return $this->response->setJSON(['status' => 'error', 'message' => 'Parameter Missing.']);
}

	
}