<?php

namespace App\V1\Documentation;

use OpenApi\Attributes\Components;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\OpenApi;
use OpenApi\Attributes\SecurityScheme;
use OpenApi\Attributes\Server;

#[OpenApi(
    info: new Info(
        version: '1.0.0',
        title: 'API communication documentation'
    ),
    servers: [
        new Server(
            url: 'http://0.0.0.0:8000',
            description: 'Local development server'
        )
    ],
    components: new Components(
        securitySchemes: [
            new SecurityScheme(
                securityScheme: 'bearerAuth',
                type: 'http',
                scheme: 'bearer',
                bearerFormat: 'JWT'
            )
        ]
    )

)]
class BaseDocument{}