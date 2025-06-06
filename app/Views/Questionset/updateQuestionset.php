<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - अपडेट  प्रश्नसंच </title>
   
    <?php echo view('Include/header'); ?>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 col-12">
                  <h2>अपडेट  प्रश्नसंच </h2>
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
                       <?php echo form_open('/UpdateQuestionsetPro', array('autocomplete' => 'off','class' => 'p-0 row')); ?>
                        <input type="hidden" name="id" value="<?= !empty($list['id']) ? $list['id'] : '' ?>">

                       <div class="row mb-4 mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="exampleFormControlInput1">कार्यालय प्रकार<span class="mandatory">*</span></label>
                                <?php $officeTypeid = $list['office_type'] ?? set_value('office_type'); ?>
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
                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">टाईप <span class="text-danger">*</span></label>
                                <?php $type = $list['type'] ?? set_value('type');  ?>
                                <select name="type" class="form-select">
                                    <option value="">टाईप निवडा</option>
                                    <option value="text" <?= ($type == 'text') ? 'selected' : '' ?>>Text</option>
                                    <option value="number" <?= ($type == 'number') ? 'selected' : '' ?>>Number</option>
                                    <option value="email" <?= ($type == 'email') ? 'selected' : '' ?>>Email</option>
                                    <option value="dropdown" <?= ($type == 'dropdown') ? 'selected' : '' ?>>Dropdown</option>
                                    <option value="radio" <?= ($type == 'radio') ? 'selected' : '' ?>>Radio</option>
                                    <option value="checkbox" <?= ($type == 'checkbox') ? 'selected' : '' ?>>Checkbox</option>
                                    <option value="textarea" <?= ($type == 'textarea') ? 'selected' : '' ?>>Textarea</option>
                                    <option value="file" <?= ($type == 'file') ? 'selected' : '' ?>>File</option>
                                </select>

                                </select>
                                <?php if (isset($validation) && $validation->hasError('type')){ ?>
                                    <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                        <?= $validation->getError('type'); ?>
                                    </div>
                                <?php }  ?>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">प्रश्न <span class="text-danger">*</span></label>
                                <input type="text" id="label" name="label" class="form-control AlphabetsOnlyWithSpace" placeholder="प्रश्न प्रविष्ठ करा" value="<?= $list['label'] ?? set_value('label'); ?>">
                                <?php if (isset($validation) && $validation->hasError('label')){ ?>
                                    <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                        <?= $validation->getError('label'); ?>
                                    </div>
                                <?php }  ?>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">आवश्यक आहे का? <span class="text-danger">*</span></label>
                                <?php $required = $list['required'] ?? set_value('required');  ?>
                                <select name="required" class="form-select">
                                    <option value="">Select Required</option>
                                    <option value="yes" <?= ($required == 'yes') ? 'selected' : '' ?>>होय</option>
                                    <option value="no" <?= ($required == 'no') ? 'selected' : '' ?>>नाही</option>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('required')){ ?>
                                    <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                        <?= $validation->getError('required'); ?>
                                    </div>
                                <?php }  ?>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">पर्याय <span class="text-danger">*</span></label>
                                <input type="text" id="dropdown_value" name="dropdown_value" class="form-control" placeholder="Enter comma-seperated (eg. female,male,other)" value="<?= $list['dropdown_value'] ?? set_value('attribute'); ?>">
                                <?php if (isset($validation) && $validation->hasError('dropdown_value')){ ?>
                                    <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                        <?= $validation->getError('dropdown_value'); ?>
                                    </div>
                                <?php }  ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-start">
                            <button class="btn btn-primary me-2 btn-square" type="submit">Update</button>
                            <a href="<?= base_url(); ?>Questionset"><input class="btn btn-danger btn-square" type="button" value="Cancel"></a>
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
                        <h5 class="modal-title" id="staticBackdropLabel">प्रश्नसंच </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-2" style="text-align: center;">
                            <i class="mdi mdi-check-circle" aria-hidden="true" style="font-size: 45px;color: #06a406;"></i>
                        </div>
                        <div class="col-md-10 my-4" style="font-size: 18px;font-weight: 800;">
                            <?php  $session = session(); error_reporting(0); echo $_SESSION['questionmsg'];?>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light text-dark me-2" data-bs-dismiss="modal">Close</button>
                         <a href="<?= base_url(); ?>Questionset"><input class="btn btn-danger btn-square" type="button" value="Ok"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('Include/footer'); ?>

<script>
$( document ).ready(function(){
    var homeunmsg='<?=$_SESSION['questionmsg'];?>';
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
    var control2 = new google.elements.transliteration.TransliterationControl(options);
    control.makeTransliteratable(["label"]);
    control2.makeTransliteratable(["attribute"]);
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

//field hide-show dropdown values
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.querySelector('select[name="type"]');
    const dropdownField = document.querySelector('#dropdown_value').parentElement; // div containing input

    function toggleDropdownField() {
        if(typeSelect.value === 'dropdown') {
            dropdownField.style.display = 'block';
        } else {
            dropdownField.style.display = 'none';
        }
    }
    toggleDropdownField();
    typeSelect.addEventListener('change', toggleDropdownField);
});
</script>