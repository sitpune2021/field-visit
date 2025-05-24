<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\Taluka\TalukaModel;

class Taluka extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->TalukaModel = new TalukaModel($db);
	}
	
	/************ API Fetch Taluka List - Nikita Nanaware ****************/
	public function taluka_list()
	{	
        $talukaData = $this->TalukaModel->getTalukaList('tbl_taluka');
        $response = ['status' => 'success','message' => 'Taluka data retrieved successfully.', 'details' => $talukaData];
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
	
}

?>