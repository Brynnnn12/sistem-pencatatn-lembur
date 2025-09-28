<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KaryawanController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Karyawan::class);
        $karyawans = Karyawan::with(['user', 'departemen', 'jabatan'])->paginate(10);
        return view('dashboard.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Karyawan::class);
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('dashboard.karyawan.create', compact('departemens', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreKaryawanRequest $request
     */
    public function store(StoreKaryawanRequest $request)
    {
        $this->authorize('create', Karyawan::class);

        //buat user terlebih dahulu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        // Berikan peran karyawan kepada user
        $user->assignRole('Karyawan');

        // Buat karyawan
        Karyawan::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
        ]);

        //lempar data 
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        $this->authorize('view', $karyawan);
        $karyawan->load(['user', 'departemen', 'jabatan', 'catatanLemburs']);

        //ini untuk menghitung statistik
        $totalLembur = $karyawan->catatanLemburs()->count();
        $totalDisetujui = $karyawan->catatanLemburs()->whereHas('persetujuan', function ($q) {
            $q->where('status', 'disetujui');
        })->count();
        $totalUpah = $karyawan->catatanLemburs()->join('upahs', 'catatan_lemburs.id', '=', 'upahs.catatan_lembur_id')->sum('upahs.jumlah');

        return view('dashboard.karyawan.show', compact('karyawan', 'totalLembur', 'totalDisetujui', 'totalUpah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        $this->authorize('update', $karyawan);
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        $karyawan->load('user');
        return view('dashboard.karyawan.edit', compact('karyawan', 'departemens', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryawanRequest $request, Karyawan $karyawan)
    {
        $this->authorize('update', $karyawan);

        // Update user
        $karyawan->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $karyawan->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update karyawan
        $karyawan->update([
            'nama' => $request->nama,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $this->authorize('delete', $karyawan);

        // Delete karyawan first
        $karyawan->delete();

        // Delete user
        $karyawan->user->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
