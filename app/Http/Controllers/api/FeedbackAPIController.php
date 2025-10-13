<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\AppMail;
use App\Models\Feedback;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class FeedbackAPIController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();
        // abort_if($user->user_role != 'admin', 403);

        // $data = Feedback::query();

        // if (request()->has('datatable')) {
        //     $dtable = DataTables::of($data)
        //         ->addIndexColumn()
        //         ->rawColumns(['contact'])
        //         ->addColumn('contact', function ($data) {
        //             $s = $data->telephone . "<br><small class='text-muted mt-1'>$data->email</small>";
        //             return $s;
        //         })->editColumn('date', function ($data) {
        //             return $data->date?->format('d-m-Y H:i:s');
        //         });

        //     return $dtable->make(true);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:128',
            'email' => 'sometimes|email|max:128',
            'phone' => 'sometimes|min:10|numeric|regex:/[0-9]{10}/|',
            'subject' => 'required|min:6,max:255',
            'message' => 'required|min:6|max:1000',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', ['errors_msg' => $validator->errors()->all()]);
        }

        if (empty(request()->telephone) and empty(request()->email)) {
            return $this->error('Validation error', ['errors_msg' => ["Vous devez renseigner soit un email soit un numéro de téléphone."]]);
        }
        $data = $validator->validate();
        $data['date'] = nnow();

        DB::beginTransaction();
        Feedback::create($data);
        try {
            $d = implode('</br> ## ', $data);
            $m['msg'] = $d;
            $m['subject'] = "Feedback";
            Mail::to('go@gooomart.com')->send(new AppMail((object)$m));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error("Un petit problème est survenu, veuillez réessayer SVP.");
        }
        return $this->success("Merci de nous avoir laisser votre message! nous le prenons avec beaucoup de considération et vous serez contacter si nécessaire. Merci.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
