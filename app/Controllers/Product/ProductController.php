<?php
namespace App\Controllers\Product;
use App\Controllers\BaseController;
use App\Models\Product\ProductModel;
use App\Models\Category\CategoryModel;
use App\Models\Subcategory\SubcategoryModel;

class ProductController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->ProductModel     = new ProductModel($db);
        $this->CategoryModel    = new CategoryModel($db);
        $this->SubcategoryModel = new SubcategoryModel($db);
    }
   
    /********** Calcium Mineral List - Nikita Nanaware *************/

	public function calciumMineralList()
    {
        $session = session();
        session()->remove('calmsg');
        $data['calMineral_list'] = $this->ProductModel->getProductList();
        return view('Product/calciumMineralList',$data);
    }

    /********** Add Calcium Mineral - Nikita Nanaware *************/

    public function addCalciumMineral()
    {
        $data['categoryD'] = $this->CategoryModel->getCategoryList();
        $data['subcatD'] = $this->SubcategoryModel->getSubcategoryList();
        return view('Product/addCalciumMineral',$data);
    }

    public function getUnitByCategory()
	{
		$cat          = $_POST['cat_id'];
		$selectedunit = !empty($_POST['unit']) ? $_POST['unit'] : '';
		$unitList     = $this->ProductModel->getUnitByCategory($cat);
		echo '<select class="form-select" id="unit" name="unit" value="">';
			echo '<option value="">Select unit</option>';
			foreach($unitList as $list){ 
			$unit=$list['unit'];
            $unitId=$list['id'];
			$selected = ($selectedunit == $unitId) ? 'selected' : ''; 
            echo '<option value="'.$unitId.'" '.$selected.'>'.$unit.'</option>';
			 } 
		echo '</select>';
	}
	
	public function getSubcatByCat()
	{
		$cat            = $_POST['cat_id'];
		$selectedsubcat = !empty($_POST['subcat_id']) ? $_POST['subcat_id'] : '';
		$subcatList     = $this->ProductModel->getSubcatByCat($cat);
		echo '<select class="form-select" id="unit" name="unit" value="">';
			echo '<option value="">Select subcategory</option>';
			foreach($subcatList as $list){ 
			$subcat=$list['subcategory'];
            $subcatId=$list['id'];
			$selected = ($selectedsubcat == $subcatId) ? 'selected' : ''; 
            echo '<option value="'.$subcatId.'" '.$selected.'>'.$subcat.'</option>';
			 } 
		echo '</select>';
	}

    public function addCalciumMineralPro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();

        $validationRules = 
        [
            'cat_id'         => 'required',
            // 'subcat_id'      => 'required',
            'name'           => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'quantity'       => 'required',
            'expiry_date'    => 'required',
            'weight'         => 'required',
            'unit'           => 'required',
            'image'          => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
        ];

        $validationMessages = 
        [ 
            
            'cat_id' => [
                'required' => 'Please select category.',
            ],
            'subcat_id' => [
                'required' => 'Please select subcategory.',
            ],
            'name' => [
                'required' => 'Please enter product name.',
            ],
            'description' => [
                'required' => 'Please enter description.',
            ],
            'price' => [
                'required' => 'Please enter price.',
            ],
            'quantity' => [
                'required' => 'Please enter quantity.',
            ],
            'expiry_date' => [
                'required' => 'Please select expiry date.',
            ],
            'weight' => [
                'required' => 'Please enter description.',
            ],
            'unit' => [
                'required' => 'Please select unit.',
            ],
            'image' => [
                'uploaded' => 'Please upload product image.',
                'mime_in'  => 'Image should be in png,jpg and jpeg format.',
                'max_size' => 'Image size should not be exceed than 2 MB.',
            ],
        ];
        
        if ($this->validate($validationRules, $validationMessages))
        {
            if($_FILES['image']['name']!='')
            {
                $documents = rand(1111,9999);
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);    
                $filename = $_FILES['image']['name'];
                $upload_path="public/Backend-Assets/images/Product/";
                $image = $documents.".".$extension;
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                // $file_ext=strtolower(end(explode('.',$filename))); 
                $reg = move_uploaded_file($file_tmp,$upload_path.$image);
            }

            $builder = $db->table('tbl_product');
			$productData = array(
			    'cat_id'        => $_POST['cat_id'],
                'subcat_id'     => $_POST['subcat_id'],
                'name'          => $_POST['name'],
                'description'   => $_POST['description'],
                'price'         => $_POST['price'],
                'weight'        => $_POST['weight'],
                'expiry_date'   => $_POST['expiry_date'],
                'quantity'      => $_POST['quantity'],
                'unit'          => $_POST['unit'],
                'image'         => $image
			);
			
			$calmsg = "Product Added Succesfully.";
			session()->set('calmsg',$calmsg); 
            $builder->insert($productData);
            return $this->response->redirect(site_url('/addCalciumMineral'));
            
        }else
        {
            $data['categoryD'] = $this->CategoryModel->getCategoryList();
            $data['subcatD'] = $this->SubcategoryModel->getSubcategoryList();
            return view('Product/addCalciumMineral', [
                'validation'  => $validation,
                'categoryD'   => $data['categoryD'],
                'subcatD'     => $data['subcatD']
            ]);
        }
    }

    // ********* Update Property - Nikita Nanaware *************/

	public function updateCalciumMineral()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->ProductModel->getProductById($id);
		$data['categoryD'] = $this->CategoryModel->getCategoryList();
        $data['subcatD'] = $this->SubcategoryModel->getSubcategoryList();
        return view('Product/updateCalciumMineral', [
            'list'        => $list, 
            'categoryD'   => $data['categoryD'],
            'subcatD'     => $data['subcatD']
        ]);
    }
	
	public function updateCalciumMineralPro()
    {
		$session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
		$validationRules = 
        [
            'cat_id'         => 'required',
            'subcat_id '     => 'required',
            'name'           => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'quantity'       => 'required',
            'expiry_date'    => 'required',
            'weight'         => 'required',
            'unit'           => 'required'
        ];

        $validationMessages = 
        [ 
            
            'cat_id' => [
                'required' => 'Please select category.',
            ],
            'subcat_id' => [
                'required' => 'Please select subcategory.',
            ],
            'name' => [
                'required' => 'Please enter product name.',
            ],
            'description' => [
                'required' => 'Please enter description.',
            ],
            'price' => [
                'required' => 'Please enter price.',
            ],
            'quantity' => [
                'required' => 'Please enter quantity.',
            ],
            'expiry_date' => [
                'required' => 'Please select expiry date.',
            ],
            'weight' => [
                'required' => 'Please enter description.',
            ],
            'unit' => [
                'required' => 'Please select unit.',
            ]
        ];
        
        
        if ($this->validate($validationRules, $validationMessages))
        {
            if($_FILES['image']['name']!='')
            {
                $documents = rand(1111,9999);
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);    
                $filename = $_FILES['image']['name'];
                $upload_path="public/Backend-Assets/images/Product/";
                $image = $documents.".".$extension;
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                // $file_ext=strtolower(end(explode('.',$filename))); 
                $reg = move_uploaded_file($file_tmp,$upload_path.$image);
                if (!empty($_POST['editImage'])) {
                    $old_file = $upload_path . $_POST['editImage'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
            }else
            {
              $image = $_POST['editImage']; 
            }

            $builder = $db->table('tbl_product');
			$productData = array(
			    'cat_id'        => $_POST['cat_id'],
                'subcat_id'     => $_POST['subcat_id'],
                'name'          => $_POST['name'],
                'description'   => $_POST['description'],
                'price'         => $_POST['price'],
                'weight'        => $_POST['weight'],
                'expiry_date'   => $_POST['expiry_date'],
                'quantity'      => $_POST['quantity'],
                'unit'          => $_POST['unit'],
                'image'         => $image
			);
			$calmsg = "Product Updated Successfully.";
			session()->set('calmsg',$calmsg); 
			$builder->where('id', $editId)->update($productData);
			return $this->response->redirect(site_url('/updateCalciumMineral?ID=' . base64_encode($editId)));
		}else
        {
            $list = $this->ProductModel->getProductById($editId);
    		$data['categoryD'] = $this->CategoryModel->getCategoryList();
            $data['subcatD'] = $this->SubcategoryModel->getSubcategoryList();
            return view('Product/updateCalciumMineral', [
                'validation'  => $validation,
                'list'        => $list, 
                'categoryD'   => $data['categoryD'],
                'subcatD'     => $data['subcatD']
            ]);
        }
    }
	
}