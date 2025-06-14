@extends('layouts.app')

@section('title', 'Buat Topik Baru')

@section('content')
<div class="calculator-form"> <h2 style="margin-bottom: 2rem; color: #2c3e50;">Buat Topik Diskusi Baru</h2>

    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Judul Topik</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Isi Topik</label>
            <textarea id="content" name="content" class="form-control" rows="8" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Topik</button>
    </form>
</div>
@endsection