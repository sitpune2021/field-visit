<?php
namespace App\Controllers\Taluka;
use App\Controllers\BaseController;
use App\Models\Taluka\TalukaModel;

class TalukaController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->TalukaModel = new TalukaModel($db);
    }
   
    /********** Taluka List - Nikita Nanaware *************/

	public function Taluka()
    {
        $session = session();
        session()->remove('talukamsg');
        $data['taluka_list'] = $this->TalukaModel->getTalukaList();
        return view('Taluka/Taluka',$data);
    }

    /********** Add Taluka - Nikita Nanaware *************/

    public function AddTaluka()
    {
        return view('Taluka/AddTaluka');
    }

    public function AddTalukaPro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'taluka'  => 'required',
        ];
        $validationMessages = 
        [
            'taluka'  => [
                'required'     => 'कृपया तालुका प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $taluka  = $_POST['taluka'];
            $existingTaluka = $db->table('tbl_taluka')
                ->where('taluka', $taluka)
                ->where('isdeleted', 0)
                ->get()
                ->getRow();
            if ($existingTaluka) {
                session()->setFlashdata('errorTaluka', 'हा तालुका आधीच अस्तित्वात आहे.');
                return redirect()->to('/AddTaluka')->withInput();
            }

            $builder = $db->table('tbl_taluka');
			
			$talukaData = array(
			    'taluka'  => $_POST['taluka']
			);
			
			$talukamsg = "तालुका यशस्विरित्या अ‍ॅड झाला आहे.";
			session()->set('talukamsg',$talukamsg); 
            $builder->insert($talukaData);
            return $this->response->redirect(site_url('/AddTaluka'));
            
        }else
        {
            $data['taluka_list'] = $this->TalukaModel->getTalukaList();
            return view('Taluka/AddTaluka', [
                'validation' => $validation,
                'taluka_list' => $data['taluka_list']
            ]);
        }
    }

    /********* Update Taluka - Nikita Nanaware *************/
	public function UpdateTaluka()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->TalukaModel->getTalukaById($id);
		$data['taluka_list'] = $this->TalukaModel->getTalukaList();
        return view('Taluka/UpdateTaluka', [
        'list' => $list, 
        'taluka_list' => $data['taluka_list']
    ]);
    }
	
	public function UpdateTalukaPro()
    {
		$session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'taluka'  => 'required',
        ];
        $validationMessages = 
        [
            'taluka'  => [
                'required'     => 'कृपया तालुका प्रविष्ठ करा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $taluka  = $_POST['taluka'];
            $existingTaluka = $db->table('tbl_taluka')
                ->where('taluka', $taluka)
                ->where('isdeleted', 0)
                ->where('id !=', $editId)
                ->get()
                ->getRow();
    
            if ($existingTaluka) {
                $data['list'] = $this->TalukaModel->getTalukaById($editId);
                session()->setFlashdata('errorTaluka', 'हा तालुका आधीच अस्तित्वात आहे.');
                return view('Taluka/UpdateTaluka', [
                    'validation' => $validation,
                    'errorTaluka' => 'हा तालुका आधीच अस्तित्वात आहे.',
                    'id' => $editId,
                    'list' => $data['list']
                ]);
            }

            $builder = $db->table('tbl_taluka');
			$talukaData = array(
			    'taluka'  => $_POST['taluka']
			);

			$talukamsg = "तालुका यशस्विरित्या अपडेट झाला आहे.";
			session()->set('talukamsg',$talukamsg); 	
			$builder->where('id', $editId)->update($talukaData);
			return $this->response->redirect(site_url('/UpdateTaluka?ID=' . base64_encode($editId)));
		}else
        {
            $data['taluka_list'] = $this->TalukaModel->getTalukaList();
            $list = $this->TalukaModel->getTalukaById($editId);
			return view('Taluka/UpdateTaluka', ['validation' => $validation,'list' => $list,'taluka_list' => $data['taluka_list']]);
        }
    }
	
}