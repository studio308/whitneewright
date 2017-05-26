<?php

namespace App\Http\Controllers\Api;

use App\Categories;
use App\Media;
use App\Work;
use App\Bus\Commands\AddCategoriesCommand;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Api\AbstractApiController;
use Binput;
use Illuminate\Support\Facades\Input;

class CategoriesApiController extends AbstractApiController
{
    public function store(Request $request)
    {
        try {
            $this->dispatchNow(new AddCategoriesCommand(Input::all()));

            return 'yaoo';

        } catch(ValidationException $e) {

            return "that didn't work";
        }
    }
}