<?php

namespace App\Repositories\Contracts;

interface ForceDeleteContract
{
    public function forceDelete(object $object);
}
