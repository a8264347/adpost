<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function createRecord(array $data);
    public function findRecord(int $id);
    public function updateRecord(int $id,array $data);
    public function RestoreRecord(int $id);
}
