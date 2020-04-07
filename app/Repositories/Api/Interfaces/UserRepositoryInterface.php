<?php
namespace App\Repositories\Api\Interfaces;

use App\User as Model;

/**
* Interface UserRepositoryInterface
* @package App\Repositories
*/
interface UserRepositoryInterface
{
    /**
    * @param array $request
    *
    */
   public function validateStore($request);

   /**
    * @param array $request
    * @return Model
    */
    public function storeUser($request): Model;


    /**
    * @param array $request
    * @param $id
    * @return Model
    */
    public function updateUser($request, $id): Model;

    /**
    * @param $id
    * @return Model
    */
    public function delUser($id);
}
