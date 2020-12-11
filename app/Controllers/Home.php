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

}
