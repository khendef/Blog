<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\v1\StoreUserRequest;
use App\Http\Requests\v1\User\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
         return self::success($users);
    }

  
    public function store(StoreUserRequest $request)
    {
        try{
            $user = User::create($request->validated());
            return self::success($user, ' created successfully',201);

        }catch(Exception $e){

        }

        
    }

    
    public function show(User $user)
    {
        return self::success($user);
        
    }

   
    public function update(UpdateUserRequest $request, User $user)
    {
            $user = User::update($request->validated());
            return self::success($user);
       
    }

    
    public function destroy(User $user)
    {
        $user->delete();
        return self::success(null, 'post deleted successfully' ,204);
    }
}
