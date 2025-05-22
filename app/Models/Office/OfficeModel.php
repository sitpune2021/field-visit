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

}