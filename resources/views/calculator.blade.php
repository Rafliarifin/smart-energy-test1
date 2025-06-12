@extends('layouts.app')

{{-- Mengatur judul unik untuk halaman ini --}}
@section('title', 'Kalkulator Energi')

{{-- Konten spesifik untuk Halaman Kalkulator Energi --}}
@section('content')

{{-- Fitur ini sesuai dengan kebutuhan fungsional "Kalkulator Energi Rumah Tangga" pada Tabel 3.1 di makalah --}}
<section id="calculator">
    <div class="calculator-form">
        <h2 style="margin-bottom: 2rem; color: #2c3e50;">Kalkulator Konsumsi Energi Rumah Tangga</h2>
        
        {{-- Bagian form untuk memilih dan menambah perangkat elektronik --}}
        <div class="form-group">
            <label>Tambah Perangkat Elektronik</label>
            <div class="form-row">
                <select class="form-control" id="applianceSelect">
                    <option value="">Pilih Perangkat</option>
                    <option value="ac" data-power="1000">AC (1000W)</option>
                    <option value="tv" data-power="150">TV LED (150W)</option>
                    <option value="kulkas" data-power="200">Kulkas (200W)</option>
                    <option value="lampu" data-power="15">Lampu LED (15W)</option>
                    <option value="kipas" data-power="75">Kipas Angin (75W)</option>
                    <option value="rice-cooker" data-power="400">Rice Cooker (400W)</option>
                    <option value="water-heater" data-power="2000">Water Heater (2000W)</option>
                </select>
                <button type="button" class="btn btn-secondary" onclick="addAppliance()">Tambah</button>
            </div>
        </div>

        {{-- Area ini akan diisi secara dinamis oleh JavaScript ketika pengguna menambah perangkat --}}
        <div id="appliancesList"></div>

        {{-- Tombol untuk memicu perhitungan konsumsi energi --}}
        <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="calculateEnergy()">Hitung Konsumsi Energi</button>
        </div>

        {{-- Area ini akan menampilkan hasil perhitungan dalam kWh dan Rupiah --}}
        <div id="calculationResult"></div>
        
        {{-- Area ini akan menampilkan rekomendasi penghematan energi setelah perhitungan --}}
        <div id="recommendations"></div>
    </div>
</section>

@endsection