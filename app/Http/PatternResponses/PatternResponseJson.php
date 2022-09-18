<?php

namespace App\Http\PatternResponses;

use App\Http\PatternResponses\IPatternResponse;

class PatternResponseJson implements IPatternResponse {

    public function responseFailed(\Illuminate\Support\MessageBag $errors) {
        return response()->json([
            'success' => false,
            'message' => 'Ops! Some errors occurred...',
            'errors' => $errors
        ]);
    }

    public function responseExcept(\Exception $exception) {
        return [
            'success' => false,
            'message' => $exception->getMessage(),
            'errors' => []
        ];
    }

    public function responseSuccessful(array|\Illuminate\Support\Collection $data) {
        return [
            'success' => true,
            'data' => $data
        ];
    }
}
