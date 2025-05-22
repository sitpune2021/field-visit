<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - अपडेट  अधिकारी </title>
   
    <?php echo view('Include/header'); ?>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 col-12">
                  <h2>अपडेट  अधिकारी </h2>
                </div>
                <div class="col-sm-6 col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Form Controls</li>
                    <li class="breadcrumb-item active">Base Inputs</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts  -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body basic-form">
                    <div class="card-wrapper border rounded-3">
                       <?php echo form_open('/UpdateOfficerPro', array('autocomplete' => 'off','class' => 'p-0 row')); ?>
                        <input type="hidden" name="id" value="<?= !empty($list['id']) ? $list['id'] : '' ?>">

                       <div class="row mb-4 mt-3">
                        <div class="col-md-6">
                          <label class="form-label" for="exampleFormControlInput1">अधिकारी <span class="mandatory">*</span></label>
                          <input class="form-control AlphabetsOnlyWithSpace" id="officer" name="officer" type="text" placeholder="अधिकारी प्रविष्ठ करा." value="<?= $list['officer'] ?? set_value('officer'); ?>">
                            <?php if (isset($validation) && $validation->hasError('officer')){ ?>
                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                    <?= $validation->getError('officer'); ?>
                                </div>
                            <?php } else if(session()->getFlashdata('errorOfficer')){ ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('errorOfficer'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        </div>
                        <div class="row">
                            <div class="text-start">
                            <button class="btn btn-primary me-2 btn-square" type="submit">Update</button>
                            <a href="<?= base_url(); ?>Officer"><input class="btn btn-danger btn-square" type="button" value="Cancel"></a>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">अधिकारी </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-2" style="text-align: center;">
                            <i class="mdi mdi-check-circle" aria-hidden="true" style="font-size: 45px;color: #06a406;"></i>
                        </div>
                        <div class="col-md-10 my-4" style="font-size: 18px;font-weight: 800;">
                            <?php  $session = session(); error_reporting(0); echo $_SESSION['officermsg'];?>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light text-dark me-2" data-bs-dismiss="modal">Close</button>
                         <a href="<?= base_url(); ?>Officer"><input class="btn btn-danger btn-square" type="button" value="Cancel"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('Include/footer'); ?>

<script>
$( document ).ready(function(){
    var homeunmsg='<?=$_SESSION['officermsg'];?>';
    if(homeunmsg!='')
    {
        $('#staticBackdrop').modal('show');
    }
});

google.load("elements", "1", {
    packages: "transliteration"
});
function onLoad() {
    var options = {
        sourceLanguage:
            google.elements.transliteration.LanguageCode.ENGLISH,
        destinationLanguage:
            google.elements.transliteration.LanguageCode.MARATHI,
        transliterationEnabled: true,
    };

    var control = new google.elements.transliteration.TransliterationControl(options);
    control.makeTransliteratable(["officer"]);
}
google.setOnLoadCallback(onLoad);

$('.AlphabetsOnlyWithSpace').keypress(function (e) {
    var regex = new RegExp(/^[a-zA-Z\s]+$/); 
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }
});
</script>