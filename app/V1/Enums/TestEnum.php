<?php

namespace App\V1\Enums;

enum TestEnum: string
{
    case baseUrl = 'http://127.0.0.1:9000/v1/';
    case bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJkb2tvLmlyIiwiYXVkIjoic2VsbGVyIiwiaWF0IjoxNzY0MjYzNDIyLCJleHAiOjE3NjQzNDk4MjIsInN1YiI6MX0.QYoG9D9Hwy55sH3YXdK4CSaEtFZFCzOw63XQsCCJK1E';
}