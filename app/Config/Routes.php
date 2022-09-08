<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// this is for authentication routing


$routes->group('/search', ['filter' => 'authfilter'], function ($routes) {
    // karyawan yang dibawahi
    $routes->post('/', 'search\Search::coacheeSelected');
    // seluruh karyawan
    $routes->post('/userList', 'search\Search::userList');
});

$routes->group('profile', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('', 'Profile::index');
    $routes->get('change-email', 'Profile::change_email');
    $routes->post('process-email', 'Profile::process_email');
});


$routes->group('', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('/user', 'Administrator\Administrator::listUser', ['filter' => 'adminSA']);
    $routes->get('/user/(:any)', 'Administrator\Administrator::detailUser/$1', ['filter' => 'adminSA']);
    $routes->get('/log', 'Administrator\Administrator::logActivity', ['filter' => 'adminSA']);
    $routes->get('/log/(:any)', 'Administrator\Administrator::detailLogActivity', ['filter' => 'adminSA']);

    $routes->get('/format-password/(:any)', 'Administrator\Administrator::formatPassword/$1', ['filter', 'adminSA']);
    // process ubah password ke password baru
    $routes->post('/format-password-process', 'Administrator\Administrator::formatPasswordProcess', ['filter', 'adminSA']);
    $routes->post('/turnoff-user-process', 'Administrator\Administrator::turnOffUserProcess', ['filter', 'adminSA']);
});

$routes->group('karyawan', ['filter' => 'authfilter'], function ($routes) {
    //MARK: TAMPILKAN SELURUH DATA KARYAWAN
    $routes->get('', 'Karyawan::daftar_seluruh_karyawan', ['filter' => 'adminHSD']);
    //MARK: TAMPILKAN DETAIL KARYAWAN
    $routes->add('detail/(:any)', 'Karyawan::detail_karyawan/$1');
    //MARK: TAMPILKAN FORM EDIT KARYAWAN
    $routes->get('edit/karyawan/(:any)', 'Karyawan::edit_karyawan/$1');
    //MARK: PROSES FORM EDIT KARYAWAN
    $routes->add('update', 'Karyawan::update');
    //MARK: TAMPILKAN FORM EDIT ATASAN
    $routes->get('edit/atasan/(:any)', 'Karyawan::edit_atasan/$1');
    //MARK: PROSES FORM EDIT ATASAN
    $routes->add('update/atasan', 'Karyawan::update_atasan');
    //MARK: HAPUS DATA KARYAWAN
    $routes->add('delete/(:any)', 'Karyawan::delete_karyawan/$1');
    //MARK: BULK UPLOAD EXCEL DATA KARYAWAN
    $routes->post('tambah', 'Upload\UploadFeature::saveData');
    $routes->get('tambah-data', 'Karyawan::tambahKaryawanIndividu', ['filter' => 'adminHSD']);
    $routes->post('upload', 'Karyawan::uploadFile');

    $routes->add('unduh/pdf/all', 'Karyawan::data_karyawan_pdf');
    $routes->add('unduh/pdf/dibawahi', 'Karyawan::data_karyawan_dibawahi_pdf');
    $routes->add('unduh/pdf/penilaian', 'Karyawan::data_karyawan_penilaian_pdf');
});

$routes->group('config', ['filter' => 'authfilter'], function ($routes) {
    $routes->add('sarbis', 'Config\Sarbis::index');
    $routes->add('bobot', 'Config\Bobot::index');
    $routes->add('bobot/update', 'Config\Bobot::update');
    $routes->add('update_sarbis', 'Config\Sarbis::update_sarbis');

    // konfigurasi coaching
    // $routes->get('coaching', 'Config\CoachingConfig::index', ['filter' => 'adminHSD']);

    // save konfigurasi periode coaching
    $routes->get('coaching', 'Config\CoachingConfig::index', ['filter' => 'adminHSD']);
    $routes->post('coaching/save_periode', 'Config\CoachingConfig::savePeriodeCoaching', ['filter' => 'adminHSD']);
    $routes->get('form_pa', 'Config\FormPAConfig::index');
    $routes->add('update_pa', 'Config\FormPAConfig::update_pa');

    //MARK: UNTUK UBAH DESKRIPSI FORM PA
    $routes->add('deskripsi-pa', 'Config\FormPAConfig::show_desc');
    $routes->add('deskripsi-pa/show', 'Config\FormPAConfig::to_form');
    $routes->add('deskripsi-pa/update', 'Config\FormPAConfig::update_desc');
});

// This is for coaching routes
$routes->group('coaching', ['filter' => 'authfilter'], function ($routes) {
    // tambah coaching + riwayat coaching bawahannya
    $routes->get('', 'Coaching\Coaching::index', ['filter' => 'supervisorfilter']);
    // untuk admin hsd riwayat seluruh coaching
    $routes->add('histori-all', 'Coaching\Coaching::historyCoaching', ['filter' => 'adminHSD']);
    // riwayat coaching untuk karyawan
    $routes->get('histori', 'Coaching\Coaching::listEmployeeCoaching');
    $routes->get('detail-full/(:any)', 'Coaching\Coaching::detailCoachingFull/$1');

    // if your controller in subfolder you gotta use "\" instead "/" for separating folder
    $routes->get('detail/(:any)', 'Coaching\Coaching::detailCoaching/0/$1');
    $routes->get('detail_karyawan/(:any)', 'Coaching\Coaching::detailCoaching/1/$1', ['filter' => 'supervisorfilter']);
    // formulir coaching
    $routes->add('add', 'Coaching\Coaching::addCoaching', ['filter' => 'supervisorfilter']);
    // save data coaching oleh atasan
    $routes->post('save', 'Coaching\Coaching::saveCoaching', ['filter' => 'supervisorfilter']);
    // setujui hasil coaching dari atasan
    $routes->post('commit', 'Coaching\Coaching::commitCoaching');
    // edit coaching
    $routes->get('edit/(:any)', 'Coaching\Coaching::editCoaching/$1', ['filter' => 'supervisorfilter']);
    // save edit hasil coaching
    $routes->post('save_edit', 'Coaching\Coaching::saveEditCoaching', ['filter' => 'supervisorfilter']);
    $routes->post('delete', 'Coaching\Coaching::deleteCoaching', ['filter' => 'supervisorfilter']);
});




// ini segmen url untuk proses autentikasi
$routes->get('/', 'auth\Auth::index');
// login page
$routes->get('/login', 'auth\Auth::index');
// process login menentukan role, atasan, bawahan dari sini
$routes->post('/login-process', 'auth\Auth::loginProcess');
// logout
$routes->get('/logout', 'auth\Auth::logout');
// lupa password meminta email user
$routes->get('/forgot-password', 'auth\ForgotPassword::forgotPassword');
// proses kirim email recovery password
$routes->post('/forgot-password-process', 'auth\ForgotPassword::forgotPasswordProcess');
// reset password memasukan password baru
$routes->get('/reset-password', 'auth\ForgotPassword::resetPassword');
// process ubah password ke password baru
$routes->post('/reset-password/process', 'auth\ForgotPassword::resetPasswordProcess');


//MARK: RELOAD FOR SCHEDULER
$routes->add('/scheduler', 'Administrator\Administrator::scheduler');

$routes->group('change-password', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('/', 'auth\ChangePassword::index');
    $routes->post('process', 'auth\ChangePassword::process');
});


