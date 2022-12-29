<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AuthorizedPerson;
use App\Models\User;


class AuthorizedPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        //
        $user = User::find(Auth::id());
        $authorized_person = DB::table('authorized_people')->where('authorized_people.user_id', $user->id)->get();
        return response([
            'authorized_person' => $authorized_person
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAuthorizedPerson(Request $request, $id)
    {
        //
        $user = User::find(Auth::id());
        DB::table('authorized_people')->where('authorized_people.user_id', $user->id)->where('authorized_people.id', $id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
        ]);
        return response([
            'message' => 'Updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_authorized_person($id)
    {
        //
        $user = User::find(Auth::id());
        DB::table('authorized_people')->where('authorized_people.user_id', $user->id)->where('authorized_people.id', $id)->delete();
        return response([
            'message' => 'Deleted Successfuly'
        ]);
    }
}
