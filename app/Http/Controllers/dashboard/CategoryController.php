<?php

namespace App\Http\Controllers\dashboard;


use App\Models\Category;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Traits\UploadSingleImageTrait;
use App\Http\Resources\Team\PackageResources;
use Illuminate\Auth\Access\AuthorizationException;

class CategoryController extends Controller
{ use UploadSingleImageTrait;
    public function __construct()
    {
        $this->middleware('admin')->except('Category');
    }

    public function index()
    {
        $category = Category::get();
        return view('backend.category.index', compact('category'));
    }


    public function create()
    {
        return view('backend.category.create');
    }


    public function store(Request $request)
    {
      
        $request->validate([
            'names.*' => 'required',
        ]);
        $names = $request->input('names');
        foreach ($names as $name) {
            Category::create([
                'name' => $name,
                
            ]);
        }
        return redirect()->route('category.all')->with('msg', 'تم اضافة الدوريات');
    }
    

    // public function edit(string $id)
    // {
    //     $category = Category::find($id);
    //     return view('backend.category.edit', compact('category'));
    // }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name'=> $request->input('name')]);

        return redirect()->route('category.all')->with('msg', 'تم تحديث المعلومات');
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
       
        $category->delete();
        return redirect()->back()->with('msg', 'تم حذف الدوري');
    }

    public function Package()
    {
        try {
            
            $data = Category::get();
            $success['success'] = true;
            $success['data'] =PackageResources::collection($data);
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
