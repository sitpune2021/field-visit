<?php
namespace App\Controllers\Office;
use App\Controllers\BaseController;
use App\Models\Office\OfficeModel;
use App\Models\OfficeType\OfficeTypeModel;
use App\Models\Taluka\TalukaModel;

class OfficeController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->OfficeModel = new OfficeModel($db);
        $this->OfficeTypeModel = new OfficeTypeModel($db);
        $this->TalukaModel = new TalukaModel($db);
    }
   
    /********** Office List - Nikita Nanaware *************/

	public function officeList()
    {
        $session = session();
        session()->remove('officemsg');
        $data['OfficeList'] = $this->OfficeModel->getOfficeList();
        return view('Office/officeList',$data);
    }

    /********** Add Office - Nikita Nanaware *************/

    public function AddOffice()
    {
        $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
        $data['talukaD'] = $this->TalukaModel->getTalukaList();
        return view('Office/AddOffice',$data);
    }

    public function AddOfficePro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'taluka'       => 'required',
            'office_type'  => 'required',
            'office'       => 'required'
        ];
        $validationMessages = 
        [
            'taluka'  => [
                'required'     => 'कृपया तालुका निवडा.'
            ],
            'office_type'  => [
                'required'     => 'कृपया कार्यालयाचा प्रकार निवडा.'
            ],
            'office'  => [
                'required'     => 'कृपया कार्यालय प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officeType  = $_POST['office_type'];
            $officeName  = $_POST['office'];
            $taluka      = $_POST['taluka'];
            $existingOffice = $db->table('tbl_office')
                ->where('office_type', $officeType)
                ->where('office', $officeName)
                ->where('taluka', $taluka)
                ->where('isdeleted', 0)
                ->get()
                ->getRow();
            if ($existingOffice) {
                session()->setFlashdata('errorOffice', 'निवडलेल्या कार्यालय प्रकारात हे कार्यालय आधीच अस्तित्वात आहे.');
                return redirect()->to('/addOffice')->withInput();
            }


            $builder = $db->table('tbl_office');
			
			$officeData = array(
                'taluka'       => $_POST['taluka'],
			    'office_type'  => $_POST['office_type'],
                'office'       => $_POST['office']
			);
			
			$officemsg = "कार्यालय यशस्विरित्या अ‍ॅड झाले आहे.";
			session()->set('officemsg',$officemsg); 
            $builder->insert($officeData);
            return $this->response->redirect(site_url('/addOffice'));
            
        }else
        {
           $data['talukaD'] = $this->TalukaModel->getTalukaList();
           $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
           $data['OfficeList'] = $this->OfficeModel->getOfficeList();
            return view('Office/addOffice', [
                'validation' => $validation,
                'OfficeList' => $data['OfficeList'],
                'officeTypeD' => $data['officeTypeD'],
                'talukaD' => $data['talukaD']
            ]);
        }
    }

    /********* Update Office - Nikita Nanaware *************/
	public function updateOffice()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->OfficeModel->getOfficeById($id);
        $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeForUpdate();
        $data['talukaD'] = $this->TalukaModel->getTalukaList();
		$data['OfficeList'] = $this->OfficeModel->getOfficeList();
        return view('Office/updateOffice', [
        'list' => $list, 
        'OfficeList' => $data['OfficeList'],
        'officeTypeD' => $data['officeTypeD'],
        'talukaD' => $data['talukaD']
    ]);
    }
	
	public function updateOfficePro()
    {
		$session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
		$validationRules = 
        [
            'taluka'       => 'required',
            'office_type'  => 'required',
            'office'       => 'required'
        ];
        $validationMessages = 
        [
            'taluka'  => [
                'required'     => 'कृपया तालुका निवडा.'
            ],
            'office_type'  => [
                'required'     => 'कृपया कार्यालयाचा प्रकार निवडा.'
            ],
            'office'  => [
                'required'     => 'कृपया कार्यालय प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officeType   = $_POST['office_type'];
            $office       = $_POST['office'];
            $taluka      = $_POST['taluka'];
            $existingOffice = $db->table('tbl_office')
                ->where('office_type', $officeType)
                ->where('office', $office)
                ->where('taluka', $taluka)
                ->where('id !=', $editId)
                ->where('isdeleted', 0)
                ->get()
                ->getRow();
    
            if ($existingOffice) {
                $data['talukaD'] = $this->TalukaModel->getTalukaList();
                $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeForUpdate();
                $data['list'] = $this->OfficeModel->getOfficeById($editId);
                session()->setFlashdata('errorOffice', 'निवडलेल्या कार्यालय प्रकारात हे कार्यालय आधीच अस्तित्वात आहे.');
                return view('Office/updateOffice', [
                    'validation' => $validation,
                    'errorOffice' => 'निवडलेल्या कार्यालय प्रकारात हे कार्यालय आधीच अस्तित्वात आहे',
                    'id' => $editId,
                    'list' => $data['list'],
                    'officeTypeD' => $data['officeTypeD'],
                    'talukaD' => $data['talukaD']
                ]);
            }

            $builder = $db->table('tbl_office');
			$officeData = array(
                'taluka'       => $_POST['taluka'],
			    'office_type'  => $_POST['office_type'],
                'office'       => $_POST['office'],
			);

			$officemsg = "कार्यालय यशस्विरित्या अपडेट झाले आहे.";
			session()->set('officemsg',$officemsg); 	
			$builder->where('id', $editId)->update($officeData);
            return $this->response->redirect(site_url('/updateOffice?ID=' . base64_encode($editId)));
		}else
        {
            $data['talukaD'] = $this->TalukaModel->getTalukaList();
            $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeForUpdate();
            $data['OfficeList'] = $this->OfficeModel->getOfficeList();
            $list = $this->OfficeModel->getOfficeById($editId);
			return view('Office/UpdateOffice', ['validation' => $validation,'list' => $list,'OfficeList' => $data['OfficeList'],'officeTypeD' => $data['officeTypeD'],'talukaD' => $data['talukaD']]);
        }
    }
	
}