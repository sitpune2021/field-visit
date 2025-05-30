<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - कार्यालय </title>

    <?php echo view('Include/header'); ?>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 col-12">
                  <h2>कार्यालय</h2>
                </div>
                <div class="col-sm-6 col-12">
                  <ol class="breadcrumb">
                    <a href="<?= base_url();?>addOffice"><button class="btn btn-primary me-2 btn-square" type="button">अ‍ॅड कार्यालय +</button></a>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="export-button">
                        <thead>
                          <tr>
                            <th>अ.क्र.</th>
                            <th>तालुका</th>
                            <th>कार्यालय प्रकार </th>
                            <th>कार्यालय नाव </th>
                            <th>दिनांक </th>
                            <th>क्रिया</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count=1;
                                foreach($OfficeList as $row){ 
                                  $db = db_connect('default');
                                  $officeType = $row['office_type'];
                                  $query = $db->query("SELECT office_type FROM tbl_office_type WHERE id = $officeType");
                                  $officeD = $query->getRowArray();

                                  $talukaId = $row['taluka'];
                                  $query = $db->query("SELECT taluka FROM tbl_taluka WHERE id = $talukaId");
                                  $talukaD = $query->getRowArray();
                            ?>
                          <tr>
                              <td><?=$count;?></td>
                              <td><?=$talukaD['taluka'];?></td>
                              <td><?=$officeD['office_type'];?></td>
                              <td><?=$row['office'];?></td>
                              <td><?=date("d M Y h:i:s",strtotime($row['created_at']));?></td>
                              <td> 
                                <ul class="action"> 
                                  <li class="edit"> <a href="<?php echo base_url(); ?>updateOffice?ID=<?php echo base64_encode($row['id']); ?>"><i class="icon-pencil-alt"></i></a></li>
                                  <li class="delete" onClick="deleteRec(<?=$row['id'];?>);"><i class="icon-trash"></i></li>
                                </ul>
                              </td>
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
          <!-- Container-fluid Ends                 -->
        </div>
        <?php echo view('Include/footer'); ?>

  <script>
        function deleteRec(id)
        {
            var table='tbl_office';
            if (confirm('तुम्हाला खात्री आहे की तुम्हाला हे कार्यालय हटवायचे आहे ?')) {
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