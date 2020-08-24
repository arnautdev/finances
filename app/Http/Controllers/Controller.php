<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var bool
     */
    public $checkAuth = true;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if ($this->checkAuth) {
            $this->middleware(['auth', 'acl']);
        }
    }


    /**
     * @param null $model
     * @param null $data
     */
    public function saveOrder($model = null, $data = null)
    {
        foreach ($data as $index => $id) {
            $row = $model->row($id);
            $row->update(['ord' => $index]);
        }
        return ['status' => true];
    }
}
