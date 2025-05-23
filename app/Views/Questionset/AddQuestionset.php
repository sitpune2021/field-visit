<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Field Visit - अ‍ॅड प्रश्न संच</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo view('Include/header'); ?>
</head>
<body>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6 col-12">
          <h2>अ‍ॅड प्रश्न संच</h2>
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

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body basic-form">
            <div class="card-wrapper border rounded-3">

              <?php echo form_open('/AddQuestionsetPro', ['autocomplete' => 'off', 'class' => 'p-0 row']); ?>
              
                <div class="col-md-4 mb-3">
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

              <div id="attribute-container">
                <!-- First attribute row -->
                <div class="row mb-2 attribute-row">
                  <div class="col-md-3">
                    <select name="type[]" class="form-select attribute-type">
                      <option value="">टाईप निवडा</option>
                      <option value="text">Text</option>
                      <option value="number">Number</option>
                      <option value="email">Email</option>
                      <option value="dropdown">Dropdown</option>
                      <option value="radio">Radio</option>
                      <option value="checkbox">Checkbox</option>
                      <option value="textarea">Textarea</option>
                      <option value="file">File</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="label" name="label[]" class="form-control" placeholder="प्रश्न प्रविष्ठ करा.">
                  </div>
                  <div class="col-md-3">
                    <select name="required[]" class="form-select">
                      <option value="">आवश्यक आहे का</option>
                      <option value="yes">होय </option>
                      <option value="no">नाही </option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-success add-attribute">+</button>
                  </div>
                  <div class="col-md-12 mt-2 dropdown-values d-none">
                    <label>पर्याय <small>(Comma separated)</small></label>
                    <input type="text" name="dropdown_values[]" class="form-control" placeholder="e.g. Male,Female,Other">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="text-start mt-3">
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
        <h5 class="modal-title" id="staticBackdropLabel">प्रश्न संच </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-md-2 text-center">
          <i class="mdi mdi-check-circle" style="font-size: 45px; color: #06a406;"></i>
        </div>
        <div class="col-md-10 my-4" style="font-size: 18px; font-weight: 800;">
          <?php $session = session(); error_reporting(0); echo $_SESSION['questionmsg']; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light text-dark me-2" data-bs-dismiss="modal">Close</button>
        <a href="<?php echo base_url(); ?>Questionset"><button type="button" class="btn btn-primary">Ok</button></a>
      </div>
    </div>
  </div>
</div>

<?php echo view('Include/footer'); ?>

<script>
$(document).ready(function () {
    var homeunmsg = '<?= $_SESSION['questionmsg']; ?>';
    if (homeunmsg !== '') {
        $('#staticBackdrop').modal('show');
    }

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

    function getAttributeRow() {
        return `
        <div class="row mb-2 attribute-row">
            <div class="col-md-3">
                <select name="type[]" class="form-select attribute-type">
                    <option value="">Select Type</option>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="email">Email</option>
                    <option value="dropdown">Dropdown</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="textarea">Textarea</option>
                    <option value="file">File</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" id="label" name="label[]" class="form-control" placeholder="प्रश्न प्रविष्ठ करा.">
            </div>
            <div class="col-md-3">
                <select name="required[]" class="form-select">
                    <option value="">आवश्यक आहे का</option>
                    <option value="yes">होय </option>
                    <option value="no">नाही</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-attribute"> - </button>
            </div>
            <div class="col-md-12 mt-2 dropdown-values d-none">
                <label>Options <small>(Comma separated)</small></label>
                <input type="text" name="dropdown_values[]" class="form-control" placeholder="e.g. Option1,Option2">
            </div>
        </div>`;
    }

    $(document).on('click', '.add-attribute', function () {
        $('#attribute-container').append(getAttributeRow());
    });

    $(document).on('click', '.remove-attribute', function () {
        $(this).closest('.attribute-row').remove();
    });

    $(document).on('change', '.attribute-type', function () {
        var type = $(this).val();
        var parent = $(this).closest('.attribute-row');
        if (type === 'dropdown' || type === 'radio' || type === 'checkbox') {
            parent.find('.dropdown-values').removeClass('d-none');
        } else {
            parent.find('.dropdown-values').addClass('d-none');
        }
    });

    $('.AlphabetsOnlyWithSpace').keypress(function (e) {
        var regex = /^[a-zA-Z\s]+$/;
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!regex.test(str)) e.preventDefault();
    });
});
</script>

</body>
</html>
