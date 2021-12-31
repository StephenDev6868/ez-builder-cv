<?php
namespace Modules\ResumeCV\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ResumeCV\Entities\Resumecvcategory;

class ResumecvcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Resumecvcategory::query();

        if ($request->filled('search'))
        {
            $data->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $data->paginate(10);

        return view('resumecv::resumecvcategories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('resumecv::resumecvcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', ]);
        $form_data = array(
            'name' => $request->name,
        );

        $user = Resumecvcategory::create($form_data);

        return redirect()->route('settings.resumecvcategories.index')
            ->with('success', __('Created successfully'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Resumecvcategory::findorFail($id);
        return view('resumecv::resumecvcategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);

        $form_data = array(
            'name' => $request->name,
        );

        Resumecvcategory::whereId($id)->update($form_data);

        return redirect()->route('settings.resumecvcategories.index')
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Resumecvcategory::find($id);
        
        if ($item->templates()->count() > 0) {
            return redirect()->route('settings.resumecvcategories.index')->with('error',"Can't delete because it has template in it");
        }
        $delete_status = $item->delete();

        return redirect()->route('settings.resumecvcategories.index')->with('success','Deleted successfully');
    }
}

