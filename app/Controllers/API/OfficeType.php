<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\OfficeType\OfficeTypeModel;

class OfficeType extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->OfficeTypeModel = new OfficeTypeModel($db);
	}
	
	/************ API Fetch Office Type List - Nikita Nanaware ****************/
	public function office_type_list()
	{	
        $officeTypeData = $this->OfficeTypeModel->getOfficeTypeList('tbl_office_type');
        $response = ['status' => 'success','message' => 'Office Type data retrieved successfully.', 'details' => $officeTypeData];
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
	
}

?>