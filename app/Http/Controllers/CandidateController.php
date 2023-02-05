<?php

namespace App\Http\Controllers;

use App\Http\Forms\CreateCandidateForm;
use App\Http\Requests\CandidateRequest;

class CandidateController
{
    public function create()
    {

    }

    public function store(CandidateRequest $request, CreateCandidateForm $form)
    {
        $form->create($request->validationData());
    }
}
