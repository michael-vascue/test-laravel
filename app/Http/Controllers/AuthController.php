<?php


namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use App\Http\Requests\Users\UpdateProfileRequest;

class AuthController extends Controller
{
    public $token = true;
  
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    
    public function register(Request $request)
    {
 
         $validator = Validator::make($request->all(), 
                    [ 
                      'name' => 'required',
                      'email' => 'required|email',
                      'password' => 'required',  
                 
                     ]);  
 
         if ($validator->fails()) {  
               return response()->json(['error'=>$validator->errors()], 401);  
            }   
 
 
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
      
        if ($this->token) {
            return $this->login($request);
        }
  
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }
  
    public function login(Request $request)
    {
    
        $input = $request->only('email', 'password');
        $jwt_token = null;
  
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
  
        // return response()->json([
        //     'success' => true,
        //     'token' => $jwt_token,
        // ]);

        return $this->respondWithToken($jwt_token);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
  
        try {
            JWTAuth::invalidate($request->token);
  
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //update user profile
    // public function updateProfile(UpdateProfileRequest $request)
    // {
    //     $user = Auth::user();
    //     $jwt_token = auth('api')->tokenById($user->id);

    //     $input = $request->all();

        
    //     if ($jwt_token) {
    //         // $user = Auth::user();
    //         // $users = $user->user;
    //         $user->name = $request->input('name', '');
    //         $user->email = $request->input('email', '');
    //         $user->save();
    //     }
    //     // $user->update($request->all());
     
    //     // return ['message' => 'Updated the user info'];
    //     return $this->respondWithToken($jwt_token);
        
    // }

    public function updateProfile(UpdateProfileRequest $request)
    {
        DB::transaction(function() use ($request){
            $user = Auth::user();
            $user->name = $request->input('name','');
            $user->email = $request->input('email','');
            $user->save();
        });

        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        // ]);
        return ['message' => 'Updated the user info sucessfully!'];
    }

    public function userProfile()
    {
        // return response()->json(auth()->user());
        $user = auth('api')->user();
        $token = auth('api')->tokenById($user->id);

        return response([
            'user' => $user,
            'token' => $token
        ]);

        // return $this->respondWithToken($token);
    }
  
    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
  
        $user = JWTAuth::authenticate($request->token);
  
        return response()->json(['user' => $user]);
    }

      
    //   Refresh a token.
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

  
    // Get the token array structure
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function guard() {
        return Auth::Guard('api');
    }

}
    


