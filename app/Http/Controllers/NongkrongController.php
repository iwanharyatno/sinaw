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
     public function index(){
        $threads = ThreadDiscussion::with('user', 'replies')->orderBy('created_at', 'desc')->get();

        return view('nongkrong.index', compact('threads'));
    }

    public function create(){
        return view('nongkrong.create');
    }

    public function mine(){
        $user = User::find(Auth::user()->id);
        $threads = $user->threads()->with('replies')->get();
        return view('nongkrong.mine', compact('threads'));
    }

    public function reply($threadId){
        $thread = ThreadDiscussion::with('replies.user')->find($threadId);

        if (!$thread) {
            abort(404);
        }

        return view('nongkrong.reply', compact('thread'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        $data = $validator->validated();

        DB::transaction(function() use ($data) {
            $user = User::find(Auth::user()->id);

            $threadDiscussion = $user->threads()->create([
                'title' => $data['title'],
                'category' => $data['category']
            ]);

            $threadDiscussion->replies()->create([
                'content' => $data['content'],
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('nongkrong.index');
    }

    public function storeReply(Request $request, $threadId) {
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
}
