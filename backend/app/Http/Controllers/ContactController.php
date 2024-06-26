<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contacts(){
        $contacts = Contact::all();
        return response()->json(
            [
                'contacts' => $contacts,
                'message' => 'Contacts',
                'code' => 200
            ]
            );
    }

    public function getContact($id){
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    public function saveContact(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_on = $request->contact_on;
        $contact->save();
        return response()->json([
            'message' => 'Contact created Sucessfully',
            'code' => 200
        ]);
    }

    public function deleteContact($id){
        $contact = Contact::find($id);
        if($contact){
            $contact->delete();
            return response()->json([
                'message' => 'Contact deleted sucessfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Contact with id:$id does not exist"
            ]);
        }
    }

    public function updateContact($id, Request $request){
        $contact = Contact::where('id', $id)->first();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_on = $request->contact_on;
        $contact->save();
        return response()->json([
            'message' => 'Contact updated Sucessfully',
            'code' => 200
        ]);
    }
}
