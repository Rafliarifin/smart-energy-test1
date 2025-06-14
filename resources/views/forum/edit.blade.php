@extends('layouts.app')

@section('title', 'Edit Topik')

@section('content')
<div class="calculator-form">
    <h2 style="margin-bottom: 2rem; color: #2c3e50;">Edit Topik Diskusi</h2>

    <form action="{{ route('forum.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Gunakan metode PUT untuk update --}}
        <div class="form-group">
            <label for="title">Judul Topik</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Isi Topik</label>
            <textarea id="content" name="content" class="form-control" rows="8" required>{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection