<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Transaksi;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class OrderTiket extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin'){
        $order = Transaksi::all();
        return $order;
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Anda perlu akses untuk melihat daftar tiket yang telah dipesan',
        ], 401);
    }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $event = Event::find($request->events_id);

        if ($user->role == 'user'){

            $order = Transaksi::create([
                'event_id' => $request->events_id,
                'user_id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'telphone' => $request->telphone,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $request->jumlah_tiket * $event->harga,
                'status' => 'pending',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Order berhasil ditambahkan',
                'data' => $order,
            ], 200);  
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Anda bukan user',
                'data' => $order,
            ], 401);  

        }

        } 

        public function update(Request $request, $id)
        {
            $user = auth()->user();
            $event = Event::find($id);

        if ($user->role == 'user') {
          
          $event->update([
            'event_id' => $request->events_id,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telphone' => $request->telphone,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $request->jumlah_tiket * $event->harga,
            'status' => 'pending',
          ]);

          return response()->json([
              'status' => 'success',
              'message' => 'Data transaksi berhasil diubah',
              'data' => $event
          ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk mengubah transaksi'
            ], 401);
        }
        }

    }
