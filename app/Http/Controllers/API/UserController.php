<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserPaymentResource;
use App\Http\Resources\UserResource;
use App\Setting;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
public $successStatus = 200;
    /**
     * login api
     *
     *
    @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['user'] =  new UserResource($user);
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     *
        @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|username',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     *
    @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::whereHas('roles', function(Builder $query){ $query->where('name', '!=', 'Customer'); })->get();
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $branch = Setting::first();
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|numeric'
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'branch_id' => $branch->id
        ]);

        $user->roles()->attach($request->role);

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'firstname' => 'string|max:255',
            'middlename' => 'string|max:255',
            'lastname' => 'string|max:255',
            'username' => 'string|max:255',
            'password' => 'string|max:255',
            'role' => 'numeric'
        ]);

        $user->update($request->all());

        if ($request->role) $user->roles()->sync($request->role);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Deleted Successfully!']);
    }
}
