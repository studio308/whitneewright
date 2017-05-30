<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\DeleteCategoryCommand;
use App\Categories;
use App\Media;
use App\Work;
use App\Bus\Commands\AddCategoriesCommand;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Api\AbstractApiController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class WorksApiController extends AbstractApiController
{
    public function store(Request $request)
    {
        $input = Input::get('image');
        dd($request->all());
        Image::make($image)->save(public_path($imageName));

        try {

        } catch(ValidationException $e) {

        }
    }

    public function storeImage(Request $request)
    {
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            Image::make($image)->save(public_path('/image/'.$imageName));
            $path = 'image/'.$imageName;

            return response($path);
        }

        return response('There was an error');
    }

    public function delete()
    {
        $categoryId = Input::get('category_id');
        $category = Categories::find($categoryId);

        try {
            $this->dispatchNow(new DeleteCategoryCommand($category));

            return "sick";

        } catch(ValidationException $e) {

            return "shit";

        }
    }
}