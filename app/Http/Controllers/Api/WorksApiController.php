<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\AddWorksCommand;
use App\Bus\Commands\DeleteCategoryCommand;
use App\Bus\Commands\DeleteWorkCommand;
use App\Bus\Commands\UpdateWorkCommand;
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
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class WorksApiController extends AbstractApiController
{
    public function store(Request $request)
    {
        try {
            $work = Input::all();
            $this->dispatchNow(new AddWorksCommand(
                array_get($work, 'title'),
                array_get($work, 'selectedCategory'),
                array_get($work, 'price'),
                array_get($work, 'dimensions'),
                array_get($work, 'description'),
                array_get($work, 'images'),
                array_get($work, 'primaryPhoto')
            ));

            return 'sweet';

        } catch(ValidationException $e) {
            return 'bad';
        }
    }

    public function storeImage(Request $request)
    {
        //dd($request->file('file'));
        if(!$request->hasFile('file')) {
            return response('No image sent', 401);
        }

        if(!$request->file('file')->isValid()) {
            return response('Image is not valid', 401);
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png|max:6000'
        ]);

        if($validator->fails()) {
            return response('There are errors in image', 401);
        }

        $mimeType = $request->file('file')->getClientMimeType();
        $imageSize = $request->file('file')->getClientSize();
        $imagePath = uniqid().'-'.$request->file('file')->getClientOriginalName().'.'.$request->file('file')->guessClientExtension();

        $s3 = Storage::disk('s3');
        if($s3->put($imagePath, file_get_contents($request->file('file')), 'public')) {
            $image = [
                'name' => $request->file('file')->getClientOriginalName(),
                'path' => env('AWS_URL').$imagePath
            ];

            return response($image);
        }

        return response('error', 401);
    }

    public function update($id)
    {
        try {
            $work = Work::findorfail($id);
            $updateWork = Input::all();
            $this->dispatchNow(new UpdateWorkCommand(
                $work,
                array_get($updateWork, 'title'),
                array_get($updateWork, 'selectedCategory'),
                array_get($updateWork, 'price'),
                array_get($updateWork, 'dimensions'),
                array_get($updateWork, 'description')
            ));

            return 'sweet';

        } catch(ValidationException $e) {
            return 'bad';
        }
    }

    public function delete($id)
    {
        try {
            $work = Work::findorfail($id);
            $this->dispatchNow(new DeleteWorkCommand($work));

            return 'sweet';

        } catch(ValidationException $e) {
            return 'bad';
        }
    }
}