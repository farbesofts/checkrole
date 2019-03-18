<?php

namespace Farbesofts\Checkrole;

use Illuminate\Contracts\Auth\Guard;

class Checkrole
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
}
