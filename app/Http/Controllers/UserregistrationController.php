<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Models\Userlogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;

class UserregistrationController extends Controller
{
   // public function __construct()
   //  {
   //      $this->middleware(['auth','verified']);
   //  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('home');
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
    public function register(Request $request)
    {
        //
        // print_r($request->all());
        // print_r($request->name);
        // exit();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:Userlogin|max:20',
            'email' => 'required|email|unique:Userlogin|max:100',
            'phone' => 'required|unique:Userlogin|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            // print_r($messages);
            // exit();
            return Redirect::to('registeruser')->withErrors($messages);
        }else{
            $user = new Userlogin;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = Str::random(10);
            $user->save();
            $messages = "Registration Successful";
            return Redirect::to('userlogin')->withErrors($messages);
        }
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
}
