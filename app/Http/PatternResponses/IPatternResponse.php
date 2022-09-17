<?php

namespace App\Http\PatternResponses;

interface IPatternResponse {

    public function responseFailed(\Illuminate\Support\MessageBag $errors);
    public function responseSuccessful(array $data);

}
