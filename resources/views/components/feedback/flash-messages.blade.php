@if (session()->has('success'))
    <x-ui.sweet-alert type="success" title="sukses" text="{{ session('success') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('error'))
    <x-ui.sweet-alert type="error" title="gagal" text="{{ session('error') }}" :show-on-load="true" timer="4000"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('warning'))
    <x-ui.sweet-alert type="warning" title="⚠" text="{{ session('warning') }}" :show-on-load="true" timer="3500"
        position="top-end" :toast="true" size="small" />
@endif

@if (session()->has('info'))
    <x-ui.sweet-alert type="info" title="info" text="{{ session('info') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" size="small" />
@endif

@if (($errors ?? collect())->any())
    @php
        $errorList = implode('<br>', ($errors ?? collect())->all());
    @endphp
    <x-ui.sweet-alert type="error" title="✕" text="{{ $errorList }}" :show-on-load="true" timer="5000"
        position="top-end" :toast="true" size="small" />
@endif
