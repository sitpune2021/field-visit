<?php 
namespace App\Models\Product;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class ProductModel extends Model
{

    public function getProductList()
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE isdeleted = 0 order by id desc");
        return $query->getResultArray();
	}
    
    public function getProductById($id)
    {
        $query = $this->db->query("SELECT * FROM tbl_product WHERE id = $id");
        return $query->getRowArray();
	}
	
	public function getUnitByCategory($cat)
    {
        $query = $this->db->query("SELECT id,unit FROM tbl_unit WHERE cat_id = $cat and isdeleted=0");
        return $query->getResultArray();
	}
	public function getSubcatByCat($cat)
    {
        $query = $this->db->query("SELECT id,subcategory FROM tbl_subcategory WHERE cat_id = $cat and isdeleted=0");
        return $query->getResultArray();
	}

}