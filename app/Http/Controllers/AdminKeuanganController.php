<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class AdminKeuanganController extends Controller
{
    public function index()
    {
        $transaksi = Kas::latest()->paginate(10);
        $saldo = Kas::saldo();
        
        return view('admin.keuangan.index', compact('transaksi', 'saldo'));
    }

    public function tambahPemasukan(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1000',
            'keterangan' => 'required|string|max:255'
        ]);

        Kas::create([
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'jenis' => 'masuk'
        ]);

        return back()->with('success', 'Pemasukan berhasil ditambahkan!');
    }

    public function tambahPengeluaran(Request $request)
    {
        $saldo = Kas::saldo();
        
        $request->validate([
            'jumlah' => "required|numeric|min:1000|max:$saldo",
            'keterangan' => 'required|string|max:255'
        ]);

        Kas::create([
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'jenis' => 'keluar'
        ]);

        return back()->with('success', 'Pengeluaran berhasil dicatat!');
    }

    public function laporan()
    {
        $pemasukan = Kas::pemasukan()->sum('jumlah');
        $pengeluaran = Kas::pengeluaran()->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;
        $transaksi = Kas::latest()->get();

        return view('admin.keuangan.laporan', compact('pemasukan', 'pengeluaran', 'saldo', 'transaksi'));
    }
}