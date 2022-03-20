<?php

namespace App\Repositories;

use App\Models\TodoListImages;
use App\Contracts\RepositoryAbstract;
/**
 * Class ProductMenuRepository.
 */
class TodoListImagesRepository extends RepositoryAbstract
{
	protected $images_obj;

    // 透過 DI 注入 Model
    public function __construct(TodoListImages $images_obj)
    {
        $this->images_obj = $images_obj;
        parent::__construct();
    }

    public function modelUse(){
        return TodoListImages::class;
    }
}
