<?php namespace App\Renderers;

use App\Entities\Report;

class ReportRenderer {
    protected Report $report;
    public function bindEntity($report) {
        $this->report = $report;
    }    

    public function renderToggleButtons($params) {
        $checkboxes = "";
        foreach ($params as $param) {
            $field = isset($param['field']) ? $param['field'] : '';
            $val = isset($this->report) ? $this->report->{$param['field']} : false;
            $label = isset($param['label']) ? $param['label'] : '';
            $checked = $val ? "checked" : "";
            $checkboxes .= <<<HTML
            <label class="btn btn-primary flex-cell mgh-15">
                <input type="checkbox" name="$field" $checked autocomplete="off"> $label
            </label>
            HTML;
        }
        $html = <<<HTML
        <div class="btn-group-toggle flex-center" data-toggle="buttons">
            $checkboxes
        </div>
        HTML;
        return $html;
    }

    public function renderHouseList($params) {
        $label = isset($params['label']) ? $params['label'] : "";
        $containerClass = isset($params['containerClass']) ? $params['containerClass'] : "";
        $houses = isset($params['houses']) ? $params['houses'] : [];

        $new_houses = array_map(function ($house) {
            return [
                'val' => $house->id,
                'text' => $house->house_name,
            ];
        }, $houses);

        $params['field'] = 'house_id';
        $params['options'] = $new_houses;
        return $this->renderList($params);
    }

    public function renderResidentList($params) {
        $label = isset($params['label']) ? $params['label'] : "";
        $containerClass = isset($params['containerClass']) ? $params['containerClass'] : "";
        $residents = isset($params['residents']) ? $params['residents'] : "";

        $new_residents = array_map(function ($resident) {
            return [
                'val' => $resident->id,
                'text' => $resident->resident_first_name . ' ' . $resident->resident_last_name,
            ];
        }, $residents);

        $params['field'] = 'resident_id';
        $params['options'] = $new_residents;
        return $this->renderList($params);
    }

    public function renderShifList($params) {
        $options = isset($params['options']) ? $params['options'] : ['morning', 'afternoon', 'evening', 'night'];

        $new_options = array_map(function ($option) {
            return [
                'val' => strtolower($option),
                'text' => ucfirst(strtolower($option)),
            ];
        }, $options);

        $params['field'] = 'shift_timing';
        $params['options'] = $new_options;
        return $this->renderList($params);
    }

    public function renderField($params) {
        $field = $params['field'];
        $type = isset($params['type']) ? $params['type'] : "text";
        $label = isset($params['label']) ? $params['label'] : "";
        $containerClass = isset($params['containerClass']) ? $params['containerClass'] : "__standalone__";
        $placeholder = isset($params['placeholder']) ? $params['placeholder'] : null;
        
        $val = isset($this->report) ? $this->report->__get($field) : '';
        $html = "";
        $placeholder_field = \is_null($placeholder) ? "" : " placeholder=\"$placeholder\"";
        $labelSection = empty($label) ? "" : "<label>$label</label>";
        $checkedSection = "";
        if ($type === 'string') {
            $type = "text";
        } else {
            if ($type === 'checkbox') {
                $checkedSection = $val ? "checked" : "";
            }
            if ($type === 'Date') {
                $val = $val ? $val->toDateString() : '';
            }
            if (!\in_array($type, ['text', 'time', 'checkbox', 'Date', 'textarea'])) {
                echo "$type : $val";
            }
        }
        $element = "";
        if ($type === 'textarea') {
            $element = "<textarea name=\"$field\" $placeholder_field>$val</textarea>";
        } else if ($type === 'checkbox') {
            $element = "<input name=\"$field\" type=\"checkbox\" $checkedSection />";
        } else {
            $element = "<input name=\"$field\" type=\"$type\" $checkedSection value=\"$val\" $placeholder_field />";
        }
        
        if ($containerClass === '__standalone__') {
            return $element;
        }
        $html = <<<HTML
        <div class="$containerClass">
            $labelSection
            $element
        </div>
        HTML;
        return $html;
    }

    protected function renderList($params) {
        $field = isset($params['field']) ? $params['field'] : "";
        $label = isset($params['label']) ? $params['label'] : "";
        $containerClass = isset($params['containerClass']) ? $params['containerClass'] : "";
        $options = isset($params['options']) ? $params['options'] : [];

        $current = isset($this->report) ? $this->report->__get($field) : '';
        $optionList = "";
        foreach ($options as $option) {
            $val = $option['val'];
            $text = $option['text'];
            $selected = $current === $val ? "selected" : "";
            $optionList .= "<option value=\"$val\" $selected>$text</option>\n";
        }
        $html = <<<HTML
        <div class="$containerClass">
          <label>$label</label>
          <select name="$field">
            $optionList
          </select>
        </div>
        HTML;
        return $html;
    }
}
