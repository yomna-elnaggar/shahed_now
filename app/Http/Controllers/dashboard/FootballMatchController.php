<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FootballMatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class FootballMatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('FootballMatch');
    }
    public function index()
    {
        //dd(new DateTime());
        $FootballMatch = FootballMatch::with(['category','TeamF','TeamS'])->get();
        return view('backend.FootballMatch.index', compact('FootballMatch'));
    }

    public function create()
    {
        $categories = Category::get(); 
        $teams = Team::select('name','id')->get(); 
        return view('backend.FootballMatch.create', compact('categories','teams'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'teamF_id' => 'required',
            'teamS_id' => 'required',
        ]);

        FootballMatch::create([
            'teamF_id' => $request->teamF_id,
            'teamS_id' => $request->teamS_id,
            'resultF' => $request->resultF,
            'resultS' => $request->resultS,
            'place' => $request->place,
            'category_id' => $request->category_id,
            'live' => $request->live,
            'status' => $request->status,
            'match_datetime'=> $request->match_datetime
        ]);
        return redirect()->route('FootballMatch.all')->with('msg', 'تم اضافة المباراة');
    }


    public function edit($id)
    {
        $FootballMatch = FootballMatch::findOrFail($id);
        $categories = Category::get(); 
        $teams = Team::select('name','id')->get(); 
        return view('backend.FootballMatch.edit', compact('categories','FootballMatch','teams'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // Validation rules here
        ]);

        $FootballMatch = FootballMatch::findOrFail($id);
        // Update match fields with the form data
        $FootballMatch->update([
            'category_id' => $request->category_id,
            'teamF_id' => $request->teamF_id,
            'resultF' => $request->resultF,
            'teamS_id' => $request->teamS_id,
            'resultS' => $request->resultS,
            'place' => $request->place,
            'status' => $request->status,
            'live' => $request->live,
            'match_datetime'=> $request->match_datetime
        ]);

        return redirect()->route('FootballMatch.all')->with('msg', 'تم تحديث المباراة بنجاح');
    }


    public function destroy(string $id)
    {
        $FootballMatch = FootballMatch::findOrFail($id);
        $FootballMatch->delete();
        return redirect()->back()->with('msg', 'تم حذف المباراة');
    }

    

    public function FootballMatch($date)
    {
        try {
            $formattedDate = Carbon::createFromFormat('m-d', $date)->format('Y-m-d');

            $FootballMatches = FootballMatch::whereDate('match_datetime', $formattedDate)->get();
            
            $success['success'] = true;
            $success['data'] = $FootballMatches;
            $success['message'] = __('message.success');
            
            return response()->json($success, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
}
