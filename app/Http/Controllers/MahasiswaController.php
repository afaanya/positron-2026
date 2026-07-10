<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function edit()
    {
        $biodata = DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->first();

        return view('biodata-edit', compact('biodata'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|max:20',
        ]);

        DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->update([
                'no_wa' => $request->no_wa,
            ]);

        return redirect()->route('biodata')
            ->with('success', 'Nomor WhatsApp berhasil diperbarui.');
    }
}