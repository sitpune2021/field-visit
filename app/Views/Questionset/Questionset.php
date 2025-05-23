<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - प्रश्नसंच  </title>

    <?php echo view('Include/header'); ?>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 col-12">
                  <h2>प्रश्नसंच </h2>
                </div>
                <div class="col-sm-6 col-12">
                  <ol class="breadcrumb">
                    <a href="<?= base_url();?>AddQuestionset"><button class="btn btn-primary me-2 btn-square" type="button">अ‍ॅड प्रश्नसंच  +</button></a>
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
                            <th>कार्यालय प्रकार </th>
                            <th>प्रकार   </th>
                            <!-- <th>फील्ड  </th> -->
                            <th>प्रश्न  </th>
                            <th>पर्याय </th>
                            <th>आवश्यक  </th>
                            <th>दिनांक </th>
                            <th>क्रिया</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count=1;
                                foreach($questionList as $row){ 
                                  $db = db_connect('default');
                                  $required=$row['required'];
                                  $officeType = $row['office_type'];
                                  $query = $db->query("SELECT office_type FROM tbl_office_type WHERE id = $officeType");
                                  $officeD = $query->getRowArray();
                            ?>
                          <tr>
                              <td><?=$count;?></td>
                              <td><?=$officeD['office_type'];?></td>
                              <td><?=$row['type'];?></td>
                              <!-- <td><?//=$row['attribute'];?></td> -->
                              <td><?=$row['label'];?></td>
                              <td><?=$row['dropdown_value'];?></td>
                              <td><?php if($required=='yes'){echo "होय";} else {echo "नाही";}?></td>
                              <td><?=date("d M Y h:i:s",strtotime($row['created_at']));?></td>
                              <td> 
                                <ul class="action"> 
                                  <li class="edit"> <a href="<?php echo base_url(); ?>updateQuestionset?ID=<?php echo base64_encode($row['id']); ?>"><i class="icon-pencil-alt"></i></a></li>
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
            var table='tbl_question_set';
            if (confirm('तुम्हाला खात्री आहे की तुम्हाला हा प्रश्न हटवायचा आहे ?')) {
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