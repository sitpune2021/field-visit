<?php 
namespace App\Models\Officer;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class OfficerModel extends Model
{

    public function getOfficerList()
    {
        $query = $this->db->query("SELECT * FROM tbl_officer WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}
    
    public function getOfficerById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_officer WHERE id = $id");
        return $query->getRowArray();
	}

}