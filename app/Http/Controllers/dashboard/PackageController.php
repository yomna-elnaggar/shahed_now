<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Package;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Traits\UploadSingleImageTrait;
use App\Http\Resources\Team\PackageResources;
use Illuminate\Auth\Access\AuthorizationException;

class PackageController extends Controller
{ use UploadSingleImageTrait;
    public function __construct()
    {
        $this->middleware('admin')->except('Package');
    }

    public function index()
    {
        $package = Package::get();
        return view('backend.package.index', compact('package'));
    }


    public function create()
    {
        return view('backend.package.create');
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'slug' => 'required'
        // ]);
        $image         = $request->file('image');
        $uploadedImage = $this->processSingleImage($image, 'package/', true, 615, 460);
        //dd($request->all());
        Package::create([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'image'         => $uploadedImage,
            'price'         => $request->input('price'),
            'duration'      => $request->input('duration'),
            'status'        => $request->input('status')=='on'?'active':'inactive',
        ]);

        return redirect()->route('package.all')->with('msg', 'تم اضافة الباقة');
    }


    public function edit(string $id)
    {
        $package = Package::find($id);
        return view('backend.package.edit', compact('package'));
    }

    public function update(Request $request, string $id)
    {
        $package = Package::findOrFail($id);
        $image   = $request->file('image');
        //dd($image);
        if ($image) {
            // Delete the old image if it exists
            $pathImage = public_path('upload/package/' . $package->image);
            if (File::exists($pathImage)) {
                File::delete($pathImage);
            }
            $uploadedImage = $this->processSingleImage($image, 'package/', true, 615, 460);
            DB::table('packages')->where('id', $package->id)->update([
                'image' => $uploadedImage,
            ]);
        }
            
        $package->update([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'price'         => $request->input('price'),
            'duration'      => $request->input('duration'),
            'status'        => $request->input('status')=='on'?'active':'inactive',
        ]);

        return redirect()->route('package.all')->with('msg', 'تم تحديث المعلومات');
    }


    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $pathImage = public_path('upload/package/' . $package->image);
        if (File::exists($pathImage)) {
            File::delete($pathImage);
        }
        $package->delete();
        return redirect()->back()->with('msg', 'تم حذف التصنيف');
    }

    public function Package()
    {
        try {
            
            $data = Package::get();
            $success['success'] = true;
            $success['data'] =PackageResources::collection($data);
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
