<?php

namespace App\Traits;


trait AppModelAwareTrait
{


    /**
     * @param array $args
     * @return $this
     */
    public function row($args = [])
    {
        if (is_int($args) || is_numeric($args)) {
            return $this->where('id', '=', $args)->firstOrNew([], []);
        }

        ///
        if (is_array($args)) {
            foreach ($args as $key => $val) {
                $condition = $this->getCondition($key);
                $condition[$key]['value'] = $val;

                // set conditions
                $this->where($condition[$key]['key'], $condition[$key]['condition'], $condition[$key]['value']);
            }
        }
        return $this->firstOrNew([], []);


        $query = $this->query();
        if (is_int($args) || is_numeric($args)) {
            $row = $this->where('id', '=', $args);
            if ($row->exists()) {
                return $row->first();
            }
            return $query;
        }

        if (is_array($args)) {
            // set order by
            if (isset($args['order'])) {
                $orderKey = key($args['order']);
                $query->orderBy($orderKey, $args['order'][$orderKey]);
                unset($args['order']);
            }

            // set conditions
            collect($args)->map(function ($val, $key) use (&$query) {
                $condition = $this->getCondition($key);
                $condition[$key]['value'] = $val;

                // set conditions
                $query->where($condition[$key]['key'], $condition[$key]['condition'], $condition[$key]['value']);
            });

            // get row or return empty object
            $row = $query->first();
            if (!is_null($row)) {
                return $row;
            }
        }

        return $query;
    }


    /**
     * @param array $args
     * @return AppModelAwareTrait
     */
    public function rows($args = [])
    {
        if (is_array($args)) {
            $query = $this->query();

            // set order by
            if (isset($args['order'])) {
                $orderField = key($args['order']);
                $query->orderBy($orderField, $args['order'][$orderField]);
                unset($args['order']);
            }

            if (isset($args['groupBy'])) {
                $query->groupBy($args['groupBy']);
                unset($args['groupBy']);
            }

            // set limit
            if (isset($args['limit'])) {
                $query->limit($args['limit']);
                unset($args['limit']);

            }

            // set conditions
            collect($args)->map(function ($val, $key) use (&$query) {
                $condition = $this->getCondition($key);
                $condition[$key]['value'] = $val;

                // set conditions
                if (isset($condition[$key]) && is_array($condition[$key]['value'])) {
                    $query->whereIn($condition[$key]['key'], $condition[$key]['value']);
                } else if (isset($condition[$key])) {
                    $query->where($condition[$key]['key'], $condition[$key]['condition'], $condition[$key]['value']);
                }
            });

            // get row or return empty object
            $rows = $query->get();
            if (is_null($rows)) {
                return new self();
            }
            return $rows;
        }

        // return all existing rows
        return $this->get();
    }


    /**
     * @param $key
     * @return array
     */
    private function getCondition($key)
    {
        $condition = explode(' ', $key);
        $cout = [];
        if (count($condition) == 1) {
            $cout[$key] = [
                'key' => $condition[0],
                'condition' => '='
            ];
        } else {
            $cout[$key] = [
                'key' => $condition[0],
                'condition' => $condition[1]
            ];
        }
        return $cout;
    }

    /**
     * @param null $key
     * @return bool
     */
    public function isOwner($key = null, $guard = null)
    {
        if (is_null($key)) {
            return false;
        }
        $userId = auth($guard)->id();
        if ($this->{$key} != $userId) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getIsActive()
    {
        if ($this->isActive == 'yes') {
            return '<span class="badge badge-success"> ' . __(ucfirst($this->isActive)) . ' </span>';
        }
        return '<span class="badge badge-danger"> ' . __(ucfirst($this->isActive)) . ' </span>';
    }
}