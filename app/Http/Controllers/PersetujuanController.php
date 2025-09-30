<?php

namespace App\Http\Controllers;

use App\Models\Persetujuan;
use App\Models\CatatanLembur;
use App\Models\User;
use App\Models\Upah;
use App\Http\Requests\StorePersetujuanRequest;
use App\Http\Requests\UpdatePersetujuanRequest;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PersetujuanController extends Controller
{
    /**
     * ini adalah trait yang digunakan untuk mengatur otorisasi
     */
    use AuthorizesRequests;

    /**
     * ini adalah properti untuk menyimpan instance dari FonnteService
     */
    protected $fonnteService;

    /**
     * construct di gunakan untuk menginisialisasi dependensi
     
     */
    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Persetujuan::class);

        $query = Persetujuan::with(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan', 'user']);

        // Filter untuk karyawan: hanya persetujuan yang terkait dengan catatan lemburnya sendiri
        if (Auth::user()->hasRole('Karyawan')) {
            $query->whereHas('catatanLembur.karyawan', function ($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $persetujuans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.persetujuan.index', compact('persetujuans'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Persetujuan $persetujuan)
    {
        $this->authorize('view', $persetujuan);

        $persetujuan->load(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan', 'user']);

        return view('dashboard.persetujuan.show', compact('persetujuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persetujuan $persetujuan)
    {
        $this->authorize('update', $persetujuan);

        $catatanLemburs = CatatanLembur::with(['karyawan.user', 'karyawan.departemen', 'karyawan.jabatan'])->get();
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Pimpinan', 'HRD']);
        })->get();
        $persetujuan->load(['catatanLembur.karyawan.user', 'catatanLembur.karyawan.departemen', 'catatanLembur.karyawan.jabatan', 'user']);

        return view('dashboard.persetujuan.edit', compact('persetujuan', 'catatanLemburs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersetujuanRequest $request, Persetujuan $persetujuan)
    {
        $this->authorize('update', $persetujuan);

        $persetujuan->update($request->validated());

        return redirect()->route('persetujuan.index')->with('success', 'Persetujuan berhasil diperbarui.');
    }

    /**
     * Update status of the specified resource.
     */
    public function updateStatus(Request $request, Persetujuan $persetujuan)
    {
        $this->authorize('update', $persetujuan);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $persetujuan->update(['status' => $request->status]);

        // Jika status disetujui, buat Upah jika belum ada
        if ($request->status === 'disetujui') {
            if (!$persetujuan->catatanLembur->upah) {
                Upah::create([
                    'catatan_lembur_id' => $persetujuan->catatan_lembur_id,
                ]);
            }
        }

        // Set user_id jika belum ada (untuk approver)
        if (!$persetujuan->user_id) {
            $persetujuan->update(['user_id' => Auth::id()]);
        }

        // Kirim notifikasi WhatsApp
        $karyawan = $persetujuan->catatanLembur->karyawan;
        $approver = Auth::user();
        $this->fonnteService->sendApprovalNotification($persetujuan, $karyawan, $approver, $request->status);
        return redirect()->route('persetujuan.index')->with('success', 'Status persetujuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persetujuan $persetujuan)
    {
        $this->authorize('delete', $persetujuan);

        $persetujuan->delete();

        return redirect()->route('persetujuan.index')->with('success', 'Persetujuan berhasil dihapus.');
    }
}
