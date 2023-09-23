<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Exception;
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
        try {
            return Member::all();

        } catch (Exception $e) {
            return response()->json(['KO' => 'Oops! Unable to find embers.'], 200);
        }

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
        try {
            return Member::findOrFail($id);

        } catch (Exception $e) {
            return response()->json(['KO' => 'Oops! Unable to find member.'], 200);
        }
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


        try {
            $member = Member::findOrFail($id);
            $member->update($request->all());

            return $member;

        } catch (Exception $e) {
            return response()->json(['KO' => 'Oops! Unable to update member.'], 200);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->delete();
            return response()->json(['OK' => 'The member has been successfully deleted.'], 200);
        } catch (Exception $e) {
            return response()->json(['KO' => 'Oops! Unable to delete member.'], 200);
        }
    }
}
