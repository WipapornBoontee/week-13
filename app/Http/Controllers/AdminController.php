<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Blog;

class AdminController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function blog(Request $request)
    {
        $search = $request->input('search');
        
        $query = DB::table('blogs');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate(10)->withQueryString();
        
        return view('blogs', compact('blogs', 'search'));
    }

    public function create()
    {
        return view('form_add_blogs');
    }

    public function view($id)
    {
        $blog = Blog::findOrFail($id);
        return view('form_view_blogs', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|boolean',
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('blogs')->with('success', 'สร้างบทความสำเร็จแล้ว!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('form_edit_blogs', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|boolean',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('blogs')->with('success', 'อัปเดตบทความสำเร็จแล้ว!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs')->with('success', 'ลบบทความเรียบร้อยแล้ว!');
    }
}
