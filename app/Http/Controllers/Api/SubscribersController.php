<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Subscribers;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subScribers = Subscribers::all();
        return response()->json([
            'data' =>$subScribers,
            'code' =>200
        ]);
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = Subscribers::create([
            'name' => $request->name,
            'email' =>$request->email
        ]);
        
        $subScribers = Subscribers::all();
        return response()->json([
            'data' =>$subScribers,
            'code' =>200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subScribers = Subscribers::findOrFail($id);
        return response()->json([
            'data' =>$subScribers,
            'code' =>200
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $subScribers = Subscribers::findOrFail($id);
        $subScribers->name = $request->name;
        $subScribers->email = $request->email;
        $subScribers->update();
        $subScribers = Subscribers::all();
        return response()->json([
            'data' =>$subScribers,
            'code' =>200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subScribers = Subscribers::findOrFail($id);
        $subScribers->delete();
        $subScribers = Subscribers::all();
        return response()->json([
            'data' =>$subScribers,
            'code' =>200
        ]);

    }
}
