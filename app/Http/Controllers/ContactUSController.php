<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactUSRequest;
use App\Http\Requests\UpdateContactUSRequest;
use App\Mail\replyMessage;
use App\Models\ContactUS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.contact-us.index')->with('contacts', ContactUS::OrderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactUSRequest $request)
    {
        if ($request->validated()) {
            $contact = new ContactUS([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            if ($contact->save()) {
                return back()->with('success', 'Thanks your message has been sent successfully');
            }
            return back()->with('error', 'An error has occured');
        }
    }

    /**
     * Display the specified resource.
     */
    public function send(Request $request, string $id)
    {
        //validate resquests
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        // send the email now
        if (Mail::to($request->email)->send(new replyMessage($request->all()))) {
            if ($message = ContactUS::find($id)) {
                if ($message->update(['status' => 1])) {
                    return redirect()->route('admin.contact-us')->with('success', 'Message sent successfully.');
                }
            }
        }
        return back()->with('error', 'an error has occured');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function reply(string $id)
    {
        if ($message = ContactUS::find($id)) {
            if ($message->status == 1) {
                return back()->with('error', 'message already been replied');
            }
            return view('admin.contact-us.reply')->with('message', $message);
        }
        return back()->with('error', 'An error has occured');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactUSRequest $request, ContactUS $contactUS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        if ($contact = ContactUS::find($id)) {
            if ($contact->update(['status' => 2])) {
                return back()->with('success', 'Message deleted successfully');
            }
        }
        return back()->with('error', 'error has occured');
    }

    public function read(string $id)
    {
        if ($contact = ContactUS::find($id)) {
            if ($contact->update(['status' => 1])) {
                return back()->with('success', 'Message marked as read successfully');
            }
        }
        return back()->with('error', 'error has occured');
    }
    public function unread(string $id)
    {
        if ($contact = ContactUS::find($id)) {
            if ($contact->update(['status' => 0])) {
                return back()->with('success', 'Message marked as unread successfully');
            }
        }
        return back()->with('error', 'error has occured');
    }

    public function deleteAll()
    {
        $contacts = ContactUS::where('status', '!=', 2)->get();
        foreach ($contacts as $contact) {
            $contact->update(['status' => 2]);
        }
        return back()->with('success', 'All messages deleted successfully');
    }
    public function readAll()
    {
        $contacts = ContactUS::where('status', 0)->get();
        foreach ($contacts as $contact) {
            $contact->update(['status' => 1]);
        }
        return back()->with('success', 'All messages marked as read successfully');
    }
    public function unreadAll()
    {
        $contacts = ContactUS::where('status', 1)->get();
        foreach ($contacts as $contact) {
            $contact->update(['status' => 0]);
        }
        return back()->with('success', 'All messages marked as unread successfully');
    }

    public function deleteTrash(string $id)
    {
        if ($contact = ContactUS::find($id)) {
            if ($contact->delete()) {
                return back()->with('success', 'message Deleted successfully');
            }
        }
        return back()->with('error', 'an error occured');
    }

    public function restoreMessage(string $id)
    {
        if ($contact = ContactUS::find($id)) {
            if ($contact->update(['status' => 1])) {
                return back()->with('success', 'message restored successfully');
            }
        }
        return back()->with('error', 'an error occured');
    }
    public function emptyTrash()
    {
        $contacts = ContactUS::where('status', 2)->get();
        foreach ($contacts as $contact) {
            $contact->delete();
        }
        return back()->with('success', 'Trash has been emptied successfully');
    }

    public function restoreAll()
    {
        $trashes = ContactUS::where('status', 2)->get();
        foreach ($trashes as $trash) {
            $trash->update(['status' => 1]);
        }
        return back()->with('success', 'Messages restored successfully');
    }
}
