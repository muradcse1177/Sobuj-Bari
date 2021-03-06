<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' , 'WebsiteController@index');
Route::get('about' , 'WebsiteController@about');
Route::get('project-details' , 'WebsiteController@projectDetails');
Route::get('all-projects' , 'WebsiteController@allProjects');
Route::get('contact' , 'WebsiteController@contact');
Route::get('all-services' , 'WebsiteController@allServices');
Route::get('service' , 'WebsiteController@service');
Route::post('send-mail' , 'WebsiteController@sendMail');
Route::get('client' , 'WebsiteController@client');
Route::get('logout' , 'AuthController@logout');
Route::post('verifyUser' , 'AuthController@verifyUsers');
Route::get('/login', function () {
    return view('admin.login');
});
if(Cookie::get('role') != null){
    Route::get('home' , 'SettingController@company_info');
    Route::post('insertCompanyInfo' , 'SettingController@insertCompanyInfo');
    Route::post('getCompanyInfoById' , 'SettingController@getCompanyInfoById');
    Route::get('mainSlide' , 'SettingController@mainSlide');
    Route::post('insertMainSlide' , 'SettingController@insertMainSlide');
    Route::post('getMainSlideById' , 'SettingController@getMainSlideById');
    Route::post('deleteSlideList' , 'SettingController@deleteSlideList');
    Route::get('servicesAdmin' , 'SettingController@servicesAdmin');
    Route::post('insertServices' , 'SettingController@insertServices');
    Route::post('getServicesById' , 'SettingController@getServicesById');
    Route::post('deleteServiceList' , 'SettingController@deleteServiceList');
    Route::get('projects' , 'SettingController@projects');
    Route::post('insertProjects' , 'SettingController@insertProjects');
    Route::post('getProjectById' , 'SettingController@getProjectById');
    Route::post('deleteProjectList' , 'SettingController@deleteProjectList');
    Route::get('clients' , 'SettingController@clients');
    Route::post('insertClients' , 'SettingController@insertClients');
    Route::post('getClientsById' , 'SettingController@getClientsById');
    Route::post('deleteClientList' , 'SettingController@deleteClientList');
    Route::get('users' , 'SettingController@users');
    Route::post('insertUsers' , 'SettingController@insertUsers');
    Route::post('getUsersById' , 'SettingController@getUsersById');
    Route::post('deleteUserList' , 'SettingController@deleteUserList');
    Route::get('receivedEmail' , 'SettingController@receivedEmail');
    //my_acc_personal
    Route::get('project_name', 'AuthController@project_name');
    Route::post('insertProjectName', 'AuthController@insertProjectName');
    Route::post('getProjectNameById', 'AuthController@getProjectNameById');
    Route::post('deleteProjectName', 'AuthController@deleteProjectName');
    Route::get('m_acc', 'AuthController@m_acc');
    Route::get('getAllCompany', 'AuthController@getAllCompany');
    Route::get('getAllProject', 'AuthController@getAllProject');
    Route::post('insertM_acc', 'AuthController@insertM_acc');
    Route::post('getM_accReportByDate', 'AuthController@getM_accReportByDate');
    Route::post('getM_accListById', 'AuthController@getM_accListById');
}

