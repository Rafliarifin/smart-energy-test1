<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Faq;

class ForumController extends Controller
{
    // Menampilkan semua topik forum
    public function index()
    {
    $posts = Post::with('user')->latest()->paginate(10);
    $faqs = Faq::all(); // <-- TAMBAHKAN BARIS INI untuk mengambil semua data FAQ

    // Kirim kedua variabel ('posts' dan 'faqs') ke view
    return view('forum.index', compact('posts', 'faqs'));
    }

    // Menampilkan halaman form untuk membuat topik baru
    public function create()
    {
        return view('forum.create');
    }

    // Menyimpan topik baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'Topik berhasil dibuat!');
    }

    // Menampilkan satu topik beserta balasannya
    public function show(Post $post)
    {
        // Memuat post dengan relasi user dan replies (serta user dari replies)
        $post->load('user', 'replies.user');
        return view('forum.show', compact('post'));
    }

    // Menyimpan balasan baru untuk sebuah topik
    public function storeReply(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|string']);

        $post->replies()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }
    public function edit(Post $post)
{
    // Gunakan Gate yang sudah kita buat untuk otorisasi
    Gate::authorize('update-post', $post);

    return view('forum.edit', compact('post'));
}

// Memperbarui data post di database
public function update(Request $request, Post $post)
{
    // Otorisasi sekali lagi sebelum update
    Gate::authorize('update-post', $post);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('forum.show', $post->id)->with('success', 'Topik berhasil diperbarui!');
}
public function destroy(Post $post)
{
    // Otorisasi menggunakan Gate
    Gate::authorize('delete-post', $post);

    $post->delete();

    return redirect()->route('forum.index')->with('success', 'Topik berhasil dihapus.');
}
}