<!-- Contoh Hot Toast Style Alerts (Minimal & Clean) -->

{{-- Toast Sukses Kecil --}}
<x-ui.sweet-alert type="success" title="✓" text="Data berhasil disimpan" size="small" toast="true"
    :show-on-load="true" />

{{-- Toast Error Minimal --}}
<x-ui.sweet-alert type="error" title="✕" text="Gagal menyimpan data" size="small" toast="true"
    :show-on-load="true" />

{{-- Toast Warning Clean --}}
<x-ui.sweet-alert type="warning" title="⚠" text="Periksa kembali data Anda" size="small" toast="true"
    :show-on-load="true" />

{{-- Toast Info Minimal --}}
<x-ui.sweet-alert type="info" title="ℹ" text="Informasi terbaru tersedia" size="small" toast="true"
    :show-on-load="true" />
