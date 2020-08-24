<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Traits\I18nHelperTrait;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['news'] = (new News())->rows();
        return view('dashboard::news.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::news.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3'
        ]);
        $data['slug'] = str_slug($data['title']);

        $news = News::create($data);

        if ($news->exists()) {
            $routeTo = route('news.edit', $news->id);
            return redirect($routeTo)->with('success', __('success-create-news'));
        }
        return back()->with('error', __('error-create-news'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(News $news)
    {
        $data['news'] = $news;

        return view('dashboard::news.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'isActive' => '',
            'title' => 'required|min:3',
            'description' => '',
            'content' => '',
            'videoUrl' => ''
        ]);

        if ($news->update($data)) {
            return back()->with('success', __('success-update-news'));
        }
        return back()->with('error', __('error-update-news'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(News $news)
    {
        if ($news->exists() && $news->delete()) {
            return back()->with('success', __('success-delete-news'));
        }
        return back()->with('error', __('error-delete-news'));
    }
}
