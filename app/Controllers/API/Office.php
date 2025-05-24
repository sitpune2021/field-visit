<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\Office\OfficeModel;

class Office extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->OfficeModel = new OfficeModel($db);
	}
	
	/************ API Fetch Office List - Nikita Nanaware ****************/
	public function office_list()
	{	
	    $json_data = json_decode(trim(file_get_contents("php://input")), true);
	    $office_type_id = $json_data['office_type_id'] ?? '';
        $taluka_id = $json_data['taluka_id'] ?? '';
		if((isset($office_type_id) && !empty($json_data['office_type_id'])) && isset($taluka_id) && !empty($json_data['taluka_id']))
		{
            $officeData = $this->OfficeModel->getOfficeByTypeAndTaluka($office_type_id,$taluka_id);
    		if (!empty($officeData)) {
    		    
    		    $response = [
                    'status'  => 'success',
                    'message' => 'Office data retrieved successfully.',
                    'details' => $officeData
                ];
            } else {
                $response = [
                    'status'  => 'error',
                    'message' => 'Not available.'
                ];
            }
    	}
    	else
		{
			$response = array('status'=>'error','message'=>'Parameter Missing.');
		}
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
	
}

?>