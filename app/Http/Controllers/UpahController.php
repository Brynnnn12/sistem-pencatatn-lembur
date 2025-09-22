<?php

namespace App\Http\Controllers;

use App\Models\Upah;
use App\Models\CatatanLembur;
use App\Http\Requests\StoreUpahRequest;
use App\Http\Requests\UpdateUpahRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpahController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Upah::class);

        $upahs = Upah::with(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.upah.index', compact('upahs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Upah $upah)
    {
        $this->authorize('view', $upah);

        $upah->load(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan']);

        return view('dashboard.upah.show', compact('upah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upah $upah)
    {
        $this->authorize('update', $upah);

        // Hanya tampilkan catatan lembur yang belum memiliki upah atau yang sudah dipilih
        $catatanLemburs = CatatanLembur::with(['karyawan.user', 'karyawan.departemen', 'karyawan.jabatan'])
            ->whereDoesntHave('upah')
            ->orWhere('id', $upah->catatan_lembur_id)
            ->get();

        $upah->load(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan']);

        return view('dashboard.upah.edit', compact('upah', 'catatanLemburs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUpahRequest $request, Upah $upah)
    {
        $this->authorize('update', $upah);

        $upah->update($request->validated());

        return redirect()->route('upah.index')->with('success', 'Upah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upah $upah)
    {
        $this->authorize('delete', $upah);

        $upah->delete();

        return redirect()->route('upah.index')->with('success', 'Upah berhasil dihapus.');
    }
}
