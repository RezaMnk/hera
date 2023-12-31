<?php
namespace App\Http\Traits;

use App\Models\Student;
use Carbon\Carbon;

trait Statistics {

    /**
     * declare columns to use in statistics data
     *
     * @param $rules
     * @return array
     */
    protected function statistics_columns($rules)
    {
        return [
            /*
            'is_vip' => true,                                                                       For Booleans
            'status' => $rules['status'],                                                           For Enums, strings, etc.
            'description' => ['condition' => 'LIKE', '%'. $rules['description'] .'$'],              For Like
            'view_count' => ['condition' => '>=', $rules['view_count']],                            For Comparisons
            'code' => [$rules['code']],                                                             For Multiple data
            */
        ];
    }

    /**
     * declare columns to except for statistics
     *
     * @param $rules
     * @return array
     */
    protected function statistics_exceptions($rules)
    {
        return [
//            'admin' => false,     Where admin is NOT false
//            'vip' => $rules['vip'] ?? false       Where vip is NOT false
        ];
    }

    /**
     * declare rules for calculation method
     *
     * @param $rules
     * @return array
     */
    protected function calc_static_rules()
    {
        return [
//            'admin' => false,     Where admin IS false
//        'exceptions' => [
//            'admin' => false      Where admin is NOT false
//        ]
        ];
    }


    /**
     * get data changes percentage
     *
     * @param $new
     * @param $old
     * @return float|int
     */
    private function get_percent($new, $old) {
        return ($new - $old) / ($old > 0 ? $old : 1) * 100;
    }


    public function scopeCalc($query, $rules = [])
    {
        $model = static::class::query();

        $static_rules = $this->calc_static_rules();
        if (isset($static_rules['exceptions']))
        {
            $static_rules = array_diff_key($this->calc_static_rules(), ['exceptions' => 1]);
            $static_rules_exceptions = $this->calc_static_rules()['exceptions' ];
        }
        else {
            $static_rules_exceptions = [];
        }

        foreach (array_merge($rules, $static_rules) as $columns => $value)
        {
            $model->where($columns, $value);
        }

        foreach ($static_rules_exceptions as $columns => $value)
        {
            $model->whereNot($columns, $value);
        }

        return $model->count();
    }


    /**
     * get statistics of a model by two Carbon date time
     *
     * @param $query
     * @param Carbon|bool $from
     * @param Carbon $to
     * @param array $rules
     * @return object
     */
    public function scopeStatistics($query, Carbon|bool $from, Carbon $to, $column_rules = [], $exception_rules = [])
    {
        $this_period = static::class::whereBetween('created_at', [$from, $to]);
        $last_period = static::class::whereBetween('created_at', [$to->diffAsCarbonInterval($from), $from]);

        $columns = $this->statistics_columns($column_rules);
        $exceptions = $this->statistics_exceptions($exception_rules);

        foreach ($exceptions as $col => $val) {
            $this_period->whereNot($col, $val);
            $last_period->whereNot($col, $val);
        }

        $days = [];
        $to->diffInDaysFiltered(function ($day) use (&$days, $exceptions) {
            $day_period = static::class::whereBetween('created_at', [$day, $day->copy()->addDay()]);

            foreach ($exceptions as $col => $val)
                $day_period->whereNot($col, $val);

            return $days[] = $day_period->count();
        }, $from);

        $data = [
            'all' => static::class::all()->count(),
            'new' => $this_period->count(),
            'new_diff_percent' => $this->get_percent($this_period->count(), $last_period->count()),
            'daily' => $days,
            'increased' => $this_period->count() > $last_period->count(),
        ];

        foreach ($columns as $column => $value_rule) {

            if ($column == 'where') continue;

            if (is_bool($value_rule) or !is_array($value_rule)) {

                $data[$column] = $this_period->where($column, $value_rule)->count();
                $data[$column.'_diff'] = $this_period->where($column, $value_rule)->count() - $last_period->where($column, $value_rule)->count();
                $data[$column.'_diff_percent'] = $this->get_percent($this_period->where($column, $value_rule)->count(), $last_period->where($column, $value_rule)->count());
                $data[$column.'_increased'] = $this_period->where($column, $value_rule)->count() > $last_period->where($column, $value_rule)->count();
            }

            elseif (isset($value_rule['condition'])) {

                $data[$column] = $this_period->where($column, $value_rule['condition'], $value_rule[1])->count();
                $data[$column.'_diff'] = $this_period->where($column, $value_rule['condition'], $value_rule[1])->count() - $last_period->where($column, $value_rule['condition'], $value_rule[1])->count();
                $data[$column.'_diff_percent'] = $this->get_percent($this_period->where($column, $value_rule['condition'], $value_rule[1])->count(), $last_period->where($column, $value_rule['condition'], $value_rule[1])->count());
                $data[$column.'_increased'] = $this_period->where($column, $value_rule['condition'], $value_rule[1])->count() > $last_period->where($column, $value_rule['condition'], $value_rule[1])->count();
            }

            else {

                $data[$column] = $this_period->whereIn($column, $value_rule)->count();
                $data[$column.'_diff'] = $this_period->whereIn($column, $value_rule)->count() - $last_period->whereIn($column, $value_rule)->count();
                $data[$column.'_diff_percent'] = $this->get_percent($this_period->whereIn($column, $value_rule)->count(), $last_period->whereIn($column, $value_rule)->count());
                $data[$column.'_increased'] = $this_period->whereIn($column, $value_rule)->count() > $last_period->whereIn($column, $value_rule)->count();
            }

        }

        return (object) $data;
    }
}
