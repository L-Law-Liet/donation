<?php

namespace App\Services;

use App\Http\Resources\EmailResource;
use App\Models\Email;

class EmailService extends ApiService
{
    protected function model(): string
    {
        return Email::class;
    }
    protected function resource(): string
    {
        return EmailResource::class;
    }
}
