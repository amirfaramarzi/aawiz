<?php

namespace App\V1\Documentation\Evaluation;

use App\V1\Documentation\SecurityDocument;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;

class InsertDocument
{
    #[Post(
        path: '/v1/evaluations',
        description: 'This service is for evaluation insert.',
        summary: 'insert',
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
                response: 201,
                description: 'The operation was successful.' ,
            ),
            new Response(
                response: 422,
                description: 'The information submitted is invalid.',
            ),
        ]
    )]
    public function __construct(){}
}