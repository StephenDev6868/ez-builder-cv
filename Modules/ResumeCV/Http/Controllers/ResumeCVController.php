<?php

namespace Modules\ResumeCV\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ResumeCV\Entities\Resumecv;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use Modules\User\Entities\User;
use Modules\Ezinvite\Entities\HistoryCredit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use URL;
use Illuminate\Support\Facades\Cookie;
use Module;

class ResumeCVController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index(Request $request)
    {

        $data = Resumecv::where('user_id', $request->user()->id);
        if ($request->filled('search')) {
            $data->where('name', 'like', '%' . $request->search . '%');
        }

        $data->orderBy('created_at', 'DESC');

        $data = $data->paginate(5);

        return view('resumecv::resumecv.index', compact(
            'data'
        ));
    }
    public function userResumecvs(Request $request)
    {

        $data = Resumecv::orderBy('created_at', 'DESC');
        if ($request->filled('search')) {
            $data->where('name', 'like', '%' . $request->search . '%');
        }
        $data = $data->paginate(15);

        return view('resumecv::resumecv.user_resumecvs', compact(
            'data'
        ));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function save(Request $request)
    {
        // Check required info name, gender, senior high school name, grade
        $user = $request->user();
        if(!$user->name || !$user->mobile_phone || !$user->gender || !$user->high_school_name || !$user->grade){
            return redirect()->route('accountsettings.index')
            ->with('error', __('You need update name, mobile phone, gender, senior high school name, before create a resume'));
        }

        $request->validate(['name' => 'required|max:255', 'template_id' => 'required']);

        $template_id = $request->input('template_id');
        // Get template ID content and style => load builder
        $template = Resumecvtemplate::findorFail($template_id);

        if($template->credit > $user->credit) {
            return redirect()->route('alltemplates')
                ->with('error', __('Your credit do not enough to build'));
        };

        $template = replaceVarContentStyle($template);
        //
        if($template->credit > 0){
            HistoryCredit::query()
                ->create([
                    'user_id' => $user->id,
                    'amount'  => $template->credit,
                    'type'    => 3,
                    'status'  => 2,
                    'done_at' => now(),
                ]);
        }

        // Update credit of user after build
        $userN = User::query()
            ->where('id', $user->id)
            ->first();
        $userN->credit = (int) $userN->credit - (int) $template->credit;
        $userN->save();


        $item = Resumecv::create([
            'user_id'  => $request->user()->id,
            'name' => $request->input('name'),
            'content' => $template->content,
            'style' => $template->style,
        ]);

        return redirect()->route('resumecv.builder', ['code'=>$item->code]);
    }

    public function builder($code, Request $request)
    {
        $data = Resumecv::where('code', $code);
        if(!$request->user()->can('admin')){
            $data = Resumecv::where('user_id', $request->user()->id);
        }
        $data = $data->first();

        if (!$data) {
            abort(404);
        }
        $data = replaceVarContentStyle($data);
        $all_templates = Resumecvtemplate::with('category')->active();
        $all_templates = $all_templates->orderBy('created_at', 'DESC')->get();

        $images_url = getAllImagesUser($request->user()->id);
        $all_icons = config('app.all_icons');
        $all_fonts = config('app.all_fonts');

        return view('resumecv::resumecv.builder', compact('data','all_icons','all_fonts','images_url','all_templates'));

    }
    public function updateBuilder($id, Request $request)
    {
        $item = Resumecv::find($id);

        if ($item) {

            $item->content = $request->input('gjs-html');
            $item->style = $request->input('gjs-css');

            if($item->save()){
              return response()->json(['success'=>__("Updated successfully")]);
            }

        }
        return response()->json(['error'=>__("Updated failed")]);
    }

    public function loadBuilder($id, Request $request)
    {
        $item = Resumecv::find($id);
        $item = replaceVarContentStyle($item);
        if ($item) {

            return response()->json([
                    'gjs-html'=>$item->content,
                    'gjs-css' => $item->style
            ]);
        }
        return response()->json(['error'=>__("Not Found template")]);
    }

    public function clone ($id, Request $request)
    {
        $template = Resumecv::findorFail($id);
        $item = $template->replicate();
        $item->name = "Copy " . $template->name;
        $item->save();

        return redirect()
            ->route('resumecv.index')
            ->with('success', __('You copy the template :name successfully', ['name' => $template->name]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $item = Resumecv::findorFail($id);
        $item->delete();

        return redirect()->route('resumecv.index')
            ->with('success', __('Deleted successfully'));
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'files' => 'required|mimes:jpg,jpeg,png,svg|max:512',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => __('The file must be an jpg,jpeg,png,svg and maximum 0.5MB')]);
        }
        $images=array();
        $imagesURL=array();

        if($request->hasfile('files'))
        {
            $file = $request->file('files');

            $name=$file->getClientOriginalName();
            $new_name = $name;
            $file->move(public_path('storage/user_storage/'.$request->user()->id), $new_name);
            $imagesURL[] = URL::to('/storage/user_storage/'.$request->user()->id."/".$new_name);
            $images[]=$new_name;

        }
        return response()->json($imagesURL);
    }

    public function deleteImage(Request $request)
    {
        $input=$request->all();
        $link_array = explode('/',$input['image_src']);
        $image_name = end($link_array);
        $path = public_path('storage/user_storage/'.$request->user()->id."/".$image_name);

        if(File::exists($path)) {
            File::delete($path);
        }
        return response()->json($image_name);
    }
    public function setting($code,Request $request)
    {
        if ($code) {

            $data = Resumecv::where('code', $code);
            if(!$request->user()->can('admin')){
                $data = Resumecv::where('user_id', $request->user()->id);
            }
            $item = $data->first();

            if ($item) {
                return view('resumecv::resumecv.setting', compact('item'));
            }
        }
        abort(404);
    }
    public function settingUpdate($id,Request $request)
    {
        // add validate intergration
        $validate = [
            'name'    => 'required|max:255',
            'slug'           => 'required|alpha_dash|max:50|unique:resumecv,slug,' . $id,
        ];

        $request->validate($validate);
        $item  = Resumecv::findOrFail($id);
        $dataRequest = $request->all();

        $item->update($dataRequest);

        return back()->with('success', __('Updated successfully'));
    }

    public function publish($slug,Request $request)
    {
        if ($slug) {

            $item = Resumecv::where('slug', $slug)->first();

            if ($item) {

                $check_remove_brand = true;
                if (Module::find('Saas')) {
                    $user = User::findOrFail($item->user_id);
                    $check_remove_brand = $user->checkRemoveBrand();
                }
                // count view resume
                if ($this->add_count($item->id) == true) {
                    $item->view_count += 1;
                    $item->save();
                }
                return view('resumecv::resumecv.publish', compact('item','check_remove_brand'));
            }
        }

        abort(404);
    }

    public function download($code,Request $request)
    {
        if ($code) {

            $item = Resumecv::where('code', $code)->first();

            if ($item) {
                $check_remove_brand = 1;

                $user   = $request->user();
                if ($user) {

                    if (Module::find('Saas')) {
                        $check_remove_brand = $request->user()->checkRemoveBrand();
                    }
                }
                return view('resumecv::resumecv.download', compact('item','check_remove_brand'));
            }
        }

        abort(404);
    }

    public function getPageJson($code,Request $request)
    {
        $page = $request->page;
        $item = Resumecv::where('code', $code)->first();

        if ($item) {
            return response()->json([
                'css' => $item->style,
                'html'=>$item->content,
            ]);
        }

    }
    function add_count($id)
    {
        $cookie_name = 'resumecv_view_'.$id;

        $check_visitor = Cookie::get($cookie_name);

        $minutes = 7200; // 5 days

        if (!$check_visitor) {
            Cookie::queue($cookie_name, 'viewed', $minutes);
            return true;
        }
        // exits Cookie
        return false;
    }
    public function help(Request $request)
    {
        $data = [];
        return view('resumecv::resumecv.help', compact(
            'data'
        ));

    }

}
