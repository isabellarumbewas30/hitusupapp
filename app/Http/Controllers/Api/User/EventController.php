<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::all();

        return response()->json([
            'message' => 'Data berhasil ditampilkan',
            'data' => $event,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $event,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }

  
}
