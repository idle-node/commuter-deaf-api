<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slash(): Factory|View|Application
    {
        return view('home');
    }

    protected function baseValidator(Request $request, array $rules): bool {
        $v = Validator::make($request->all(), $rules);

        if($v->fails()){
            throw new BadRequestException($v->errors()->first());
        }

        return true;
    }
}
