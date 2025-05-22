<?php
$userId=$_SESSION['id']; 
$db = db_connect('default');
$query = $db->query("SELECT * FROM tbl_users WHERE login_id = $userId");
$userD = $query->getRowArray();

function getStatusColor($category) {
    switch(strtolower($category)) {
        case 'जनावरे': return 'text-success';
        case 'चारा': return 'text-secondary';
        case 'मशीन': return 'text-warning';
        case 'शेणखत': return 'text-danger';
        case 'कॅलशीयम मिनरल मिक्सचर': return 'text-primary';
        default: return 'text-muted';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard </title>

    <?php echo view('Include/header'); ?>


		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<!-- Breadcrumb -->
				<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
					<div class="my-auto mb-2">
						<h2 class="mb-1"><?php if($_SESSION['user_type']=='1'){ echo "Admin";} else if($_SESSION['user_type']=='2'){ echo "Employee";}?> Dashboard</h2>
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item">
									<a href="index.html"><i class="ti ti-smart-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									Dashboard
								</li>
								<li class="breadcrumb-item active" aria-current="page"><?php if($_SESSION['user_type']=='1'){ echo "Admin";} else if($_SESSION['user_type']=='2'){ echo "Employee";}?> Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- /Breadcrumb -->

				<div class="row">

					<!-- Widget Info -->
					<div class="col-xxl-8 d-flex">
						<div class="row flex-fill">
							<div class="col-md-3 d-flex">
								<div class="card flex-fill">
									<div class="card-body">
										<span class="avatar rounded-circle bg-primary mb-2">
											<i class="ti ti-layout-grid"></i>
										</span>
										<h6 class="fs-13 fw-medium text-default mb-1">Category Overview</h6>
										<h3 class="mb-3"><?= sizeof($categoryD); ?></h3>
										<a href="<?= base_url();?>categoryList" class="link-default">View Details</a>
									</div>
								</div>
							</div>
							<div class="col-md-3 d-flex">
								<div class="card flex-fill">
									<div class="card-body">
										<span class="avatar rounded-circle bg-secondary mb-2">
											<i class="ti ti-browser fs-16"></i>
										</span>
										<h6 class="fs-13 fw-medium text-default mb-1">Total No of Project's</h6>
										<h3 class="mb-3">90/125 <span class="fs-12 fw-medium text-danger"><i class="fa-solid fa-caret-down me-1"></i>-2.1%</span></h3>
										<a href="projects.html" class="link-default">View All</a>
									</div>
								</div>
							</div>
							<div class="col-md-3 d-flex">
								<div class="card flex-fill">
									<div class="card-body">
										<span class="avatar rounded-circle bg-info mb-2">
											<i class="ti ti-users-group fs-16"></i>
										</span>
										<h6 class="fs-13 fw-medium text-default mb-1">Total No of Clients</h6>
										<h3 class="mb-3">69/86 <span class="fs-12 fw-medium text-danger"><i class="fa-solid fa-caret-down me-1"></i>-11.2%</span></h3>
										<a href="clients.html" class="link-default">View All</a>
									</div>
								</div>
							</div>
							<div class="col-md-3 d-flex">
								<div class="card flex-fill">
									<div class="card-body">
										<span class="avatar rounded-circle bg-pink mb-2">
											<i class="ti ti-checklist fs-16"></i>
										</span>
										<h6 class="fs-13 fw-medium text-default mb-1">Total No of Tasks</h6>
										<h3 class="mb-3">225/28 <span class="fs-12 fw-medium text-success"><i class="fa-solid fa-caret-down me-1"></i>+11.2%</span></h3>
										<a href="tasks.html" class="link-default">View All</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Widget Info -->

				</div>

				<div class="row">

					<!-- Attendance Overview -->
					<div class="col-xxl-4 col-xl-6 d-flex">
						<div class="card flex-fill">
							<div class="card-header pb-2 d-flex align-items-center justify-content-between flex-wrap">
								<h5 class="mb-2">Post Overview</h5>
								<div class="dropdown mb-2">
									<a href="javascript:void(0);" class="btn btn-white border btn-sm d-inline-flex align-items-center" data-bs-toggle="dropdown">
										<i class="ti ti-calendar me-1"></i>Today
									</a>
									<ul class="dropdown-menu  dropdown-menu-end p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">This Month</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">This Week</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Today</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body">
								<div class="chartjs-wrapper-demo position-relative mb-4">
									<canvas id="attendance" height="200"></canvas>
									<div class="position-absolute text-center attendance-canvas">
										<p class="fs-13 mb-1">Total Post</p>
										<h3>120</h3>
									</div>
								</div>
								<h6 class="mb-3">Status</h6>
                                <?php foreach($categoryD as $row): ?>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="f-13 mb-2">
                                            <i class="ti ti-circle-filled <?= getStatusColor($row['category']) ?> me-1"></i>
                                            <?= $row['category']; ?>
                                        </p>
                                        <p class="f-13 fw-medium text-gray-9 mb-2"><?= sizeof($row); ?></p>
                                    </div>
                                <?php endforeach; ?>


								<div class="bg-light br-5 box-shadow-xs p-2 pb-0 d-flex align-items-center justify-content-between flex-wrap">
									<div class="d-flex align-items-center">
										<p class="mb-2 me-2">Total Post</p>
										<div class="avatar-list-stacked avatar-group-sm mb-2">
											<a class="avatar bg-primary avatar-rounded text-fixed-white fs-10" href="javascript:void(0);">
												10
											</a>
										</div>
									</div>
									<a href="<?= base_url(); ?>postList" class="fs-13 link-primary text-decoration-underline mb-2">View Details</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Attendance Overview -->
				</div>

			</div>


	<!-- /Main Wrapper -->
    <?php echo view('Include/footer'); ?>