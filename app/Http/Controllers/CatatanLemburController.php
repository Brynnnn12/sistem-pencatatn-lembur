<?php

namespace App\Http\Controllers;

use App\Models\CatatanLembur;
use App\Models\Karyawan;
use App\Models\Upah;
use App\Models\Persetujuan;
use App\Http\Requests\StoreCatatanLemburRequest;
use App\Http\Requests\UpdateCatatanLemburRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CatatanLemburController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', CatatanLembur::class);

        $query = CatatanLembur::with(['karyawan.user', 'karyawan.departemen', 'karyawan.jabatan']);

        // Jika user adalah Karyawan, hanya tampilkan catatan lemburnya sendiri
        if (Auth::user()->hasRole('Karyawan')) {
            $query->whereHas('karyawan', function ($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $catatanLemburs = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('dashboard.catatan-lembur.index', compact('catatanLemburs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', CatatanLembur::class);

        $karyawans = collect();
        if (!Auth::user()->hasRole('Karyawan')) {
            $karyawans = Karyawan::with(['user', 'departemen', 'jabatan'])->get();
        }

        return view('dashboard.catatan-lembur.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatatanLemburRequest $request)
    {
        $this->authorize('create', CatatanLembur::class);

        $data = $request->validated();
        if (Auth::user()->hasRole('Karyawan')) {
            $data['karyawan_id'] = Auth::user()->karyawan->id;
        }

        $catatanLembur = CatatanLembur::create($data);

        // Auto create Persetujuan dengan status pending
        Persetujuan::create([
            'catatan_lembur_id' => $catatanLembur->id,
            'status' => 'pending',
        ]);

        return redirect()->route('persetujuan.index')->with('success', 'Catatan lembur berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CatatanLembur $catatanLembur)
    {
        $this->authorize('view', $catatanLembur);

        $catatanLembur->load(['karyawan.user', 'karyawan.departemen', 'karyawan.jabatan']);

        return view('dashboard.catatan-lembur.show', compact('catatanLembur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatatanLembur $catatanLembur)
    {
        $this->authorize('update', $catatanLembur);

        $karyawans = collect();
        if (!Auth::user()->hasRole('Karyawan')) {
            $karyawans = Karyawan::with(['user', 'departemen', 'jabatan'])->get();
        }
        $catatanLembur->load(['karyawan.user', 'karyawan.departemen', 'karyawan.jabatan']);

        return view('dashboard.catatan-lembur.edit', compact('catatanLembur', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatatanLemburRequest $request, CatatanLembur $catatanLembur)
    {
        $this->authorize('update', $catatanLembur);

        $data = $request->validated();
        if (Auth::user()->hasRole('Karyawan')) {
            $data['karyawan_id'] = Auth::user()->karyawan->id;
        }

        $catatanLembur->update($data);

        return redirect()->route('persetujuan.index')->with('success', 'Catatan lembur berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatatanLembur $catatanLembur)
    {
        $this->authorize('delete', $catatanLembur);

        $catatanLembur->delete();

        return redirect()->route('catatan-lembur.index')->with('success', 'Catatan lembur berhasil dihapus.');
    }
}
