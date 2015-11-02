<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Activity;
use App\Group;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $activities = Activity::whereNotIn('id', $user->activities()->get()->map(function ($item, $key) {return $item->id;}))->get();
        return view('userActivities', compact('user', 'activities'));
    }


 /**
  * Adds activity for given event
  * 
  * @param type $id 
  * @param type $activityId
  */
    public function add($id, Request $request){
        $user = User::findOrFail($id);
        $activity = Activity::findOrFail($request->input('activityId'));
        // Oikea marked_by_user_id lisätään myöhemmin
        // Myös event date lisätään myöhemmin
        $user->activities()->attach($activity, ['marked_by_user_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'event_date' => Carbon::now()]);
        $user->save();
        return redirect()->back();
    }
    
    private function userHasCompletedActivity($user, $activity) {
        if($user->activities->contains($activity))
        {
            return true;
        }
        return false;
    }
    
    
    public function addMany(Request $request) {
        $group = Group::findOrFail($request->input('group'));
        $users = $group->users;
        $activity = Activity::findOrFail($request->input('activityId'));
        
        for($i = 0; $i < count($users); $i++)
        {
            $user = $users[$i];
            $mark = $request->input($user->id);
            
            if($mark != NULL && self::userHasCompletedActivity($user, $activity) == false)
            {
                $user->activities()->attach($activity, ['marked_by_user_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'event_date' => Carbon::now()]);
                $user->save();
            }
        }
        
        return redirect()->back();
    }
    
    /**
     * Removes activity from given event
     * 
     * @param type $id
     * @param type $activityId
     */
    public function remove($id, Request $request){
        $user = User::findOrFail($id);
        $activity = Activity::findOrFail($request->input('activityId'));
        $user->activities()->detach($activity);
        $user->save();
        return redirect()->back();
    }
}
