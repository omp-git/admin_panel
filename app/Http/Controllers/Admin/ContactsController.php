<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Notifications\ContactReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ContactsController extends VoyagerBaseController
{
    public function show(Request $request, $id)
    {
        // update message as read when viewed
        // via controller
        $contact = Contact::find($id);
        if($this->authorize('read', $contact))
            if((! auth()->user()->role->name == 'admin')) {
                $contact->update(['read' => false]);
            }

        return parent::show($request, $id);
    }
    public function reply(Request $request, $id)
    {
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;
        $contact = Contact::find($id);
        // Check permission
        $this->authorize('edit', $contact);
        // Compatibility with Model binding.
        $slug = $this->getSlug($request);

        $dataType = \Voyager::model('DataType')->where('slug', '=', 'contacts')->first();

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

//        dd($request->all());
        $contact->reply = $request->reply;
        if($request->read)
            $contact->read = true;
        else
            $contact->read = false;
        $contact->save();

        // send mail to contact
        if($request->send)
            auth()->user()->notify(new ContactReply($contact));

        event(new BreadDataUpdated($dataType, $contact));

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);

    }

    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = \Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }
}
