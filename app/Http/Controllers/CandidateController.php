<?php

namespace App\Http\Controllers;

use App\Http\Forms\CreateCandidateForm;
use App\Http\Requests\CandidateRequest;

class CandidateController
{
    public function create()
    {
        return view('welcome');
    }

    public function store(CandidateRequest $request, CreateCandidateForm $form)
    {
        $candidate = $form->create($request->validationData());

        return response()->json($candidate);
    }
}
