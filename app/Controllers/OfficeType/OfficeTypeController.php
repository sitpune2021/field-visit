<?php
namespace App\Controllers\OfficeType;
use App\Controllers\BaseController;
use App\Models\OfficeType\OfficeTypeModel;

class OfficeTypeController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->OfficeTypeModel = new OfficeTypeModel($db);
    }
   
    /********** Office Type List - Nikita Nanaware *************/

	public function officeTypeList()
    {
        $session = session();
        session()->remove('officeTypemsg');
        $data['OfficeTypeList'] = $this->OfficeTypeModel->getOfficeTypeList();
        return view('OfficeType/officeTypeList',$data);
    }

    /********** Add Office Type - Nikita Nanaware *************/

    public function AddOfficeType()
    {
        return view('OfficeType/AddOfficeType');
    }

    public function AddOfficeTypePro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'office_type'  => 'required',
        ];
        $validationMessages = 
        [
            'office_type'  => [
                'required'     => 'कृपया कार्यालयाचा प्रकार प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officeType  = $_POST['office_type'];
            $existingOfficeType = $db->table('tbl_office_type')
                ->where('office_type', $officeType)
                ->where('isdeleted', 0)
                ->get()
                ->getRow();
            if ($existingOfficeType) {
                session()->setFlashdata('errorOfficeype', 'हा कार्यालयाचा प्रकार आधीच अस्तित्वात आहे.');
                return redirect()->to('/addOfficeType')->withInput();
            }

            $builder = $db->table('tbl_office_type');
			
			$officeTypeData = array(
			    'office_type'  => $_POST['office_type']
			);
			
			$officeTypemsg = "कार्यालयाचा प्रकार यशस्विरित्या अ‍ॅड झाला आहे.";
			session()->set('officeTypemsg',$officeTypemsg); 
            $builder->insert($officeTypeData);
            return $this->response->redirect(site_url('/addOfficeType'));
            
        }else
        {
           $data['OfficeTypeList'] = $this->OfficeTypeModel->getOfficeTypeList();
            return view('OfficeType/addOfficeType', [
                'validation' => $validation,
                'OfficeTypeList' => $data['OfficeTypeList']
            ]);
        }
    }

    /********* Update Office Type - Nikita Nanaware *************/
	public function updateOfficeType()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->OfficeTypeModel->getOfficeTypeById($id);
		$data['OfficeTypeList'] = $this->OfficeTypeModel->getOfficeTypeList();
        return view('OfficeType/UpdateOfficeType', [
        'list' => $list, 
        'OfficeTypeList' => $data['OfficeTypeList']
    ]);
    }
	
	public function updateOfficeTypePro()
    {
		$session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
		$validationRules = 
        [
            'office_type'  => 'required',
        ];
        $validationMessages = 
        [
            'office_type'  => [
                'required'     => 'कृपया कार्यालयाचा प्रकार प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officeType  = $_POST['office_type'];
            $existingOfficeType = $db->table('tbl_office_type')
                ->where('office_type', $officeType)
                ->where('isdeleted', 0)
                ->where('id !=', $editId)
                ->get()
                ->getRow();
    
            if ($existingOfficeType) {
                $data['list'] = $this->OfficeTypeModel->getOfficeTypeById($editId);
                session()->setFlashdata('errorOfficeype', 'हा कार्यालयाचा प्रकार आधीच अस्तित्वात आहे.');
                return view('officeType/UpdateofficeType', [
                    'validation' => $validation,
                    'errorOfficeype' => 'हा कार्यालयाचा प्रकार आधीच अस्तित्वात आहे.',
                    'id' => $editId,
                    'list' => $data['list']
                ]);
            }

            $builder = $db->table('tbl_office_type');
			$officeTypeData = array(
			    'office_type'  => $_POST['office_type']
			);

			$officeTypemsg = "कार्यालय प्रकार यशस्विरित्या अपडेट झाला आहे.";
			session()->set('officeTypemsg',$officeTypemsg); 	
			$builder->where('id', $editId)->update($officeTypeData);
            return $this->response->redirect(site_url('/updateOfficeType?ID=' . base64_encode($editId)));
		}else
        {
            $data['OfficeTypeList'] = $this->OfficeTypeModel->getOfficeTypeList();
            $list = $this->OfficeTypeModel->getOfficeTypeById($editId);
			return view('OfficeType/UpdateOfficeType', ['validation' => $validation,'list' => $list,'OfficeTypeList' => $data['OfficeTypeList']]);
        }
    }
	
}