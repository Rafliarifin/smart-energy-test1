@extends('layouts.app')
@section('title', 'Kalkulator Energi')
@section('content')
<section id="calculator">
    <div class="calculator-form">
        <h2 style="margin-bottom: 2rem; color: #2c3e50;">Kalkulator Konsumsi Energi Rumah Tangga</h2>

        <div class="form-group">
            <label>Tambah Perangkat Elektronik</label>
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
                <select class="form-control" id="applianceSelect">
                    <option value="">Pilih Perangkat (Daya Rata-rata)</option>
                    <option value="ac" data-power="900">AC 1 PK (900W)</option>
                    <option value="tv" data-power="100">TV LED 32" (100W)</option>
                    <option value="kulkas" data-power="200">Kulkas 2 Pintu (200W)</option>
                    <option value="mesin-cuci" data-power="350">Mesin Cuci 1 Tabung (350W)</option>
                    <option value="lampu" data-power="15">Lampu LED (15W)</option>
                    <option value="kipas" data-power="75">Kipas Angin (75W)</option>
                    <option value="rice-cooker" data-power="400">Rice Cooker (400W)</option>
                    <option value="pompa-air" data-power="250">Pompa Air (250W)</option>
                </select>
                <button type="button" class="btn" style="background-color: #6c757d; color: white;" onclick="addAppliance()">Tambah</button>
            </div>
        </div>

        <div id="appliancesList"></div>

        <div class="form-group" style="margin-top: 2rem;">
            <button type="button" class="btn btn-primary" onclick="calculateEnergy()">Hitung Estimasi Konsumsi</button>
        </div>

        <div id="calculationResult"></div>
        <div id="recommendations"></div>
    </div>

    {{-- KOTAK PENJELASAN BARU --}}
    <div class="explanation-box">
        <h4>Bagaimana Kalkulator Ini Bekerja?</h4>
        <p>Kalkulator ini memberikan **estimasi** konsumsi energi dan biaya bulanan berdasarkan data yang Anda masukkan. Berikut adalah sumber dan cara perhitungannya:</p>

        <ul>
            <li><strong>Daya Perangkat (Watt):</strong> Nilai daya yang tertera adalah nilai rata-rata umum. Untuk hasil yang paling akurat, silakan periksa label spesifikasi pada perangkat Anda.</li>
            <li><strong>Harga per kWh:</strong> Kami menggunakan asumsi tarif listrik PLN untuk golongan rumah tangga R-1/TR 1.300-2.200 VA yaitu **Rp 1.444,70 per kWh**. Tarif ini dapat berubah sesuai kebijakan pemerintah.</li>
        </ul>

        <h4 style="margin-top: 1.5rem;">Rumus yang Digunakan</h4>
        <p><strong>1. Menghitung Konsumsi Energi (kWh):</strong></p>
        <p style="font-family: monospace; background: #e9ecef; padding: 0.75rem; border-radius: 6px;">(Daya Watt × Jam Pakai) / 1000</p>

        <p style="margin-top: 1rem;"><strong>2. Menghitung Estimasi Biaya Bulanan:</strong></p>
        <p style="font-family: monospace; background: #e9ecef; padding: 0.75rem; border-radius: 6px;">Total kWh Bulanan × Rp 1.444,70</p>
    </div>
</section>
@endsection