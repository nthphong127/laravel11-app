<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // 👈 thêm cái này

class NoteController extends Controller
{
    use AuthorizesRequests; // 👈 thêm trait này

    public function index()
{
    $note = Auth::user()->notes()->first(); // lấy note đầu tiên của user
    return view('notes.index', compact('note'));
}

public function store(Request $request)
{
    $request->validate([
        'content' => 'nullable|string',
    ]);

    $note = Auth::user()->notes()->updateOrCreate(
        ['user_id' => Auth::id()], // tìm theo user_id
        ['content' => $request->input('content')] // 👈 dùng input()
    );

    return response()->json($note);
}

}
