@if (session()->has('success'))
    <x-ui.sweet-alert type="success" title="Berhasil" text="{{ session('success') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('error'))
    <x-ui.sweet-alert type="error" title="Gagal" text="{{ session('error') }}" :show-on-load="true" timer="4000"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('warning'))
    <x-ui.sweet-alert type="warning" title="Peringatan" text="{{ session('warning') }}" :show-on-load="true" timer="3500"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('info'))
    <x-ui.sweet-alert type="info" title="Informasi" text="{{ session('info') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" size="small" />
@endif

@if (($errors ?? collect())->any())
    @php
        $errorList = implode('<br>', ($errors ?? collect())->all());
    @endphp
    <x-ui.sweet-alert type="error" title="Kesalahan" text="{{ $errorList }}" :show-on-load="true" timer="5000"
        position="top-end" :toast="true" size="small" />
@endif
