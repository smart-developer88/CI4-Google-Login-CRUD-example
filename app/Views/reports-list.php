        <div class="content">           
            <h1>Shift Reports</h1>
            <div style="text-align:center; margin:20px 0;">
                <a href="/new"><div class="btn btn-primary" style="font-size:22px;"> New Shift Report</div></a>
            </div>
            
            <div class="form-block">
                <ul class='list-of-reports'>
                    <?php if (!empty($reports) && is_array($reports)) : ?>
                        <?php foreach ($reports as $report): ?>
                            <a href="/report/<?= $report->id ?>"><li><b><?= esc($report->shift_date->toLocalizedString('MMM d yyyy')) ?> -</b> <?= esc($houses[$report->house_id - 1]->house_name) ?> - <?= esc($report->shift_timing) ?> - submitted by <?= esc($report->reporter_name) ?></li></a>
                        <?php endforeach; ?>
                    <?php endif ?>
                </ul>
            </div>
		</div>