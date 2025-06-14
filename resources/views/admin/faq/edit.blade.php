@extends('layouts.app')
@section('title', 'Edit FAQ')
@section('content')
<div class="stat-card">
    <h3 class="chart-title">Form Edit FAQ</h3>
    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Pertanyaan</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}" required>
        </div>
        <div class="form-group">
            <label for="answer">Jawaban</label>
            <textarea name="answer" id="answer" rows="5" class="form-control" required>{{ $faq->answer }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection