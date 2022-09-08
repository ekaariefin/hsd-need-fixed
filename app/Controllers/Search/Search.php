<?php

namespace App\Controllers\Search;

use App\Models\Livesearch\LivesearchModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\URI;

class Search extends BaseController
{

    public function __construct()
    {
        $this->searchModel = new LivesearchModel();
    }
    public function index()
    {
        $data['title'] = 'Live Search Feature | BCA Syariah';
        $data['pageHeader'] = 'Entri Coaching';
        return view('jajal/livesearch', $data);
    }

    public function searchEmployee()
    {
        $query = $this->searchModel;
        $term = $_GET['term'];

        if (isset($term)) {
            $result = $query->searchEmployeeModel($term);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] = $row->fnama;
                }
            }
        } else {
            die;
        }
        return (json_encode($arr_result));
    }

    public function userList()
    {
        // POST data
        // $postData['search'] = "muh";
        $postData = $this->request->getVar();

        // Get data
        $data = $this->searchModel;
        $cek = $data->liveSearchEmployee($postData);

        // $cek = ['nuhaa', 'hjjj'];

        return (json_encode($cek));
    }

    public function coacheeSelected()
    {

        $postData = $this->request->getVar();
        $data = $this->searchModel;
        return (json_encode($data->selectedCoachee($postData['nip'])));
    }
}
