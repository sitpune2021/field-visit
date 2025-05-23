<?php 
namespace App\Models\Questionset;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class QuestionsetModel extends Model
{

    public function getQuestionsetList()
    {
        $query = $this->db->query("SELECT * FROM tbl_question_set WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}
    
    public function getQuestionById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_question_set WHERE id = $id");
        return $query->getRowArray();
	}

}