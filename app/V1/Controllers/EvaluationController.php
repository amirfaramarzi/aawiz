<?php

namespace App\V1\Controllers;

use App\V1\Controllers\Controller;
use App\V1\Resources\Evaluation\EvaluationCollection;
use Carbon\Carbon;
use Fomo\Database\DB;
use Fomo\Attributes\Method;
use Fomo\Attributes\Note;
use Fomo\Attributes\Route;
use Fomo\Relationship\Relationship;
use Fomo\Request\Request;

class EvaluationController extends Controller
{
    #[
        Route('v1/evaluations') ,
        Method('GET') ,
        Note('This service is for get evaluations.')
    ]
    public function getEvaluations(Request $request): string
    {
        $evaluations = DB::table('evaluations')
            ->latest('id')
            ->select(['id' , 'title' , 'description' , 'user_id' , 'created_at'])
            ->paginate(15);

        (new Relationship())
            ->select(['first_name' , 'last_name', 'email'])
            ->hasOne($evaluations , 'users' , 'id' , 'user_id');

        return (new EvaluationCollection($evaluations , 15))->collection();
    }

    #[
        Route('v1/evaluations') ,
        Method('POST') ,
        Note('This service is for insert evaluations.')
    ]
    public function insertEvaluation(Request $request): string
    {
        $validate = validation()->validate($request->post() , [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:4000',
        ]);
        if ($validate->hasError()){
            return $this->unprocessableResponse($validate->getErrors());
        }

        DB::table('evaluations')->insert([
            'title' => $request->post('title') ,
            'description' => $request->post('description') ,
            'user_id' => auth()->getId() ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $this->createdResponse("Information was successfully recorded.");
    }

    #[
        Route('v1/evaluations/{evaluation}') ,
        Method('PATCH') ,
        Note('This service is for update evaluations.')
    ]
    public function updateEvaluation(Request $request, $evaluation_id): string
    {
        $evaluation = DB::table('evaluations')
            ->where('id', $evaluation_id)
            ->where('user_id', auth()->getId())
            ->exists();

        if($evaluation == false) {
            return $this->notFoundResponse('The desired assessment was not found.');
        }

        $validate = validation()->validate($request->post() , [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:4000',
        ]);
        if ($validate->hasError()){
            return $this->unprocessableResponse($validate->getErrors());
        }

        DB::table('evaluations')
            ->where('id', $evaluation_id)
            ->update([
                'title' => $request->post('title') ,
                'description' => $request->post('description') ,
                'updated_at' => Carbon::now()
            ]);

        return $this->successResponse("The requested information was successfully edited.");
    }

    #[
        Route('v1/evaluations/{evaluation}') ,
        Method('DELETE') ,
        Note('This service is for delete evaluations.')
    ]
    public function destroyEvaluation(Request $request, $evaluation_id): string
    {
        $evaluation = DB::table('evaluations')
            ->where('id', $evaluation_id)
            ->where('user_id', auth()->getId())
            ->exists();

        if($evaluation == false) {
            return $this->notFoundResponse('The desired assessment was not found.');
        }
        
        DB::table('evaluations')
        ->where('id', $evaluation_id)
        ->delete();

        return $this->successResponse("The requested information was successfully deleted.");
    }
}