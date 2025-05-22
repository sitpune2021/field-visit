<?php
$userId=$_SESSION['id']; 
$db = db_connect('default');
$query = $db->query("SELECT * FROM tbl_users WHERE login_id = $userId ");
$userD = $query->getRowArray();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords"content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
	<meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Product List </title>

	<?php echo view('Include/header'); ?>


		<div class="page-wrapper">
			<div class="content">

				<div class="mb-2 d-flex align-items-center justify-content-between">
					<div class="page-header mb-0">
						<h3 class="page-title">Product List </h3>
					</div>
					<div>
					    <?php if($userD['pm_add']=='1'){ ?>
						<a href="<?= base_url();?>addCalciumMineral">
							<button type="button" class="btn" style="background-color:#f26522;color:#fff;">
								+ New Product
							</button>
						</a>
						<?php } ?>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">

							<div class="table-responsive">
									<table class="table datatable ">
										<thead>
											<tr>
												<th>Sr.No.</th>
												<th>Category </th>
												<th>Subcategory </th>
												<th>Name </th>
												<th>Image </th>
												<th>Price </th>
												<th>Weight </th>
												<th>Unit </th>
												<th>Quantity </th>
												<th>Expiry Date </th>
												<th>Description </th>
												<th>Add Date </th>
												<?php if($userD['pm_edit']=='1' || $userD['pm_del']=='1'){ ?>
                                                <th>Action</th>
                                                <?php } ?>
											</tr>
										</thead>
										<tbody>
                                        <?php 
                                            $count=1;
                                            foreach($calMineral_list as $row){
                                                $db          = db_connect('default');
												$cat         = $row['cat_id'];
												$subcat      = $row['subcat_id'];
												$unit        = $row['unit'];
												$querycat    = $db->query("SELECT category FROM tbl_category WHERE id = $cat");
												$catD        = $querycat->getRowArray();
												$querysubcat = $db->query("SELECT subcategory FROM tbl_subcategory WHERE id = $subcat");
												$scatD       = $querysubcat->getRowArray();
												$queryunit   = $db->query("SELECT unit FROM tbl_unit WHERE id = $unit");
												$unitD       = $queryunit->getRowArray();
                                        ?>
                                        <tr>
                                            <td><?=$count;?></td>
                                            <td><?=$catD['category'];?></td>
                                            <td><?=$scatD['subcategory'];?></td>
                                            <td><?=$row['name'];?></td>
                                            <td>
                                                <?php  if (isset($row['image']) && $row['image'] != '') {
                                                    $extension = pathinfo($row['image'], PATHINFO_EXTENSION);
                                                    if($extension == "pdf"){
                                                ?>
                                                    <a target="blank" href="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$row['image'];?>"><img src="<?= base_url("public/Backend-Assets/pdficon.png");?>" alt="Balance_organization" style="height:32px;width23px;"></a>
                                                <?php }else{?>
                                                    <a target="blank" href="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$row['image'];?>"><img src="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$row['image'];?>" alt="image" width="100" height="90"></a>
                                                <?php } } ?>
                                            </td>
                                            <td><?=$row['price'];?></td>
                                            <td><?=$row['weight'];?></td>
                                            <td><?=$unitD['unit'];?></td>
                                            <td><?=$row['quantity'];?></td>
                                            <td><?=date("d M Y",strtotime($row['expiry_date']));?></td>
                                            <td><?=$row['description'];?></td>
                                            <td><?=date("d M Y h:i:s",strtotime($row['created_at']));?></td>
                                            <?php if($userD['pm_edit']=='1' || $userD['pm_del']=='1'){ ?>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <?php if($userD['pm_edit']=='1'){ ?>
                                                    <a href="<?php echo base_url(); ?>updateCalciumMineral?ID=<?php echo base64_encode($row['id']); ?>" class="btn btn-icon btn-sm btn-light"><i
                                                            class="feather-edit"></i></a>
                                                    <?php } ?>        
                                                    <?php if($userD['pm_del']=='1'){ ?>        
                                                    <div class="btn btn-icon btn-sm btn-light" onClick="deleteRec(<?=$row['id'];?>);"><i
                                                            class="feather-trash"></i>
													</div>
													<?php } ?>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php $count++; } ?>
                                        </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<?php echo view('Include/footer'); ?>

			<script>
        function deleteRec(id)
        {
            var table='tbl_product';
            if (confirm('Are you sure you want to delete this product ?')) {
            $.ajax({
            url: "<?php echo base_url();?>/deleteRec",
            type: 'post',
            data:{id:id,table:table},
            success: function(response) 
            {
                location.reload();
            }
            });
            }
        }

	</script>