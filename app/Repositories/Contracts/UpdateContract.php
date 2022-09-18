<?php

namespace App\Repositories\Contracts;

interface UpdateContract
{
    public function update(object $object, array $data);
}
