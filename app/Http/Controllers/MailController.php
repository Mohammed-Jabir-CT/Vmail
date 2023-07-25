<?php

namespace App\Http\Controllers;

use App\Models\Rmail;
use App\Models\Smail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function composeView($email){
        return view('compose',compact('email'));
    }

    public function compose(Request $request,$email){
        $send = new Smail();
        $receive = new Rmail();
        $send->sender = $email;
        $send->receiver = $request->to;
        $send->mail = $request->mail;

        $receive->sender = $email;
        $receive->receiver = $request->to;
        $receive->mail = $request->mail;

        $saved1 = $send->save();
        $saved2 = $receive->save();

        if($saved1 && $saved2){
            return view('home');
        }
    }

    public function sent($email){
        $sent = Smail::where('sender','=',$email)->get();
        return view('sent',compact('sent'));
    }

    public function received($email){
        $received = Rmail::where('receiver','=',$email)->get();
        return view('received',compact('received'));
    }

    public function moveTrashR($email, $id){
        Rmail::where('receiver','=',$email)->where('id','=',$id)->update([
            'flag' => 0
        ]);
    }

    public function moveTrashS($email, $id){
        Smail::where('sender','=',$email)->where('id','=',$id)->update([
            'flag' => 0
        ]);
    }

    public function trash($email){
        $sentTrash = Smail::where('sender','=',$email)->where('flag','=',0)->get();
        $receivedTrash = Rmail::where('receiver','=',$email)->where('flag','=',0)->get();
        return view('trash',compact('sentTrash','receivedTrash'));
    }
}
