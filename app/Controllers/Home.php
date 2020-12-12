<?php namespace App\Controllers;

use App\Entities\Login;
use App\Entities\Report;
use App\Libraries\Google;
use App\Models\HousesModel;
use App\Models\LoginsModel;
use App\Models\ReportsModel;
use App\Models\ResidentsModel;

class Home extends BaseController
{
    protected $validation_rule = [
        'house_id'                          => 'required',
        'resident_id'                       => 'required',
        'reporter_name'                     => 'required|min_length[3]|max_length[64]',
        'shift_date'                        => 'required|valid_date',
        'shift_timing'                      => 'required|min_length[3]|max_length[32]',

        'shift_prn_count1'                  => 'required|numeric',
        'shift_prn_count2'                  => 'required|numeric',
        'shift_prn_count3'                  => 'required|numeric',
        'shift_prn_count4'                  => 'required|numeric',
        'shift_med_check_times1'            => 'required',
        'shift_med_check_times2'            => 'required',

        // 'shift_isResident' => 'required',
        // 'shift_isUrinal' => 'required',
        // 'shift_isKeysHandOver' => 'required',
        // 'shift_isCamera' => 'required',
        // 'shift_isChecked' => 'required',

        // 'safety_isLiftBatteryCharging' => 'required',
        // 'safety_isFireCheckList' => 'required',
        // 'safety_isCameraCheck' => 'required',
        // 'safety_isPreWorkStretches' => 'required',
        // 'safety_isChecked' => 'required',

        'meds_time1'                        => 'required',
        'meds_administered_by1'             => 'required',
        'meds_checked_by1'                  => 'required',
        'meds_time2'                        => 'required',
        'meds_administered_by2'             => 'required',
        'meds_checked_by2'                  => 'required',
        'meds_time3'                        => 'required',
        'meds_administered_by3'             => 'required',
        'meds_checked_by3'                  => 'required',

        'prns_administered_time'            => 'required',
        'prns_administered_medication'      => 'required',
        'prns_administered_administered_by' => 'required',
        'prns_administered_witnessed_by'    => 'required',
        'prns_administered_approved_by'     => 'required',

        'dietary_breakfast'                 => 'required',
        'dietary_am_snack'                  => 'required',
        'dietary_lunch'                     => 'required',
        'dietary_pm_snack'                  => 'required',
        'dietary_supper'                    => 'required',
        'dietary_evening_snack'             => 'required',

        // 'notes' => 'required',
    ];

    public function index()
    {
		$google = new Google();
        if (!$google->isLoggedIn()) {
            $params = $this->request->getGet();
            if (!isset($params['code'])) {

                // Google authentication url
                $data = [
                    'loginURL' => $google->getLoginUrl(),
                ];

                // Load google login view
                return view('google_login', $data);
            }

            $google->setAccessToken();

            // Get user info from google
            $gpInfo = $google->getUserInfo();

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['first_name']     = $gpInfo['given_name'];
            $userData['last_name']      = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
            $userData['gender']         = !empty($gpInfo['gender']) ? $gpInfo['gender'] : '';
            $userData['locale']         = !empty($gpInfo['locale']) ? $gpInfo['locale'] : '';
            $userData['picture']        = !empty($gpInfo['picture']) ? $gpInfo['picture'] : '';

            // Insert login data to the database
            $date = new \DateTime('now');

            $user                 = new Login();
            $user->login_email    = $userData['email'];
            $user->login_datetime = $date->format('Y-m-d H:i:s');
            $usersModel           = new LoginsModel();
            $usersModel->save($user);

            // Store the status and user profile info into session
            $this->session->loggedIn = true;
            $this->session->userData = $userData;

            // Redirect to home page
            return $this->response->redirect('/', 'refresh');
        }
        $gpInfo = $google->getUserInfo();

        $housesModel    = new HousesModel();
        $reportsModel   = new ReportsModel();
        $residentsModel = new ResidentsModel();

        $houses    = $housesModel->findAll();
        $reports   = $reportsModel->findAll();
        $residents = $residentsModel->findAll();

        return $this->renderContent(['reports-list', 'modal'], compact('houses', 'reports', 'residents'));
    }

    public function logout()
    {
        $google = new Google();
        // Reset OAuth access token
        $google->logout();

        // Remove token and user data from the session
        unset($this->session->loggedIn);
        unset($this->session->userData);

        // Destroy entire session data
        $this->session->destroy();

        // Redirect to login page
        return $this->response->redirect('/', 'refresh');
    }

    //--------------------------------------------------------------------

    public function create()
    {
        helper(['form', 'url']);

        $housesModel    = new HousesModel();
        $residentsModel = new ResidentsModel();

        $houses    = $housesModel->findAll();
        $residents = $residentsModel->findAll();

        return $this->renderContent('add_report', \compact('houses', 'residents'));
    }

    public function store()
    {
        return $this->validateAndSave();
    }

    public function edit($id = null)
    {
        helper(['form', 'url']);

        $housesModel    = new HousesModel();
        $reportsModel   = new ReportsModel();
        $residentsModel = new ResidentsModel();

        $houses    = $housesModel->findAll();
        $report    = $reportsModel->find($id);
        $residents = $residentsModel->findAll();

        return $this->renderContent(['add_report'], \compact('houses', 'report', 'residents'));
    }

    public function update($id = null)
    {
        return $this->validateAndSave($id);
    }

    protected function validateAndSave($id = null)
    {
        helper(['form', 'url']);

        $chk_fields = [
            'shift_isResident', 'shift_isUrinal', 'shift_isKeysHandOver', 'shift_isCamera', 'shift_isChecked',
            'safety_isLiftBatteryCharging', 'safety_isFireCheckList', 'safety_isCameraCheck', 'safety_isPreWorkStretches', 'safety_isChecked',
        ];
        $report = new Report();
        if (isset($id)) {
            $report->id = $id;
        }
        $report->fill($this->request->getPost());
        foreach ($chk_fields as $chk) {
            if ($report->{$chk} === 'on') {
                $report->{$chk} = true;
            }
        }

        if (!$this->validate($this->validation_rule)) {
            $housesModel    = new HousesModel();
            $residentsModel = new ResidentsModel();

            $houses    = $housesModel->findAll();
            $residents = $residentsModel->findAll();

            return $this->renderContent(['add_report'], \compact('houses', 'report', 'residents'));
        } else {
            $reportsModel = new ReportsModel();
            $reportsModel->save($report);
            return $this->response->redirect('/', 'refresh');
        }
    }
}
