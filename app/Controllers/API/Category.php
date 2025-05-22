<?php
namespace App\Controllers\API;
use App\Controllers\BaseController;
use App\Models\Category\CategoryModel;

class Category extends BaseController
{
	public function __construct() {
		$this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->CategoryModel = new CategoryModel($db);
	}
	
	/************ API Fetch Category List - Nikita Nanaware ****************/
	public function category_list()
	{	
        $categoryData = $this->CategoryModel->getCategoryList('tbl_category');
        
        foreach ($categoryData as &$item) {
            if (!empty($item['image'])) {
                $item['image'] = base_url('public/Backend-Assets/images/Category/' . $item['image']);
            }
        }
                
		$response = ['status' => 'success','message' => 'Category data retrieved successfully.', 'details' => $categoryData];
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
	
}

?>