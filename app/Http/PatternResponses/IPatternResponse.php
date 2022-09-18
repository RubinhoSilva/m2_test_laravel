<?php

namespace App\Http\PatternResponses;

interface IPatternResponse {

    public function responseFailed(\Illuminate\Support\MessageBag $errors);
    public function responseExcept(\Exception $exception);
    public function responseSuccessful(array|\Illuminate\Support\Collection $data);

}
