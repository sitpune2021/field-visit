<?php
namespace App\Controllers\Questionset;
use App\Controllers\BaseController;
use App\Models\Questionset\QuestionsetModel;
use App\Models\OfficeType\OfficeTypeModel;

class QuestionsetController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->QuestionsetModel = new QuestionsetModel($db);
        $this->OfficeTypeModel = new OfficeTypeModel($db);
    }
   
    /********** Questionset List - Nikita Nanaware *************/

	public function Questionset()
    {
        $session = session();
        session()->remove('questionmsg');
        $data['questionList'] = $this->QuestionsetModel->getQuestionsetList();
        return view('Questionset/Questionset',$data);
    }

    /********** Add Questionset - Nikita Nanaware ***************/

    public function AddQuestionset()
    {
        $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
        return view('Questionset/AddQuestionset',$data);
    }

    public function AddQuestionsetPro()
    {
        $session = session();
        $db = db_connect('default');
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'office_type'  => 'required'
        ];
        $validationMessages = 
        [
            'office_type'  => [
                'required'     => 'कृपया कार्यालयाचा प्रकार निवडा.'
            ]
        ];
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $office_type     = $_POST['office_type'];
            $types           = $_POST['type'];
            $labels          = $_POST['label'];
            // $attributes      = $_POST['attribute'];
            $requireds       = $_POST['required'];
            $dropdown_values = $_POST['dropdown_values'] ?? [];
    
            $builder = $db->table('tbl_question_set');
    
            for ($i = 0; $i < count($labels); $i++) {
                $type      = isset($types[$i]) ? trim($types[$i]) : '';
                $label     = isset($labels[$i]) ? trim($labels[$i]) : '';
                // $attribute = isset($attributes[$i]) ? trim($attributes[$i]) : '';
                $required  = isset($requireds[$i]) ? trim($requireds[$i]) : '';
                $dropdown  = (in_array($type, ['dropdown', 'radio', 'checkbox']) && isset($dropdown_values[$i])) ? trim($dropdown_values[$i]) : '';

                if (!empty($label)) {
                    $builder->insert([
                        'office_type'    => $office_type,
                        'type'           => $type,
                        'label'          => $label,
                        // 'attribute'      => $attribute,
                        'required'       => $required,
                        'dropdown_value' => $dropdown, 
                    ]);
                }
            }

			$questionmsg = "प्रश्न संच यशस्विरित्या अ‍ॅड झाले आहे.";
			session()->set('questionmsg',$questionmsg); 
            return $this->response->redirect(site_url('/AddQuestionset'));
            
        }else
        {
           $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
           return view('Questionset/AddQuestionset', [
                'validation' => $validation,
                'officeTypeD' => $data['officeTypeD']
            ]);
        }
    }

    public function updateQuestionset()
    {
		$id = base64_decode($_GET['ID']);
		$list = $this->QuestionsetModel->getQuestionById($id);
        $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
        return view('Questionset/updateQuestionset', [
            'list' => $list, 
            'officeTypeD' => $data['officeTypeD']
        ]);
    }
    
    public function updateQuestionsetPro()
    {
        $session = session();
        $db      = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
		$validationRules = 
        [
            'office_type'  => 'required',
            'label'        => 'required',
            'type'         => 'required',
            'required'     => 'required'
        ];
        $validationMessages = 
        [
            'office_type'    => [
                'required' => 'Please select category.'
            ],
            'type' => [
                'required' => 'Please select type.'
            ],
            'label' => [
                'required' => 'Please enter lable.'
            ],
            'required' => [
                'required' => 'Please select required value.'
            ]
        ];
        if (isset($_POST['type']) && (($_POST['type'] === 'dropdown') || ($_POST['type'] === 'checkbox') || ($_POST['type'] === 'radio') )) {
            $validationRules['dropdown_value'] = 'required';
            $validationMessages['dropdown_value'] = [
                'required' => 'Please enter values.'
            ];
        }
    
        if ($this->validate($validationRules, $validationMessages))
        {
            $questionData = array(
			    'office_type' => $_POST['office_type'],
			    'label'       => $_POST['label'],
			    'type'        => $_POST['type'],
			    'required'    => $_POST['required'],
			    'dropdown_value'=> $_POST['dropdown_value']
			);
			$builder = $db->table('tbl_question_set');
			$questionmsg = "प्रश्न यशस्विरित्या अपडेट झाले आहे.";
            session()->set('questionmsg',$questionmsg);
            $builder->where('id', $editId)->update($questionData);
			return $this->response->redirect(site_url('/updateQuestionset?ID=' . base64_encode($editId)));
		}else
        {
            $data['officeTypeD'] = $this->OfficeTypeModel->getOfficeTypeList();
            $list = $this->QuestionsetModel->getQuestionById($editId);
			return view('Questionset/updateQuestionset', ['validation' => $validation,'officeTypeD' => $data['officeTypeD'],'list' => $list,]);
        }
    }
}