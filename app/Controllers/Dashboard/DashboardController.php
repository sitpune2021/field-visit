<?php
namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct() {
                
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
    }
    
    /** Admin Dashboard - Nikita Nanaware**/
    public function adminDashboard()
    {
        return view('Dashboard/adminDashboard');
    }
    
    public function employeeDashboard()
    {
        return view('Dashboard/employeeDashboard');
    }
	
}