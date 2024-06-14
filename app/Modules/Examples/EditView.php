<?php
namespace App\Modules\Examples;

use App\Models\Example;
use App\Common\Base64ToImage;
use App\Modules\Examples\Resources\ExampleResource;
use App\Common\Datetime\TimeDate;

class EditView
{
    public function addData($request)
    {
        $example = new Example();
        try
        {
            $example->LogDebug('Begin: Examples.EditView->addData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $example->name = $formData['name'] ?? '';

            $example->email = $formData['email'] ?? '';

            $example->phone = $formData['phone'] ?? '';

            $example->gender = $formData['gender'] ?? '';

            $example->dob = $datetime->to_db_date($formData['dob']);

            $example->qualification = $formData['qualification'] ?? '';

            $example->hobbies = $formData['hobbies'] ?? '';

            $example->parent_id = $formData['parent_id'] ?? '';

            $example->parent_type = $formData['parent_type'] ?? '';

            if ($example->save())
            {
                if ($request->get('fileUpload') == true)
                {
                    $id = $example->id;

                    $example = Example::find($id);

                    $imagepath = Base64ToImage::base64ToImage($request->get('fileContent'), $id . '.' . $request->get('fileExt'));
                   
                    $example->image = $imagepath;
                    
                    $example->save();
                }
                
                $example->LogInfo('End: Examples.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $example->id]);
                
                return response()->json(['message' => 'Record created successfully', 'example' => new ExampleResource($example)]);
            }
        }
        catch (\Throwable $e)
        {
            $example->LogCritical('Failed: Examples.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

}