<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private $data = array();

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showchat()
    {
        $currentuser = Auth::user()->id;
        $users = User::select('*')->where('id','<>',$currentuser)->get();
        if(!empty($users)){
            $this->data['users'] = $users;
        }
       return view('chat')->with($this->data);
    }

    public function getmessages(Request $request){
        $currentuser = Auth::user()->id;
        $user_id = $request->userid;
        $selectMessages = Chat::select('*')
            ->leftJoin('users', function ($join) use($user_id) {
                $join->on('chats.from_user', '=', 'users.id');
                    })
                   ->where('chats.to_user','=',$user_id)
                    ->where('chats.from_user','=',Auth::id())
                    ->orWhere('chats.to_user','=',Auth::id())
                    ->where('chats.from_user', '=', $user_id)
                     ->orderBy('chats.created_at', 'asc')
            ->get();
        if($selectMessages){
            return response(['messages'=>$selectMessages]);
        }
    }

    public function sendmessage(Request $request)
    {
        $currentuser = Auth::user()->id;
       $insertdata =  Chat::create([
            'from_user'=>$currentuser,
            'to_user'=>$request->userid,
            'content'=>$request->contents,
            'readed'=>1
        ]);

        if($insertdata){
            return response(['data'=>true]);
        }
    }

    public function getnotreadmessages(Request $request)
    {
        $current_user_id = Auth::user()->id;
        $user_id  = $request->userid;
        $getmessages = Chat::select('chats.id','chats.content','chats.from_user','chats.to_user','chats.readed','users.name')
                                ->leftJoin('users','users.id','=','chats.from_user')
                                ->where('from_user',$user_id)
                                ->where('to_user',$current_user_id)
                                ->where('readed',1)
                                ->get();

        if(!empty($getmessages)){
            foreach ($getmessages as $key=>$value){
                $update = Chat::where('id', $value->id)
                    ->update(['readed' => 0]);
            }

        }
            return response(['message'=>$getmessages]);

    }
}
