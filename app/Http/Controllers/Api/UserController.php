<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Validator;


use App\Repositories\Api\UserRepository as Repository;

use App\User as Model;


class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $repo;
    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->repo->validateStore($request);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $this->repo->storeUser($request);

        return $this->sendResponse($user, 'User register successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = $this->repo->validateStore($request);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $this->repo->updateUser($request, $id);

        return $this->sendResponse($user, 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repo->delUser($id);
        return $this->sendResponse($user, 'User deleted successfully.');
    }
}
