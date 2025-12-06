<?php

namespace App\V1\Documentation\Auth;

use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;

class RegisterDocument
{
    #[Post(
        path: '/v1/auth/register',
        description: 'This service is for registration.',
        summary: 'registration',
        requestBody: new RequestBody(
            required: true ,
            content: new JsonContent(
                required: [
                    'first_name',
                    'email',
                    'password',
                ],
                properties: [
                    new Property(
                        property: 'first_name' ,
                        title: 'User first name' ,
                        type: 'string' ,
                        example: 'Bob'
                    ),
                    new Property(
                        property: 'last_name' ,
                        title: 'User last name' ,
                        type: 'string' ,
                        example: 'Alice'
                    ),
                    new Property(
                        property: 'email' ,
                        title: 'User Email' ,
                        type: 'string' ,
                        example: 'example@gmail.com'
                    ),
                    new Property(
                        property: 'password' ,
                        title: 'User password' ,
                        type: 'string' ,
                        example: '@A48que95#'
                    )
                ]
            )
        ),
        tags: [
            'auth'
        ],
        responses: [
            new Response(
                response: 201,
                description: 'Registration was successful.'
            ),
            new Response(
                response: 400,
                description: 'You are already registered.'
            ),
            new Response(
                response: 422,
                description: 'The information submitted is invalid.',
            )
        ]
    )]
    public function __construct(){}
}