<?php

namespace App\V1\Documentation\Auth;

use OpenApi\Attributes\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;

class LoginDocument
{
    #[Post(
        path: '/v1/auth/login',
        description: 'This service is for login.',
        summary: 'login',
        requestBody: new RequestBody(
            required: true ,
            content: new JsonContent(
                required: [
                    'email',
                    'password',
                ],
                properties: [
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
                response: 200,
                description: 'The operation was successful.' ,
                content: new JsonContent(
                    properties: [
                        new Property(
                            property: 'token' ,
                            title: 'jwt token' ,
                            type: 'string' ,
                            example: 'eyJ0eXAiOiJKV1QiLqwCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJkb2qwetvLmlyIiwiYXVkIjoic2VsbGVyIiwiaWF0IjoxNjQ4MDIyOTE3LCJleHAiOjE3MzQ0MjI5MTcsInN1YiI6MX0.r_UgDmle7TN2xlnlXVmmeyfoH_MW_4Awc3YDOcoYjgk' ,
                        ),
                        new Property(
                            property: 'expired_at' ,
                            title: 'Token expiration date' ,
                            type: 'string' ,
                            example: '2025-11-28 16:14:45' ,
                        ),
                    ]
                )
            ),
            new Response(
                response: 404,
                description: 'The password is incorrect or the username does not exist.'
            ),
            new Response(
                response: 422,
                description: 'The information submitted is invalid.',
            ),
        ]
    )]
    public function __construct(){}
}