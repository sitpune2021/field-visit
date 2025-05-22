<?php
namespace App\Controllers\Officer;
use App\Controllers\BaseController;
use App\Models\Officer\OfficerModel;

class OfficerController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->OfficerModel = new OfficerModel($db);
    }
   
    /********** Officer List - Nikita Nanaware *************/

	public function Officer()
    {
        $session = session();
        session()->remove('officermsg');
        $data['officer_list'] = $this->OfficerModel->getOfficerList();
        return view('Officer/Officer',$data);
    }

    /********** Add Officer - Nikita Nanaware *************/

    public function AddOfficer()
    {
        return view('Officer/AddOfficer');
    }

    public function AddOfficerPro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'officer'  => 'required',
        ];
        $validationMessages = 
        [
            'officer'  => [
                'required'     => 'कृपया अधिकारी प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officer  = $_POST['officer'];
            $existingofficer = $db->table('tbl_officer')
                ->where('officer', $officer)
                ->where('isdeleted', 0)
                ->get()
                ->getRow();
            if ($existingofficer) {
                session()->setFlashdata('errorOfficer', 'हा अधिकारी आधीच अस्तित्वात आहे.');
                return redirect()->to('/AddOfficer')->withInput();
            }

            $builder = $db->table('tbl_officer');
			
			$officerData = array(
			    'officer'  => $_POST['officer']
			);
			
			$officermsg = "अधिकारी यशस्विरित्या अ‍ॅड झाला आहे.";
			session()->set('officermsg',$officermsg); 
            $builder->insert($officerData);
            return $this->response->redirect(site_url('/AddOfficer'));
            
        }else
        {
            $data['officer_list'] = $this->OfficerModel->getOfficerList();
            return view('Officer/AddOfficer', [
                'validation' => $validation,
                'officer_list' => $data['officer_list']
            ]);
        }
    }

    /********* Update Officer - Nikita Nanaware *************/
	public function UpdateOfficer()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->OfficerModel->getOfficerById($id);
		$data['officer_list'] = $this->OfficerModel->getOfficerList();
        return view('Officer/UpdateOfficer', [
        'list' => $list, 
        'officer_list' => $data['officer_list']
    ]);
    }
	
	public function UpdateOfficerPro()
    {
		$session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
		$validationRules = 
        [
            'officer'  => 'required',
        ];
        $validationMessages = 
        [
            'officer'  => [
                'required'     => 'कृपया अधिकारी प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $officer  = $_POST['officer'];
            $existingofficer = $db->table('tbl_officer')
                ->where('officer', $officer)
                ->where('isdeleted', 0)
                ->where('id !=', $editId)
                ->get()
                ->getRow();
    
            if ($existingofficer) {
                $data['list'] = $this->OfficerModel->getOfficerById($editId);
                session()->setFlashdata('errorOfficer', 'हा अधिकारी आधीच अस्तित्वात आहे.');
                return view('Officer/UpdateOfficer', [
                    'validation' => $validation,
                    'errorOfficer' => 'हा अधिकारी आधीच अस्तित्वात आहे.',
                    'id' => $editId,
                    'list' => $data['list']
                ]);
            }

            $builder = $db->table('tbl_officer');
			$officerData = array(
			    'officer'  => $_POST['officer']
			);

			$officermsg = "अधिकारी यशस्विरित्या अपडेट झाला आहे.";
			session()->set('officermsg',$officermsg); 	
			$builder->where('id', $editId)->update($officerData);
			return $this->response->redirect(site_url('/UpdateOfficer?ID=' . base64_encode($editId)));
		}else
        {
            $data['officer_list'] = $this->OfficerModel->getOfficerList();
            $list = $this->OfficerModel->getOfficerById($editId);
			return view('Officer/UpdateOfficer', ['validation' => $validation,'list' => $list,'officer_list' => $data['officer_list']]);
        }
    }
	
}