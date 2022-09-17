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

    public function responseSuccessful(array $data) {
        return [
            'success' => true,
            'data' => $data
        ];
    }
}
