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
        $totalPemasukan = Kas::pemasukan()->sum('jumlah');
        $totalPengeluaran = Kas::pengeluaran()->sum('jumlah');

        return view('admin.keuangan.index', compact('transaksi', 'saldo', 'totalPemasukan', 'totalPengeluaran'));
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
            'pemasukan' => $request->jumlah,
            'pengeluaran' => 0,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Pemasukan berhasil ditambahkan!');
    }

    public function tambahPengeluaran(Request $request)
    {
        $saldo = Kas::sum('pemasukan') - Kas::sum('pengeluaran');

        $request->validate([
            'jumlah' => "required|numeric|min:1000|max:$saldo",
            'keterangan' => 'required|string|max:255'
        ]);

        Kas::create([
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'pemasukan' => 0,
            'pengeluaran' => $request->jumlah,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Pengeluaran berhasil dicatat!');
    }

    public function laporan()
    {
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $saldo = $pemasukan - $pengeluaran;
        $transaksi = Kas::latest()->get();

        return view('admin.keuangan.laporan', compact('pemasukan', 'pengeluaran', 'saldo', 'transaksi'));
    }
}
