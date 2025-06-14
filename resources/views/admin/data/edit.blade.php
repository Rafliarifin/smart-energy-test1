@extends('layouts.app')
@section('title', 'Edit Data Referensi')
@section('content')
<div class="stat-card">
    <h3 class="chart-title">Form Edit Data Referensi</h3>
    {{-- PASTIKAN BARIS DI BAWAH INI SUDAH BENAR, DENGAN PARAMETER KEDUA --}}
    <form action="{{ route('admin.data.update', $dashboardData->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="metric_name">Nama Metrik</label>
            <input type="text" name="metric_name" id="metric_name" class="form-control" value="{{ old('metric_name', $dashboardData->metric_name) }}" required>
        </div>
        <div class="form-group">
            <label for="metric_value">Nilai Metrik</label>
            <input type="number" step="0.01" name="metric_value" id="metric_value" class="form-control" value="{{ old('metric_value', $dashboardData->metric_value) }}" required>
        </div>
         <div class="form-group">
            <label for="period_date">Tanggal Periode</label>
            <input type="date" name="period_date" id="period_date" class="form-control" value="{{ $dashboardData->period_date->format('Y-m-d') }}" required>
            {{-- Menggunakan format Y-m-d agar kompatibel dengan input type="date" --}}
        </div>
         <div class="form-group">
            <label for="source">Sumber Data</label>
            <input type="text" name="source" id="source" class="form-control" value="{{ old('source', $dashboardData->source) }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection