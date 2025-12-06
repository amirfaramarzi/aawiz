<?php

namespace App\V1\Resources\Evaluation;

use Fomo\Resource\JsonResource;

class EvaluationCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $request->id ,
            'title' => $request->title ,
            'description' => $request->description ,
            'user' => [
                'first_name' => $request->user->first_name ,
                'last_name' => $request->user->last_name ,
                'email' => $request->user->email ,
            ],
            'created_at' => $request->created_at ,
        ];
    }
}