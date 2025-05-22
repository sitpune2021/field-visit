<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - अ‍ॅड कार्यालय </title>
   
    <?php echo view('Include/header'); ?>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 col-12">
                  <h2>अ‍ॅड कार्यालय </h2>
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
                       <?php echo form_open('/AddOfficePro', array('autocomplete' => 'off','class' => 'p-0 row')); ?>

                       <div class="row mb-4 mt-3">

                       <div class="col-md-6 mb-3">
                          <label class="form-label" for="exampleFormControlInput1">तालुका  <span class="mandatory">*</span></label>
                          <?php $talukaid = isset($talukaid) ? $talukaid : set_value('taluka'); ?>
                            <select class="form-select" aria-label="Default select example" name="taluka" id="taluka">
                                <option value="">तालुका निवडा</option>
                                <?php foreach($talukaD as $taluka) { ?>
                                    <option value="<?= $taluka['id']; ?>" 
                                        <?php if($talukaid == $taluka['id']) { echo 'selected'; } ?>>
                                        <?= $taluka['taluka']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('taluka')){ ?>
                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                    <?= $validation->getError('taluka'); ?>
                                </div>
                            <?php } ?>
                        </div>

                       <div class="col-md-6">
                          <label class="form-label" for="exampleFormControlInput1">कार्यालय प्रकार <span class="mandatory">*</span></label>
                          <?php $officeTypeid = isset($officeTypeid) ? $officeTypeid : set_value('office_type'); ?>
                            <select class="form-select" aria-label="Default select example" name="office_type" id="office_type">
                                <option value="">कार्यालय प्रकार निवडा</option>
                                <?php foreach($officeTypeD as $officeType) { ?>
                                    <option value="<?= $officeType['id']; ?>" 
                                        <?php if($officeTypeid == $officeType['id']) { echo 'selected'; } ?>>
                                        <?= $officeType['office_type']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('office_type')){ ?>
                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                    <?= $validation->getError('office_type'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-6">
                          <label class="form-label" for="exampleFormControlInput1">कार्यालय <span class="mandatory">*</span></label>
                          <input class="form-control AlphabetsOnlyWithSpace" id="office" name="office" type="text" placeholder="कार्यालय प्रविष्ठ करा." value="<?= set_value('office'); ?>">
                            <?php if (isset($validation) && $validation->hasError('office')){ ?>
                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                    <?= $validation->getError('office'); ?>
                                </div>
                            <?php } else if(session()->getFlashdata('errorOffice')){ ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('errorOffice'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        </div>
                        <div class="row">
                            <div class="text-start">
                            <button class="btn btn-primary me-2 btn-square" type="submit">Submit</button>
                            <input class="btn btn-danger btn-square" type="reset" value="Cancel">
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
                        <h5 class="modal-title" id="staticBackdropLabel">कार्यालय </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-2" style="text-align: center;">
                            <i class="mdi mdi-check-circle" aria-hidden="true" style="font-size: 45px;color: #06a406;"></i>
                        </div>
                        <div class="col-md-10 my-4" style="font-size: 18px;font-weight: 800;">
                            <?php  $session = session(); error_reporting(0); echo $_SESSION['officemsg'];?>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light text-dark me-2" data-bs-dismiss="modal">Close</button>
                            <a href="<?php echo base_url(); ?>officeList"><button type="button" class="btn btn-primary">Ok</button></a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('Include/footer'); ?>

<script>
$( document ).ready(function(){
    var homeunmsg='<?=$_SESSION['officemsg'];?>';
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
    control.makeTransliteratable(["office"]);
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