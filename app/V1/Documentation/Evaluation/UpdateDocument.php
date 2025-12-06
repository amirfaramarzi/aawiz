<?php

namespace App\V1\Documentation\Evaluation;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Patch;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Schema;

class UpdateDocument
{
    #[Patch(
        path: '/v1/evaluations/{evaluation}',
        description: 'This service is for evaluation update.',
        summary: 'update',
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
        requestBody: new RequestBody(
            required: true ,
            content: new JsonContent(
                required: [
                    'title',
                    'description',
                ],
                properties: [
                    new Property(
                        property: 'title' ,
                        title: 'evaluation title' ,
                        type: 'string' ,
                        example: 'evaluation title'
                    ),
                    new Property(
                        property: 'description' ,
                        title: 'evaluation description' ,
                        type: 'string' ,
                        example: 'evaluation description'
                    )
                ]
            )
        ),
        tags: [
            'evaluations'
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