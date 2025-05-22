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

/*******************************************************************************************************/
