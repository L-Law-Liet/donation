<?php

namespace App\Http\Controllers;

use App\Http\Requests\Email\Index;
use App\Http\Requests\Email\Store;
use App\Http\Requests\Email\Update;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use App\Services\EmailService;

class EmailController extends ApiController
{
    protected function service(): string
    {
        return EmailService::class;
    }
    protected function model(): string
    {
        return Email::class;
    }
    protected function resource(): string
    {
        return EmailResource::class;
    }
    protected function storeRequest(): string
    {
        return Store::class;
    }
    protected function indexRequest(): string
    {
        return Index::class;
    }
    protected function updateRequest(): string
    {
        return Update::class;
    }
}
