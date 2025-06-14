@extends('layouts.app')
@section('title', 'Tambah Data Referensi')
@section('content')
<div class="stat-card">
    <h3 class="chart-title">Form Tambah Data Referensi Baru</h3>
    <form action="{{ route('admin.data.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="metric_name">Nama Metrik (contoh: Konsumsi Listrik)</label>
            <input type="text" name="metric_name" id="metric_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="metric_value">Nilai Metrik (hanya angka)</label>
            <input type="number" step="0.01" name="metric_value" id="metric_value" class="form-control" required>
        </div>
         <div class="form-group">
            <label for="period_date">Tanggal Periode</label>
            <input type="date" name="period_date" id="period_date" class="form-control" required>
        </div>
         <div class="form-group">
            <label for="source">Sumber Data (contoh: BPS 2024)</label>
            <input type="text" name="source" id="source" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection