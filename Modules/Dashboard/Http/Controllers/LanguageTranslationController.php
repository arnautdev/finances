<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LanguageTranslationController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function index()
    {
        $languages = collect(config('app.localesI18n'));
        $columns = [];
        $columnsCount = $languages->count();

        if ($languages->count() > 0) {
            foreach ($languages as $key => $language) {
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language);
                }
                $columns[++$key] = ['data' => $this->openJSONFile($language), 'lang' => $language];
            }
        }

        return view('dashboard::languages.index', compact('languages', 'columns', 'columnsCount'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
        ]);

        $persistentStrings = $this->openJSONFile('persistent-strings');
        $persistentStrings[$request->key] = $request->key;
        $this->saveJSONFile('persistent-strings', $persistentStrings);

        $languages = collect(config('app.localesI18n'));
        $languages->map(function ($lang) use ($request, $persistentStrings) {
            $data = $this->openJSONFile($lang);

            collect($persistentStrings)->map(function ($val, $key) use (&$persistentStrings, $data) {
                if (isset($data[$key])) {
                    $persistentStrings[$key] = $data[$key];
                }
            });

            $data = array_merge($data, $persistentStrings);
            $data[$request->key] = $request->value;
            $this->saveJSONFile($lang, $data);
        });

        return redirect()->route('languages')->with('success', __('Successfully added label'));
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($key)
    {
        $languages = collect(config('app.localesI18n'));


        if ($languages->count() > 0) {
            $languages->add('persistent-strings');
            foreach ($languages as $lkey => $language) {
                $data = $this->openJSONFile($language);
                unset($data[$key]);
                $this->saveJSONFile($language, $data);
            }
        }
        return response()->json(['success' => $key]);
    }


    /**
     * Open Translation File
     * @return Response
     */
    private function openJSONFile($code)
    {
        // create file if is not exists
        if (!is_file(base_path('resources/lang/' . $code . '.json'))) {
            $langFile = $code . '.json';
            Storage::disk('lang')->put($langFile, '{}');
        }

        $jsonString = [];
        if (is_file(base_path('resources/lang/' . $code . '.json'))) {
            $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }


    /**
     * Save JSON File
     * @return Response
     */
    private function saveJSONFile($code, $data)
    {
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
    }


    /**
     * Save JSON File
     * @return Response
     */
    public function transUpdate(Request $request)
    {
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;


        $this->saveJSONFile($request->code, $data);
        return response()->json(['success' => 'Done!']);
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function transUpdateKey(Request $request)
    {
        $languages = collect(config('app.localesI18n'));
        if ($languages->count() > 0) {
            foreach ($languages as $key => $language) {
                $data = $this->openJSONFile($language);
                if (isset($data[$request->pk])) {
                    $data[$request->value] = $data[$request->pk];
                    unset($data[$request->pk]);
                    $this->saveJSONFile($language, $data);
                }
            }
        }
        return response()->json(['success' => 'Done!']);
    }
}