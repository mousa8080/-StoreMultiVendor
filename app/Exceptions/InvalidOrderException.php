<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvalidOrderException extends Exception
{
    public function report()
    {
        Log::channel('sql')->warning($this->getMessage());
    }
    public function render(Request $request)
    {
        return Redirect::route('home')
            ->withInput()
            ->withErrors([
                'message' => $this->getMessage(),
            ])
            ->with('info', $this->getMessage());
        /////api
        // return response()->json([
        //     'message' => $this->getMessage(),
        //     'code' => $this->getCode(),
        // ], 400);
    }
}
