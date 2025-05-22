<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords"content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
	<meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Update Calcium Mineral Mixture</title>
    <?php echo view('Include/header'); ?>


		<!-- Page Wrapper -->
		<div class="page-wrapper cardhead">
			<div class="content">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<!-- <h3 class="page-title">Basic Inputs</h3> -->
						</div>
					</div>
				</div>
				<!-- /Page Header -->
                 
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
                        <div class="card-header">
								<h5 class="card-title">Update Calcium Mineral Mixture </h5>
							</div>
							<div class="card-body">
                            <?php echo form_open_multipart('/updateCalciumMineralPro', array('autocomplete' => 'off','class' => 'p-0 myForm')); ?>
                            <input type="hidden" name="id" value="<?= !empty($list['id']) ? $list['id'] : '' ?>">
                            <input type="hidden" name="editImage" value="<?= !empty($list['image']) ? $list['image'] : '' ?>"> 
                                                
									<div class="mb-4 row">

                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Category <span class="text-danger">*</span></label>
                                            <?php $cat_id = $list['cat_id'] ?? set_value('cat_id'); ?>
                                            <select class="form-select" aria-label="Default select example" name="cat_id" id="cat_id" onchange="getUnit(this.value);">
                                                <option value="">Select category</option>
                                                <?php foreach($categoryD as $cat) { ?>
                                                    <option value="<?= $cat['id']; ?>" 
                                                        <?php if($cat_id == $cat['id']) { echo 'selected'; } ?>>
                                                        <?= $cat['category']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation) && $validation->hasError('cat_id')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('cat_id'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Subcategory <span class="text-danger">*</span></label>
                                            <?php $subcat_id = $list['subcat_id'] ?? set_value('subcat_id'); ?>
                                            <select class="form-select" aria-label="Default select example" name="subcat_id" id="subcat_id">
                                                <option value="">Select subcategory</option>
                                                <?php foreach($subcatD as $subcat) { ?>
                                                    <option value="<?= $subcat['id']; ?>" 
                                                        <?php if($subcat_id== $subcat['id']) { echo 'selected'; } ?>>
                                                        <?= $subcat['subcategory']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation) && $validation->hasError('subcat_id')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('subcat_id'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Product Name<span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control AlphabetsOnlyWithSpace" placeholder="Enter product name" value="<?= $list['name'] ?? set_value('name'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('name')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('name'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Price <span class="text-danger">*</span></label>
                                            <input type="text" id="price" name="price" class="form-control DigitsWithDot" placeholder="Enter product price" value="<?= $list['price'] ?? set_value('price'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('price')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('price'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                            <input type="text" id="quantity" name="quantity" class="form-control DigitsOnly" placeholder="Enter product quantity" value="<?= $list['quantity'] ?? set_value('quantity'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('quantity')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('quantity'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                         <div class="col-md-4 mb-2">
                                            <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                            <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="<?= $list['expiry_date'] ?? set_value('expiry_date'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('expiry_date')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('expiry_date'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                         <div class="col-md-4 mb-2">
                                            <label class="form-label">Weight <span class="text-danger">*</span></label>
                                            <input type="text" id="weight" name="weight" class="form-control DigitsWithDot" placeholder="Enter product weight" value="<?= $list['weight'] ?? set_value('weight'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('weight')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('weight'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Unit <span class="text-danger">*</span></label>
                                            <?php $unit = $list['unit'] ?? set_value('unit'); ?>
                                            <select class="form-select" id="ShowUnit" name="unit">
                                                <option value="">Select unit</option>
                                            </select>
                                            <?php if (isset($validation) && $validation->hasError('unit')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('unit'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Image <span class="text-danger">*</span></label>
                                            <input type="file" id="image" name="image" class="form-control" value="<?= $list['image'] ?? set_value('image'); ?>">
                                            <?php if (isset($validation) && $validation->hasError('image')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('image'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-1" style="margin-top:25px;">
                                            <?php  if (isset($list['image']) && $list['image'] != '') {
                                                $extension = pathinfo($list['image'], PATHINFO_EXTENSION);
                                                if($extension == "pdf"){
                                            ?>
                                                <a target="blank" href="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$list['image'];?>"><img src="<?= base_url("public/Backend-Assets/pdficon.png");?>" alt="image" style="height:32px;width23px;"></a>
                                            <?php }else{?>
                                                <a target="blank" href="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$list['image'];?>"><img src="<?php echo base_url();?>public/Backend-Assets/images/Product/<?=$list['image'];?>" alt="image" width="100" height="80"></a>
                                            <?php } } ?>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                            <textarea rows="4" cols="4" class="form-control" id="description" name="description" placeholder="Enter product description."><?= $list['description'] ?? set_value('description'); ?></textarea>
                                            <?php if (isset($validation) && $validation->hasError('description')){ ?>
                                                <div class="text-danger" style="text-align: left; margin-left: 5px; color: #ec536c!important;">
                                                    <?= $validation->getError('description'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        

									</div>
                                    <div class="row g-3">
                                    <div class="mb-2 col-md-4 mb-3">
                                        <button type="submit" class="btn" style="background-color:#f26522;color:#fff;">
                                            Update
                                            </button>
                                        <a href="<?=base_url();?>calciumMineralList"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                    </div>
                                    </div>
								</form>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Mineral Calcium Mixture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-2" style="text-align: center;">
                            <i class="mdi mdi-check-circle" aria-hidden="true" style="font-size: 45px;color: #06a406;"></i>
                        </div>
                        <div class="col-md-10 my-4" style="font-size: 18px;font-weight: 800;">
                            <?php  $session = session(); error_reporting(0); echo $_SESSION['calmsg'];?>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2"
                            data-bs-dismiss="modal">Close</button>
                            <a href="<?php echo base_url(); ?>calciumMineralList"><button type="button" class="btn btn-primary">Ok</button></a>
                    </div>
                </div>
            </div>
        </div>

            <?php echo view('Include/footer'); ?>

<script>
    $( document ).ready(function(){
        var homeunmsg='<?=$_SESSION['calmsg'];?>';
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
        var contro2 = new google.elements.transliteration.TransliterationControl(options);
        var contro3 = new google.elements.transliteration.TransliterationControl(options);
        var contro4 = new google.elements.transliteration.TransliterationControl(options);
        var contro5 = new google.elements.transliteration.TransliterationControl(options);
        
        control.makeTransliteratable(["name"]);
        contro2.makeTransliteratable(["price"]);
        contro3.makeTransliteratable(["quantity"]);
        contro4.makeTransliteratable(["weight"]);
        contro5.makeTransliteratable(["description"]);
    }
    google.setOnLoadCallback(onLoad);

    $('.AlphabetsOnlyWithSpace').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z\s]+$/); // Only alphabets and spaces
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    $('.DigitsOnly').keypress(function (e) {
        var regex = new RegExp(/^[0-9\s]+$/); // Only digits
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    $('.DigitsWithDot').keypress(function (e) {
        var regex = new RegExp(/^[0-9.\s]+$/); // Only digits
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    function getUnit(cat_id,unit=null)
    {
        $.ajax({
                url:"<?php echo base_url(); ?>/getUnitByCategory",
                method:"POST",
                data:{cat_id:cat_id,unit:unit},
                success:function(result)
                {
                    $("#ShowUnit").html(result);
                 }
            });
    }
    
    $(document).ready(function () {
        let selectedCat  = "<?= $cat_id ?>";
        let selectedUnit = "<?= $unit ?>";
        if (selectedCat !== "") {
            getUnit(selectedCat, selectedUnit);
        }
    });

</script>