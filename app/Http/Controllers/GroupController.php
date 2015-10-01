<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::paginate($request->input('perpage', 15));
        return view('groups', compact('groups'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('newGroup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:64',
            'scout_group' => 'required|max:64',
            'age_group' => 'required|max:64',
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->scout_group = $request->input('scout_group');
        $group->age_group = $request->input('age_group');
        $group->save();

        return redirect('groups');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        return view('group', compact('group'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('editGroup', compact('group'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:64',
            'scout_group' => 'required|max:64',
            'age_group' => 'required|max:64',
        ]);       
        $group = Group::findOrFail($id);
        $group->name = $request->input('name');
        $group->scout_group = $request->input('scout_group');
        $group->age_group = $request->input('age_group');
        $group->save();
        
        return redirect()->action('GroupController@show', [$group]);  
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
        return redirect('groups');
        //
    }
}