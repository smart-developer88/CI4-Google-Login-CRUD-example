<?php namespace App\Controllers;

use App\Models\HousesModel;
use App\Models\ReportsModel;
use App\Models\ResidentsModel;
class Home extends BaseController
{
	public function index()
	{
		$housesModel = new HousesModel();
		$reportsModel = new ReportsModel();
		$residentsModel = new ResidentsModel();

		$houses = $housesModel->findAll();
		$reports = $reportsModel->findAll();
		$residents = $residentsModel->findAll();

		return $this->renderContent('reports-list', compact('houses', 'reports', 'residents'));
	}

	//--------------------------------------------------------------------

	public function create() {
		$housesModel = new HousesModel();
		$residentsModel = new ResidentsModel();

		$houses = $housesModel->findAll();
		$residents = $residentsModel->findAll();

		return $this->renderContent('add_report', \compact('houses', 'residents'));
	}

	public function store() {
		$reportsModel = new ReportsModel();
		$report = new Report();
		$report->fill($this->request->getPost());
		$reportsModel->save($report);
        return $this->response->redirect(site_url('/'));
	}

	public function edit($id = null) {
		$housesModel = new HousesModel();
		$reportsModel = new ReportsModel();
		$residentsModel = new ResidentsModel();

		$houses = $housesModel->findAll();
		$report = $reportsModel->find($id);
		$residents = $residentsModel->findAll();

		return $this->renderContent(['add_report', 'modal'], \compact('houses', 'report', 'residents'));
	}

}
