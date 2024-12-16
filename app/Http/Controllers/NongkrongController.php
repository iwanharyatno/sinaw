<?php

namespace App\Http\Controllers;

use App\Models\ThreadDiscussion;
use App\Models\ThreadReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\AtMost;

class NongkrongController extends Controller
{
    public function index()
    {
        $category = request('category');
        $threads = ThreadDiscussion::with('user', 'replies', 'likes')->orderBy('created_at', 'desc')->paginate(2);

        if ($category) {
            $threads = ThreadDiscussion::with('user', 'replies')->where('category', $category)->orderBy('created_at', 'desc')->paginate(2);
        }

        return view('nongkrong.index', compact('threads'));
    }

    public function create()
    {
        return view('nongkrong.create');
    }

    public function mine()
    {
        $user = User::find(Auth::user()->id);
        $threads = $user->threads()->with('replies')->orderBy('created_at', 'desc')->paginate(5);
        return view('nongkrong.mine', compact('threads', 'user'));
    }



    public function reply($threadId)
    {
        $thread = ThreadDiscussion::with('replies.user')->find($threadId);

        if (!$thread) {
            abort(404);
        }

        return view('nongkrong.reply', compact('thread'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $data = $validator->validated();

        $user = User::find(Auth::user()->id);

        $threadDiscussion = $user->threads()->create([
            'title' => $data['title'],
            'category' => $data['category']
        ]);

        $threadDiscussion->replies()->create([
            'content' => $data['content'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('nongkrong.index');
    }

    public function storeReply(Request $request, $threadId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $data = $validator->validated();

        $thread = ThreadDiscussion::find($threadId);
        $thread->replies()->create([
            'content' => $data['content'],
            'user_id' => Auth::user()->id
        ]);

        return back();
    }

    public function updateLike($id) {
        $userId = Auth::user()->id;
        $thread = ThreadDiscussion::find($id);
        $liked = $thread->likes()->where('user_id', $userId)->first();

        if ($liked) {
            $thread->likes()->detach($userId);
            $thread->likes_count -= 1;
        } else {
            $thread->likes()->attach($userId);
            $thread->likes_count += 1;
        }

        $thread->save();

        return response()->json([
            'success' => true 
        ]);
    }
}
