<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Grids\TextPagesGrid;
use App\Grids\TextPagesGridInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Common\Entities\TextPage;
use Modules\Common\Entities\TextPageSection;
use Modules\Common\Traits\I18nHelperTrait;
use Spatie\MediaLibrary\Models\Media;

class TextPageController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data['grid'] = (new TextPagesGrid())->create(['query' => TextPage::query(), 'request' => $request]);

        return view('dashboard::text-page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::text-page.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data['slug'] = str_slug($request->get('title'));
        $request->merge($data);
        $data = $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|unique:text_pages,slug',
        ]);

        $page = TextPage::create($data);
        if ($page->exists()) {
            return redirect(route('text-page.edit', $page->id))->with('success', __('success-create-page'));
        }
        return back()->with('error', __('error-create-page'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(TextPage $text_page)
    {
        $data['page'] = $text_page;
        $data['sub-pages'] = $text_page->sections(['order' => ['ord', 'ASC']]);
        return view('dashboard::text-page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, TextPage $text_page)
    {
        if ($request->exists('pageMedia')) {
            $request->validate([
                'fbShareImage' => 'image|mimes:jpeg,png,jpg|max:5048',
                'fbShareImage' => 'image|mimes:jpeg,png,jpg|max:5048',
                'pageGallery.*' => 'image|mimes:jpeg,png,jpg|max:5048',
            ]);
            $text_page->update();
            return back()->with('success', __('success-add-media'));
        }

        $data = $request->validate([
            'isActive' => '',
            'title' => 'required|min:3',
            'description' => '',
            'content' => 'required|min:10'
        ]);

        if ($text_page->update($data)) {
            return back()->with('success', __('success-update-message'));
        }
        return back()->with('error', __('error-update-message'));
    }

    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(TextPage $text_page)
    {
        if ($text_page->exists() && $text_page->delete()) {
            if (\request()->ajax()) {
                return [
                    'status' => true,
                    'message' => __('success-delete-page')
                ];
            }
            return back()->with('success', __('success-delete-page'));
        }

        if (\request()->ajax()) {
            return [
                'status' => false,
                'message' => __('success-delete-page')
            ];
        }
        return back()->with('error', __('error-delete-page'));
    }


    /**
     * @param null $model
     * @param $data
     */
    public function saveOrder($model = null, $data = null)
    {
        $model = (new TextPageSection());
        $data = \request()->get('order');
        parent::saveOrder($model, $data);
    }
}
