<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Team;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Traits\UploadSingleImageTrait;
use App\Http\Resources\Team\TeamResources;
use Illuminate\Auth\Access\AuthorizationException;

class TeamController extends Controller
{ use UploadSingleImageTrait;
    public function __construct()
    {
        $this->middleware('admin')->except('Team');
    }

    public function index()
    {
        $team = Team::get();
        return view('backend.team.index', compact('team'));
    }


    public function create()
    {
        return view('backend.team.create');
    }


    public function store(Request $request)
    {
        $request->validate([
             'name' => 'required',
             'logo' => 'required'
        ]);
        $logo         = $request->file('logo');
        $uploadedlogo = $this->processSingleImage($logo, 'Team/', true, 615, 460);
        //dd($request->all());
        Team::create([
            'name'          => $request->input('name'),
            'logo'         => $uploadedlogo,
            'status'        => $request->input('status')=='on'?'active':'inactive',
        ]);

        return redirect()->route('team.all')->with('msg', 'تم اضافة الفريق');
    }


    public function edit(string $id)
    {
        $team = Team::find($id);
        return view('backend.team.edit', compact('team'));
    }

    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);
        $image   = $request->file('logo');
        //dd($image);
        if ($image) {
            // Delete the old image if it exists
            $pathImage = public_path('upload/Team/' . $team->image);
            if (File::exists($pathImage)) {
                File::delete($pathImage);
            }
            $uploadedImage = $this->processSingleImage($image, 'Team/', true, 615, 460);
            DB::table('Teams')->where('id', $Team->id)->update([
                'logo' => $uploadedImage,
            ]);
        }
            
        $team->update([
            'name'          => $request->input('name'),
            'status'        => $request->input('status')=='on'?'active':'inactive',
        ]);

        return redirect()->route('team.all')->with('msg', 'تم تحديث المعلومات');
    }


    public function destroy(string $id)
    {
        $Team = Team::findOrFail($id);
        $pathImage = public_path('upload/team/' . $Team->image);
        if (File::exists($pathImage)) {
            File::delete($pathImage);
        }
        $Team->delete();
        return redirect()->back()->with('msg', 'تم حذف الفريق');
    }

    
    public function Team()
    {
        try {
            
            $data = Team::active()->get();
            $success['success'] = true;
            $success['data'] =TeamResources::collection($data);
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
