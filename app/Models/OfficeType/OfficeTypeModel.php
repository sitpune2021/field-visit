<?php 
namespace App\Models\OfficeType;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class OfficeTypeModel extends Model
{

    public function getOfficeTypeList()
    {
        $query = $this->db->query("SELECT * FROM tbl_office_type WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}

    public function getOfficeTypeForUpdate()
    {
        $query = $this->db->query("SELECT * FROM tbl_office_type order by id desc");
        return $query->getResultArray();
	}
    
    public function getOfficeTypeById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_office_type WHERE id = $id");
        return $query->getRowArray();
	}

}