<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response(bool $success = true, $message = null, int $status = null, array|JsonResource $data = null)

    {
        $request = request();

        $status = $status ?? ($request->isMethod('POST') ? 201 : 200);

        if ($request->isMethod('POST') || $request->isMethod('PATCH') || $request->isMethod('DELETE')) {
            //This won't nest 'data'. Don't worry. Used $data->resolve() if instanceof AnonymousResourceCollection before.
            return response()->json(compact('success', 'message', 'data'), $status);
        } else {

            if ($data instanceof JsonResource && $data->resource) {
                return $data;
            } elseif (is_array($data) && $data) {
                return response()->json($data, $status);
            } else {
                return response()->noContent();
            }
        }
    }
}
