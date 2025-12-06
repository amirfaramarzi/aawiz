<?php

namespace App\V1\Documentation\Evaluation;

use OpenApi\Attributes\Examples;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

class GetDocument
{
    #[Get(
        path: '/v1/evaluations',
        description: 'This service is for getting a list of evaluations.',
        summary: 'evaluations list',
        tags: [
            'evaluations'
        ],
        parameters: [
            new Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
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
                content: new MediaType(
                    mediaType: 'application/json',
                    schema: new Schema(
                        anyOf: [
                            new Schema(
                                title: 'evaluations',
                                properties: [
                                    new Property(
                                        property: 'data',
                                        title: 'evaluations list',
                                        type: 'array',
                                        items: new Items(
                                            properties: [
                                                new Property(
                                                    property: 'id' ,
                                                    title: 'evaluation id' ,
                                                    type: 'integer' ,
                                                    example: 1
                                                ),
                                                new Property(
                                                    property: 'title' ,
                                                    title: 'evaluation title' ,
                                                    type: 'string' ,
                                                    example: 'alice'
                                                ),
                                                new Property(
                                                    property: 'description' ,
                                                    title: 'evaluation description' ,
                                                    type: 'string' ,
                                                    example: 'bob'
                                                ),
                                                new Property(
                                                    property: 'user',
                                                    title: 'User registering the assessment',
                                                    properties: [
                                                        new Property(
                                                            property: 'first_name' ,
                                                            title: 'first name' ,
                                                            type: 'string' ,
                                                            example: 'Amir'
                                                        ) ,
                                                        new Property(
                                                            property: 'last_name' ,
                                                            title: 'last name' ,
                                                            type: 'string' ,
                                                            example: 'Faramarzi',
                                                            nullable: true
                                                        ) ,
                                                        new Property(
                                                            property: 'email' ,
                                                            title: 'email' ,
                                                            type: 'string' ,
                                                            example: 'amir@gmail.com'
                                                        ) ,
                                                    ],
                                                    type: 'object',
                                                    nullable: true
                                                ),
                                            ]
                                        )
                                    ) ,
                                    new Property(
                                        property: 'meta',
                                        title: 'Other information',
                                        properties: [
                                            new Property(
                                                property: 'isLastPage' ,
                                                title: 'Is this page the last page in the list of desired data?' ,
                                                type: 'boolean' ,
                                                example: false
                                            ) ,
                                            new Property(
                                                property: 'perPage' ,
                                                title: 'Number of data returned' ,
                                                type: 'int' ,
                                                example: 15
                                            ) ,
                                        ],
                                        type: 'object'
                                    )
                                ],
                                type: 'object'
                            ) ,
                        ]
                    ),
                    examples: [
                        new Examples(
                            example: 'evaluations list' ,
                            summary: 'evaluations list' ,
                            description: 'Get a list of evaluations' ,
                            value: [
                                'data' => [
                                    [
                                        'id' => 1 ,
                                        'title' => 'evaluation title' ,
                                        'description' => 'evaluation description' ,
                                        'user' => [
                                            'first_name' => 'Amir',
                                            'last_name' => 'Faramarzi',
                                            'email' => 'amir@gmail.com',
                                        ],
                                        'created_at' => '2025-11-27 17:29:54' ,
                                    ]
                                ] ,
                                'meta' => [
                                    'isLastPage' => false ,
                                    'perPage' => 15
                                ]
                            ]
                        ) 
                    ]
                )
            )
        ]
    )]
    public function __construct(){}
}