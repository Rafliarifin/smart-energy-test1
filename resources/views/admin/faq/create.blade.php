@extends('layouts.app')
@section('title', 'Tambah FAQ Baru')
@section('content')
<div class="stat-card">
    <h3 class="chart-title">Form Tambah FAQ Baru</h3>
    <form action="{{ route('admin.faq.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Pertanyaan</label>
            <input type="text" name="question" id="question" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="answer">Jawaban</label>
            <textarea name="answer" id="answer" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection