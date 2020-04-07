<?php

namespace App\Repositories\Api;

use App\Repositories\Api\Interfaces\UserRepositoryInterface;
use App\User as Model;
use Validator;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
     protected $model;

    /**
     * UserRepository constructor.
     *
     * @param Model $model
     */
    // public function __construct(Model $model)
    // {
    //     $this->model = $model;
    // }

    /**
    * @param $id
    * @return Model
    */
    // public function find($id): ?Model
    // {
    //     return $this->model->find($id);
    // }


    /**
    * @param array $request
    *
    */
    public function validateStore($request)
    {
        return Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'post_code' => 'required',
            'contact_phone_no' => 'required',
            'email' => 'required|email',
            'user_name' => 'required',
        ]);
    }

    /**
    * @param array $request
    *
    */
    public function storeUser($request): Model
    {
        $randomPass = Str::random(20);

        // Send Emai
        // Details with temporary password ($randomPass) for initial login (Mandatory Changing Pass)
        // Email Verification

        $input = $request->all();

        $input['password'] = bcrypt($randomPass);
        $input['role'] = 'user';
        $user = Model::create($input);

        return $user;
    }

    /**
    * @param array $request
    *
    */
    public function updateUser($request, $id): Model
    {
        $user = Model::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->post_code = $request->post_code;
        $user->contact_phone_no = $request->contact_phone_no;
        $user->save();

        return $user;
    }



    /**
    * @param $id
    *
    */
    public function delUser($id)
    {
        $user = Model::find($id)->delete();
        return $user;
    }




}
