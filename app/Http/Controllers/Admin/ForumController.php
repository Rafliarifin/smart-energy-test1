<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post; // <-- Gunakan model Post
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Menampilkan semua postingan untuk moderasi.
     */
    public function index()
    {
        // Ambil semua post dengan informasi pembuatnya, urutkan dari yang terbaru
        $posts = Post::with('user')->latest()->paginate(15);
        
        return view('admin.forum.index', compact('posts'));
    }

    /**
     * Menghapus sebuah postingan.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.forum.index')->with('success', 'Postingan berhasil dihapus.');
    }
}