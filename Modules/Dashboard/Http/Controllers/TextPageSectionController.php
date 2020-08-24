<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Entities\TextPageSection;
use Modules\Common\Traits\I18nHelperTrait;

class TextPageSectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'pageId' => 'required|numeric'
        ]);
        $data['slug'] = str_slug($data['title']);

        $page = TextPageSection::create($data);
        if ($page->exists()) {
            return back()->with('success', __('success-create-page'));
        }
        return back()->with('error', __('error-create-page'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(TextPageSection $text_page_section)
    {
        $data['page'] = $text_page_section;
        return view('dashboard::text-page-section.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, TextPageSection $text_page_section)
    {
        if ($request->exists('pageMedia')) {
            return $this->savePageMedia($text_page_section);
        }

        $data = $request->validate([
            'isActive' => '',
            'title' => 'required|min:3',
            'description' => '',
            'content' => '',
        ]);

        if ($text_page_section->update($data)) {
            return back()->with('success', __('success-update-page'));
        }
        return back()->with('error', __('error-update-page'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(TextPageSection $text_page_section)
    {
        if ($text_page_section->exists() && $text_page_section->delete()) {
            return back()->with('success', __('success-delete-page'));
        }
        return back()->with('error', __('error-delete-page'));
    }

    /**
     * Save page media
     * @param TextPage $textPage
     * @return $this
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    private function savePageMedia(TextPageSection $textPage)
    {
        $request = \request();
        if ($request->exists('fbShareImage')) {
            $request->validate([
                'fbShareImage' => 'image|mimes:jpeg,png,jpg|max:5048'
            ]);

            // clear collection before save
            $textPage->clearMediaCollection('fbShareImage');
            $textPage->addMedia($request->fbShareImage)
                ->toMediaCollection('fbShareImage');
        }

        // page image
        if ($request->exists('pageImage')) {
            $request->validate([
                'pageImage' => 'image|mimes:jpeg,png,jpg,svg|max:5048'
            ]);

            // clear collection before save
            $textPage->clearMediaCollection('pageImage');
            $textPage->addMedia($request->pageImage)
                ->toMediaCollection('pageImage');
        }


        /// page gallery
        if ($request->exists('pageGallery')) {
            // clear collection before save
            foreach ($request->pageGallery as $item) {
                $textPage->addMedia($item)
                    ->toMediaCollection('pageGallery');
            }
        }


        return back()->with('success', __('success-add-media'));
    }

    /**
     * @return array
     */
    public function saveMediaOrder()
    {
        $order = \request()->get('order');
        $status = Media::setNewOrder($order);
        return ['status' => $status];
    }
}
