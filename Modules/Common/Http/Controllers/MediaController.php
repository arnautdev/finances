<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends Controller
{

    /**
     * @return array
     */
    public function saveMediaOrder()
    {
        $order = \request()->get('order');
        $status = Media::setNewOrder($order);
        return ['status' => $status];
    }

    /**
     * @param Media $media
     * @throws \Exception
     */
    public function deleteMedia(Media $media)
    {
        if ($media->delete()) {
            return back()->with('success', __('success-delete-media'));
        }
        return back()->with('error', __('error-delete-media'));
    }
}
