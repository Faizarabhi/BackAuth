<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd('test');
        return Member::all();
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
        // bcrypt($request->password)
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        return Member::create($request->all());
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    $member = Member::where('email', $credentials['email'])->first();

    if (!$member || !Hash::check($credentials['password'], $member->password)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $tokenResult = $member->createToken('YourAppToken');
    $token = $tokenResult->accessToken;

    return response()->json(['token' => $token], 200);
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Member::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $member = Member::findOrFail($id);
        $member->update($request->all());

        return $member;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $member = Member::findOrFail($id);
        return $member->delete();

        return 204;
    }
}
