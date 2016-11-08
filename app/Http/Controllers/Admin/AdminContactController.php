<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;
use App\ContactReply;
use Auth;
use Log;
use Input;
use Mail;

class AdminContactController extends AdminBase
{

    public function index(Contact $contact)
    {
        $messages = $contact->paginate(10);
        $page = 'contact';
        return view('admin.contact.index', compact('messages', 'page'));
    }

    public function read(Contact $contact, ContactReply $cr, $id)
    {
        $item = $contact->whereId($id)->first();
        $replies = $cr->where('contact_id', '=', $id)->get();

        return view('admin.contact.show', compact('item', 'replies'));
    }

    public function replyToMail(Contact $contact, ContactReply $cr, $id)
    {
        $item = $contact->whereId($id)->first();

        $cr->create([
            'contact_id' => $id,
            'author_id' => Auth::user()->id, 
            'message' => Input::get('mesaj')
        ]);

        $mail_data = [
            'subject' => Input::get('subject'),
            'mesaj' => Input::get('mesaj'),
            'name' => $item->name,
            'email' => $item->email
        ];
            
        Mail::send('emails.contact_admin', ['message' => Input::get('mesaj'), 'subject' => Input::get('subject'), 'mail_data' => $mail_data], function($message) use ($mail_data)
        {
            $message->to($mail_data['email'], $mail_data['name'])->subject($mail_data['subject']);
        });
        //redirect with success
        return Redirect::route('admin.contact.read')->with('flash_notice', 'Email sent!');
    }

    public function markRead(Contact $contact, $id)
    {
        if($contact->whereId($id)->first()->status){
            $contact->whereId($id)->update(['status' => 0]);
        }else{
            $contact->whereId($id)->update(['status' => 1]);
        }

    }

    public function destroy(Contact $contact, $id)
    {
        //mark as deleted all replies
        $contact->whereId($id)->update(['deleted' => 1]);
    }
}
