<?php
namespace App\Controllers\Common;
use App\Controllers\BaseController;

class CommonController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
    }
   
    public function deleteRec()
    {
        $id     = $_POST['id'];
        $table  = $_POST['table'];
        $db = db_connect('default');
        $dDate = array('isdeleted'	=> 1);
        $builder = $db->table($table);
        $builder->where('id', $id)->update($dDate);
        return true;
    }
    
   
}
