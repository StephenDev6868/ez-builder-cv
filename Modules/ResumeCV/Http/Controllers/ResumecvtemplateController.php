<?php
namespace Modules\ResumeCV\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use Modules\ResumeCV\Entities\Resumecvcategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use URL;

class ResumecvtemplateController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Resumecvtemplate::with('category');

        if ($request->filled('search'))
        {
            $data->where('name', 'like', '%' . $request->search . '%');
        }
        $data->orderBy('created_at', 'DESC');

        $data = $data->paginate(10);

        return view('resumecv::resumecvtemplates.index', compact('data'));
    }

     public function getAllTemplateThemes($id = "",Request $request)
    {
        $data = Resumecvtemplate::with('category')->active();

        if ($id)
            $data = Resumecvtemplate::where('category_id', $id);

        $data->orderBy('created_at', 'DESC');
        $data = $data->paginate(10);

        $categories = Resumecvcategory::all();
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();

        return view('themes::' . $skin . '.templates', compact(
            'data','categories','currency_code','currency_symbol','user'
        ));

    }
     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getAllTemplate($id = "")
    {
        $data = Resumecvtemplate::with('category')->active();
        if ($id)
            $data = Resumecvtemplate::where('category_id', $id)->active();

        $data->orderBy('created_at', 'DESC');
        $data = $data->paginate(10);

        $categories = Resumecvcategory::all();
        return view('resumecv::resumecvtemplates.templates', compact('data','categories'));
    }

    public function loadTemplate($templateid)
    {
        $item = Resumecvtemplate::find($templateid);
        $item = replaceVarContentStyle($item);
        if ($item) {

            return response()->json([
                'content'=>$item->content,
                'style' => $item->style
            ]);
        }
        return response()->json(['error'=>__("Not Found template")]);

    }

    public function builder($id, Request $request)
    {
        $data = Resumecvtemplate::findorFail($id);

        $data = replaceVarContentStyle($data);

        $all_templates = Resumecvtemplate::with('category');
        $all_templates = $all_templates->orderBy('created_at', 'DESC')->get();

        $images_url = getAllImagesContentMedia();
        $all_icons = config('app.all_icons');
        $all_fonts = config('app.all_fonts');

        return view('resumecv::resumecvtemplates.builder_template', compact('data','all_icons','all_fonts','images_url','all_templates'));

    }
    public function updateBuilder($id, Request $request)
    {
        $item = Resumecvtemplate::find($id);

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
        $item = Resumecvtemplate::find($id);
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
        $template = Resumecvtemplate::findorFail($id);
        $item = $template->replicate();
        $item->name = "Copy " . $template->name;
        $item->active = false;
        $item->thumb = '';
        $item->save();

        return redirect()
            ->route('settings.resumecvtemplate.index')
            ->with('success', __('You copy the template :name successfully', ['name' => $template->name]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Resumecvcategory::select("id", "name")->get();

        return view('resumecv::resumecvtemplates.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required',
            'thumb' => 'sometimes|required|mimes:jpg,jpeg,png,svg|max:20000',
            ],
            ['thumb.mimes' => __('The :attribute must be an jpg,jpeg,png,svg') ,
            ]);

        if (!$request->filled('is_premium'))
        {
            $request
                ->request
                ->add(['is_premium' => false, ]);
        }
        else
        {
            $request
                ->request
                ->add(['is_premium' => true, ]);
        }
        if (!$request->filled('active'))
        {
            $request
                ->request
                ->add(['active' => false, ]);
        }
        else
        {
            $request
                ->request
                ->add(['active' => true, ]);
        }
        $new_name = "";
        $image = $request->file('thumb');

        if ($image != '')
        {

            $new_name = rand() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('storage/thumb_templates') , $new_name);
        }

        $form_data = array(
            'category_id' => $request->category_id,
            'name' => $request->name,
            'content' => $request->content,
            'style' => $request->style,
            'is_premium' => $request->is_premium,
            'credit' => $request->credit,
            'active' => $request->active,
            'thumb' => $new_name
        );

        $item = Resumecvtemplate::create($form_data);

        if (isset($request->save_and_builder))
        {

            return redirect()
                ->route('settings.resumecvtemplate.builder', $item);
        }

        return redirect()->route('settings.resumecvtemplate.index')
            ->with('success', __('Created successfully'));

    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('resumecv::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $template = Resumecvtemplate::findorFail($id);

        $categories = Resumecvcategory::select("id", "name")->get();
        return view('resumecv::resumecvtemplates.edit', compact('template', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $item = Resumecvtemplate::findOrFail($id);

        $image_name = $request->hidden_image;

        $image = $request->file('thumb');

        if ($image != '')
        {
            $request->validate(['category_id' => 'required|integer', 'name' => 'required', 'thumb' => 'sometimes|required|mimes:jpg,jpeg,png,svg|max:20000', ], ['thumb.mimes' => __('The :attribute must be an jpg,jpeg,png,svg') , ]);

            $path = public_path('storage/thumb_templates') . "/" . $item->thumb;
            deleteImageWithPath($path);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/thumb_templates') , $image_name);
        }
        else
        {
            $request->validate(['category_id' => 'required|integer', 'name' => 'required', ]);
        }

        if (!$request->filled('is_premium'))
        {
            $request
                ->request
                ->add(['is_premium' => false, ]);
        }
        else
        {
            $request
                ->request
                ->add(['is_premium' => true, ]);
        }
        if (!$request->filled('active'))
        {
            $request
                ->request
                ->add(['active' => false, ]);
        }
        else
        {
            $request
                ->request
                ->add(['active' => true, ]);
        }

        $form_data = array(
            'category_id' => $request->category_id,
            'name' => $request->name,
            'content' => $request->content,
            'style' => $request->style,
            'is_premium' => $request->is_premium,
            'credit' => $request->credit,
            'active' => $request->active,
            'thumb' => $image_name
        );

        $item->update($form_data);

        if (isset($request->save_and_builder))
        {
            return redirect()
                ->route('settings.resumecvtemplate.builder', $item);
        }
        return redirect()->route('settings.resumecvtemplate.index')
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Resumecvtemplate::find($id);
        try
        {
            $path = public_path('storage/thumb_templates') . "/" . $item->thumb;
            deleteImageWithPath($path);
            $item->delete();

        }
        catch(Exception $e)
        {

            var_dump($e);
            die;
        }

        return redirect()->route('settings.resumecvtemplate.index')
            ->with('success', __('Deleted successfully'));
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'files' => 'required|mimes:jpg,jpeg,png,svg|max:20000',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => __('The file must be an jpg,jpeg,png,svg')]);
        }
        $images=array();
        $imagesURL=array();

        if($request->hasfile('files'))
        {
            $file = $request->file('files');

            $name=$file->getClientOriginalName();
            $new_name = $name;
            $file->move(public_path('storage/content_media/'), $new_name);
            $imagesURL[] = URL::to('/storage/content_media/'.$new_name);
            $images[]=$new_name;

        }
        return response()->json($imagesURL);
    }

    public function deleteImage(Request $request)
    {
        $input=$request->all();
        $link_array = explode('/',$input['image_src']);
        $image_name = end($link_array);
        $path = public_path('storage/content_media/'.$image_name);

        if(File::exists($path)) {
            File::delete($path);
        }
        return response()->json($image_name);
    }
}