$routes->group('penilaian', ['filter' => 'authfilter'], function ($routes) {
    //MARK: Routes Menampilkan Form PA
    $routes->add('formulir', 'penilaian/Penilaian::form_pa');
    $routes->add('formulir-revisi/(:any)/(:any)', 'penilaian\Penilaian::form_pa_edit/$1/$2');


    $routes->add('DetailPenilaian/(:any)/(:any)', 'penilaian\DetailPenilaian::$1/$2');

    //MARK: Routes Untuk Memproses Form PA Kantor Pusat (KP)
    $routes->add('process_kp/(:any)', 'penilaian\ProsesPenilaianKp::tambahPenilaian/$1');
    $routes->add('process_revisi_kp/(:any)', 'penilaian\ProsesPenilaianKp::revisiPenilaian/$1');
    //MARK: Routes Untuk Memproses Form PA Kantor Cabang (KC)
    $routes->add('process_kc/(:any)', 'penilaian\ProsesPenilaianCab::tambahPenilaian/$1');
    $routes->add('process_revisi_kc/(:any)', 'penilaian\ProsesPenilaianCab::revisiPenilaian/$1');

    //MARK: Routes untuk Memproses Otorisasi PA dari Atasan
    $routes->add('otorisasi', 'penilaian\otorisasi\Otorisasi::show');
    $routes->add('otorisasi/detail/(:any)/(:any)', 'penilaian\otorisasi\Otorisasi::detail_penilaian/$1/$2');
    $routes->add('otorisasi/proses/(:any)/(:any)', 'penilaian\otorisasi\Otorisasi::proses_otorisasi/$1/$2');
    $routes->add('otorisasi/koreksi/(:any)/(:any)', 'penilaian\otorisasi\Otorisasi::proses_koreksi/$1/$2');


    //MARK: Routes Untuk Melihat Riwayat Penilaian PA
    $routes->add('riwayat', 'history/History::index');

    //MARK: Routes untuk Menampilkan Karyawan
    if (session()->get('role') == 'Admin') {
        $routes->add('daftar_karyawan', 'Karyawan::index');
    } else {
        $routes->add('daftar_karyawan', 'Karyawan::daftar_karyawan');
    }

    $routes->add('petunjuk', 'penilaian\Petunjuk::detail');
    $routes->add('all', 'penilaian\otorisasi\Otorisasi::show_all');
    $routes->add('all/pdf', 'penilaian\otorisasi\Otorisasi::show_all_to_pdf');


    $routes->add('unduh/(:any)/(:any)', 'penilaian\UnduhPenilaianIndividu::index/$1/$2');
});

$routes->get('generate-pdf/(:any)', 'GeneratePDF::htmlToPDF/$1');
$routes->add('send-mail', 'Penilaian/ProsesPenilaianKp::sendMail');

$routes->group('sp', ['filter' => 'authfilter'], function ($routes) {
    $routes->add('add', 'SuratPeringatan\SuratPeringatan::add');
    $routes->add('to_form', 'SuratPeringatan\SuratPeringatan::to_form');
    $routes->add('process', 'SuratPeringatan\SuratPeringatan::process');
    $routes->add('list', 'SuratPeringatan\SuratPeringatan::list');
    $routes->add('detail/(:any)', 'SuratPeringatan\SuratPeringatan::detail/$1');
    $routes->add('edit/(:any)', 'SuratPeringatan\SuratPeringatan::edit_sp/$1');
    $routes->add('process_edit', 'SuratPeringatan\SuratPeringatan::proses_edit_sp');
    $routes->add('delete/(:any)', 'SuratPeringatan\SuratPeringatan::delete/$1');
    $routes->add('unduh/pdf/all', 'SuratPeringatan\SuratPeringatan::data_sp_pdf');
});

$routes->group('sarbis', ['filter' => 'authfilter'], function ($routes) {
    $routes->add('entri', 'Sarbis::entri');
    $routes->add('process_add', 'Sarbis::process_add');
    $routes->add('list/(:any)', 'Sarbis::list/$1');
    $routes->add('edit/(:any)', 'Sarbis::edit/$1');
    $routes->add('otorisasi/', 'Sarbis::otorisasi');
    $routes->add('otorisasi/detail/(:any)', 'Sarbis::otorisasi_detail/$1');
    $routes->add('otorisasi/proses/(:any)', 'Sarbis::otorisasi_process/$1');
});


$routes->group('/testlogic', function ($routes) {
    $routes->post('validate_pass', 'TestLogic::validate_password');
    $routes->get('export-coaching', 'Export\ExcelExportController::index');
    $routes->post('export-coaching/process', 'Export\ExcelExportController::exportCoachingToExcel', ['filter' => 'adminHSD']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
