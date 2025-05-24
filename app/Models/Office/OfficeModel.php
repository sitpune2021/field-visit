<?php 
namespace App\Models\Office;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class OfficeModel extends Model
{

    public function getOfficeList()
    {
        $query = $this->db->query("SELECT * FROM tbl_office WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}
    
    public function getOfficeById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_office WHERE id = $id");
        return $query->getRowArray();
	}

    public function getOfficeByTypeAndTaluka($office_type_id,$taluka_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_office WHERE office_type = $office_type_id AND taluka=$taluka_id AND isdeleted = 0");
        return $query->getResultArray();
	}

}