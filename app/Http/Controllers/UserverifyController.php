<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Models\Userlogin;
use Illuminate\Support\Facades\Hash;
use Session;
class UserverifyController extends Controller
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
    public function show($id)
    {
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
        //
    }
    public function userlogin(Request $request)
    {
        // print_r($request->all());
        // print_r($request->name);
        // exit();
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:20',
            'password' => 'required|max:20'
        ]);
        if ($validator->fails()) {
            // return response()->json([
            //     'status' => 400,
            //     'message' => $validator->messages()
            // ]);
            $messages = $validator->messages();
            // print_r($messages);
            // exit();
            return Redirect::to('userlogin')->withErrors($messages);
        } else {
            $user=Userlogin::where('email','=',$request->username)->first();
            if($user){
                if(HASH::check($request->password,$user->password)){
                    $request->session()->put('loginid',$user->id);
                    $request->session()->put('username',$user->name);
                    return redirect('dashboard');
                    // return response()->json([
                    //     'status' => 200,
                    //     'message' => 'Registered Successfully'
                    // ]);
                    //echo "hello" .$user->name."You Have Successfully Loggedin";
                }else{
                    return redirect('userlogin');
                }
            }
        }
    }
}
