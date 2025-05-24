<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/***********************************  Admin Web - Nikita Nanaware ****************************************/
$routes->get('/'                                                , 'Home::index');
$routes->match(['get','post'],'/logout'                         , 'Home::logout');
$routes->match(['get','post'],'/PrivacyPolicy'                  , 'Home::PrivacyPolicy');
$routes->match(['get','post'],'/signIn'                         , 'Login\LoginController::signIn');
$routes->match(['get','post'],'/deleteRec'                      , 'Common\CommonController::deleteRec');

$routes->match(['get','post'],'/adminDashboard'                 , 'Dashboard\DashboardController::adminDashboard');

$routes->match(['get','post'],'/officeTypeList'                 , 'OfficeType\OfficeTypeController::officeTypeList');
$routes->match(['get','post'],'/addOfficeType'                  , 'OfficeType\OfficeTypeController::addOfficeType');
$routes->match(['get','post'],'/AddOfficeTypePro'               , 'OfficeType\OfficeTypeController::AddOfficeTypePro');
$routes->match(['get','post'],'/updateOfficeType'               , 'OfficeType\OfficeTypeController::updateOfficeType');
$routes->match(['get','post'],'/updateOfficeTypePro'            , 'OfficeType\OfficeTypeController::updateOfficeTypePro');

$routes->match(['get','post'],'/officeList'                     , 'Office\OfficeController::officeList');
$routes->match(['get','post'],'/addOffice'                      , 'Office\OfficeController::addOffice');
$routes->match(['get','post'],'/AddOfficePro'                   , 'Office\OfficeController::AddOfficePro');
$routes->match(['get','post'],'/updateOffice'                   , 'Office\OfficeController::updateOffice');
$routes->match(['get','post'],'/updateOfficePro'                , 'Office\OfficeController::updateOfficePro');

$routes->match(['get','post'],'/Taluka'                         , 'Taluka\TalukaController::Taluka');
$routes->match(['get','post'],'/AddTaluka'                      , 'Taluka\TalukaController::AddTaluka');
$routes->match(['get','post'],'/AddTalukaPro'                   , 'Taluka\TalukaController::AddTalukaPro');
$routes->match(['get','post'],'/UpdateTaluka'                   , 'Taluka\TalukaController::UpdateTaluka');
$routes->match(['get','post'],'/UpdateTalukaPro'                , 'Taluka\TalukaController::UpdateTalukaPro');

$routes->match(['get','post'],'/Officer'                        , 'Officer\OfficerController::Officer');
$routes->match(['get','post'],'/AddOfficer'                     , 'Officer\OfficerController::AddOfficer');
$routes->match(['get','post'],'/AddOfficerPro'                  , 'Officer\OfficerController::AddOfficerPro');
$routes->match(['get','post'],'/UpdateOfficer'                  , 'Officer\OfficerController::UpdateOfficer');
$routes->match(['get','post'],'/UpdateOfficerPro'               , 'Officer\OfficerController::UpdateOfficerPro');

$routes->match(['get','post'],'/Questionset'                    , 'Questionset\QuestionsetController::Questionset');
$routes->match(['get','post'],'/AddQuestionset'                 , 'Questionset\QuestionsetController::AddQuestionset');
$routes->match(['get','post'],'/AddQuestionsetPro'              , 'Questionset\QuestionsetController::AddQuestionsetPro');
$routes->match(['get','post'],'/updateQuestionset'              , 'Questionset\QuestionsetController::updateQuestionset');
$routes->match(['get','post'],'/UpdateQuestionsetPro'           , 'Questionset\QuestionsetController::UpdateQuestionsetPro');

/***********************************  API - Nikita Nanaware ****************************************/
$routes->match(['get','post'],'/do_login'                       , 'API\Login::do_login');
$routes->match(['get','post'],'/taluka_list'                    , 'API\Taluka::taluka_list');
$routes->match(['get','post'],'/office_type_list'               , 'API\OfficeType::office_type_list');
$routes->match(['get','post'],'/office_list'                    , 'API\Office::office_list');