<?php

namespace App\Http\Controllers\Help;

use App\Http\Controllers\Controller;
use App\Models\Help;
use App\Models\Language;
use App\Models\User;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class HelpsController extends Controller
{

    /**
     * Display a listing of the helps.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $helps = Help::with('languagers')->paginate(25);
        $helpers = Help::pluck('title', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();

        return view('helps.index', compact('helps', 'languages', 'helpers'));
    }

    /**
     * FIlter a listing of the helps.
     *
     * @return Illuminate\View\View
     */
    public function filter(Request $request, Help $helps)
    {
        $helps = $helps->newQuery();
        if ($request->has('language')) {
            $helps->where('language_id', $request->input('language'));
        }
        if ($request->has('parent_id')) {
            $helps->where('parent', $request->input('parent_id'));
        }
        if ($request->has('title')) {
            $helps->where('title', 'like', '%' . $request->input('title') . '%');
        }
        $languages = Language::pluck('name', 'id')->all();
        $helpers = Help::pluck('title', 'id')->all();
        $helps = $helps->paginate(25);
        return view('helps.index', compact('helps', 'languages', 'helpers'));
    }

    /**
     * Show the form for creating a new help.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $helps = Help::pluck('title', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();

        return view('helps.create', compact('helps', 'languages'));
    }

    public function image(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('uploads/help'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    /**
     * Store a new help in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            $data['created_by'] = 1;
            $editor_content = $request->data;
            $dom = new \DomDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHtml($editor_content);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                $data = base64_decode($data);
                // save to uploads folder
                $image_name = "/uploads/help/" . 'help_' . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            };
            $editor_content_save = utf8_decode($dom->saveHTML($dom));
            Help::create($data);

            return redirect()->route('helps.help.index')
                ->with('success_message', 'Help was successfully added.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified help.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $help = Help::with('helpes', 'languagers')->findOrFail($id);

        return view('helps.show', compact('help'));
    }

    /**
     * Show the form for editing the specified help.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $help = Help::findOrFail($id);
        $helps = Help::pluck('title', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();

        return view('helps.edit', compact('help', 'helps', 'languages'));
    }

    /**
     * Update the specified help in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $help = Help::findOrFail($id);
            $help->update($data);

            return redirect()->route('helps.help.index')
                ->with('success_message', 'Help was successfully updated.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified help from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $help = Help::findOrFail($id);
            $help->delete();

            return redirect()->route('helps.help.index')
                ->with('success_message', 'Help was successfully deleted.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'description' => 'string|min:1|max:1000|nullable',
            'data' => 'required|string|min:1',
            'topic_for' => 'required|string|min:1',
            'parent' => 'nullable',
            'language' => 'required|numeric|min:0|max:4294967295',
            'created_by' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
