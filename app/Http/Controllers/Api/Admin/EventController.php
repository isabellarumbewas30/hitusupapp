<?php

namespace App\Http\Controllers\Api\Admin;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role == 'admin'){
            $request->validate([
                'nama' => 'required',
                'tanggal' => 'required',
                'tempat' => 'required',
                'harga' => 'required',
                'deskripsi_event' => 'required',
                'poster' => 'required'
            ]);

            $event = Event::create([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'tempat' => $request->tempat,
                'harga' => $request->harga,
                'deskripsi_event' => $request->deskripsi_event,
                'poster' => $request->poster,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Event berhasil ditambah',
                'data' => $event
            ], 200);
        } else  {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda perlu akses untuk menambahkan event',
            ], 401);
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
        $user = auth()->user();
        if ($user->role == 'admin'){
        $event = Event::find($id);
        return $event;
        } else {
            return response()->json([
                'message' => 'Event tidak ditemukan'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {

          $event = Event::find($id);
          
          $event->update([
              'nama' => $request->nama,
              'tanggal' => $request->tanggal,
              'tempat' => $request->tempat,
              'harga' => $request->harga,
              'deskripsi_event' => $request->deskripsi_event,
          ]);

          return response()->json([
              'status' => 'success',
              'message' => 'Event berhasil diubah',
              'data' => $event
          ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk mengubah event'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if ($user->role == 'admin'){
            $event = Event::find($id);

            $event->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menghapus event'
            ], 401);
        }
    }
}
