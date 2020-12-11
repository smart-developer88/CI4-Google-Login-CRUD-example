<?php 
  $report_renderer = new App\Renderers\ReportRenderer(); 
  if (isset($report)) {
    $report_renderer->bindEntity($report);
  }
?>
<div class="content pagh">
  <h1>Create Shift Report</h1>

  <?= \Config\Services::validation()->listErrors(); ?>
  <?php if (isset($report)) : ?>
  <form action="<?= site_url('/update') ?>" method="post">
  <?php else : ?>
  <form action="<?= site_url('/new') ?>" method="post">
  <?php endif ?>
    <?= csrf_field() ?>
    <?= $report_renderer->renderField([
        'field' => 'reporter_name', 
        'label' => 'Your Name',
        'containerClass' => "form-block"
      ]) ?>

    <div class="form-block">
      <?= $report_renderer->renderField([
          'field' => 'shift_date', 
          'type' => 'Date', 
          'label' => 'Date',
          'containerClass' => "col-md-4 float-left"
        ]) ?>
      <?= $report_renderer->renderHouseList([
          'label' => 'Home', 
          'containerClass' => "col-md-4 float-left", 
          'houses' => $houses
          ]) ?>
      <?= $report_renderer->renderShifList([
          'label' => 'Shift', 
          'containerClass' => "col-md-4 float-left"
        ]) ?>
    </div>

    <div class="form-block">
      <br />
      <h2>Shift Routines</h2>
      <h3>PRN Count</h3>
      <?php foreach(['shift_prn_count1', 'shift_prn_count2', 'shift_prn_count3', 'shift_prn_count4'] as $field) : ?>
      <?= $report_renderer->renderField([
          'field' => $field, 
          'type' => 'text', 
          'placeholder' => "Med"
        ]) ?>
      <?php endforeach ?>

      <h3>Med Check Times</h3>
      <?php foreach(['shift_med_check_times1', 'shift_med_check_times2'] as $field) : ?>
      <?= $report_renderer->renderField([
          'field' => $field, 
          'type' => 'time'
        ]) ?>
      <?php endforeach ?>

      <?= $report_renderer->renderToggleButtons([
          [
            'field' => 'shift_isResident',
            'label' => 'Resident Check',
            'containerClass' => "col-md-3 float-left"
          ],
          [
            'field' => 'shift_isUrinal',
            'label' => 'Urinal',
            'containerClass' => "col-md-3 float-left"
          ],
          [
            'field' => 'shift_isKeysHandOver',
            'label' => 'Keys handed over',
            'containerClass' => "col-md-3 float-left"
          ],
          [
            'field' => 'shift_isCamera',
            'label' => 'Camera Check',
            'containerClass' => "col-md-3 float-left"
          ],
        ]) ?>

      <?= $report_renderer->renderField([
          'field' => 'shift_isChecked', 
          'type' => 'checkbox',
          'containerClass' => "form-block"
        ]) ?>
    </div>

    <div class="form-block">
      <br />
      <h2>Safety Routines</h2>

      <?= $report_renderer->renderToggleButtons([
          [
            'field' => 'safety_isLiftBatteryCharging',
            'label' => 'Lift Battery Charging'
          ],
          [
            'field' => 'safety_isFireCheckList',
            'label' => 'Fire Check List'
          ],
          [
            'field' => 'safety_isCameraCheck',
            'label' => 'Camera Check'
          ],
          [
            'field' => 'safety_isPreWorkStretches',
            'label' => 'Pre Work Stretches'
          ],
        ]) ?>

      <?= $report_renderer->renderField([
          'field' => 'shift_isChecked', 
          'type' => 'checkbox',
          'containerClass' => "form-block"
        ]) ?>
    </div>

    <div class="form-block">
      <br />
      <h2>Meds Administered</h2>
      <?php for ($idx = 1; $idx <= 3; $idx ++) :?>
      <label>Time</label>
      <?php 
        $param_list = [
          [
            'field' => 'meds_time'.$idx, 
            'type' => 'time'
          ],
          [
            'field' => 'meds_administered_by'.$idx,
            'placeholder' => "Administered By"
          ],
          [
            'field' => 'meds_checked_by'.$idx,
            'placeholder' => "Checked By"
          ]
        ];
        foreach ($param_list as $param):
      ?>
      <?= $report_renderer->renderField($param) ?>
      <?php endforeach ?>
      <?php if ($idx < 3) : ?>
      <hr />
      <?php endif ?>
      <?php endfor ?>

      <Br />
      <h2>PRNs Administered</h2>
      <label>Time</label>
      <?= $report_renderer->renderField([
        'field' => 'prns_administered_time',
        'type' => 'time'
      ]) ?>
      <?= $report_renderer->renderResidentList([
        'label' => 'Resident',
        'residents' => $residents
      ]) ?>
      <?php 
        $param_list = [
          [
            'field' => 'prns_administered_medication',
            'placeholder' => "Meidcation"
          ],
          [
            'field' => 'prns_administered_administered_by',
            'placeholder' => "Administered By"
          ],
          [
            'field' => 'prns_administered_witnessed_by',
            'placeholder' => "Witnessed By"
          ],
          [
            'field' => 'prns_administered_approved_by',
            'placeholder' => "Approved By"
          ]
        ];
        foreach ($param_list as $param):
      ?>
      <?= $report_renderer->renderField($param) ?>
      <?php endforeach ?>
    </div>

    <div class="form-block">
      <br />
      <h2>Dietary Info</h2>

      <?php 
        $param_list = [
          [
            'field' => 'dietary_breakfast',
            'placeholder' => "Breakfast"
          ],
          [
            'field' => 'dietary_am_snack',
            'placeholder' => "Am Snack"
          ],
          [
            'field' => 'dietary_lunch',
            'placeholder' => "Lunch"
          ],
          [
            'field' => 'dietary_pm_snack',
            'placeholder' => "Pm Snack"
          ],
          [
            'field' => 'dietary_supper',
            'placeholder' => "Supper"
          ],
          [
            'field' => 'dietary_evening_snack',
            'placeholder' => "Evening Snack"
          ],
        ];
        foreach ($param_list as $param):
      ?>
      <?= $report_renderer->renderField($param) ?>
      <?php endforeach ?>
    </div>

    <br />
    <?= $report_renderer->renderField([
      'field' => 'notes',
      'type' => 'textarea',
      'label' => 'Shift Report Notes',
      'containerClass' => "form-block"
    ]) ?>
    <div class="form-block flex-center">
      <button type="submit" class="btn btn-primary btn-save">
        Save
      </button>
    </div>
  </form>
</div>
