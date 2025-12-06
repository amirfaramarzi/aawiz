<?php

namespace App\V1\Documentation\Evaluation;

use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

class DeleteDocument
{
    #[Delete(
        path: '/v1/evaluations/{evaluation}',
        description: 'This service is for evaluation delete.',
        summary: 'delete',
        tags: [
            'evaluations'
        ],
        parameters: [
            new Parameter(
                name: 'evaluation',
                description: 'evaluation id',
                in: 'path',
                required: true,
                schema: new Schema(
                    type: 'string',
                    example: '1'
                )
            ) ,
        ],
        security: [
            ['bearerAuth' => []]
        ],
        responses: [
            new Response(
                response: 200,
                description: 'The operation was successful.' ,
            ),
            new Response(
                response: 404,
                description: 'Lack of access or non-existence of assessment.',
            ),
            new Response(
                response: 422,
                description: 'The information submitted is invalid.',
            ),
        ]
    )]
    public function __construct(){}
}