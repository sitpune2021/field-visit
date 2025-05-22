<?php 
namespace App\Models\Login;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class LoginModel extends Model
{
	public function checkUsernamePass() {
	    $username = $_POST['username'];
	    $password = $_POST['password'];
	    $db = \Config\Database::connect();
	    $LoginName = $db->table('login_master');
	    $data_array = array('username' => $username,'password' => $password,'isdeleted' => '0');
       return $loginD = $LoginName->select('*')
		    ->where($data_array)
		    ->get()->getRowArray();

	}
	
	/************ For Login API - Nikita Nanaware ****************/
		
	public function checkUsernamePassword($username,$password) {
	    $db = \Config\Database::connect();
	    $LoginName = $db->table('login_master');
	    $data_array = array('username' => $username,'password' => $password,'isdeleted' => '0');
        return $loginD = $LoginName->select('*')
		    ->where($data_array)
		    ->get()->getRowArray();
	}
	
}