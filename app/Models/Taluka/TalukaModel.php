<?php 
namespace App\Models\Taluka;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class TalukaModel extends Model
{

    public function getTalukaList()
    {
        $query = $this->db->query("SELECT * FROM tbl_taluka WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}
    
    public function getTalukaById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_taluka WHERE id = $id");
        return $query->getRowArray();
	}

}