<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\Factory as Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $socialite;
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Auth $auth, Socialite $socialite)
    {
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function showDoctorLoginForm()
    {
        return view('auth.login', ['url' => 'doctor']);
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            return redirect()->route('/');
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }

    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($this->auth->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function doctorLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($this->auth->guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/doctor');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function logout(Request $request)
    {
        if ($this->auth->guard('admin')->check()) {

            $this->auth->guard('admin')->logout();

        } elseif ($this->auth->guard('doctor')->check()) {

            $this->auth->guard('doctor')->logout();

        } else {

            $this->auth->guard('web')->logout();

        }
        $request->session()->invalidate();

        return redirect()->route('login')->with('success', 'You have logged out!');
    }

    public function redirectToProvider($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = $this->socialite->driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        $this->auth->login($authUser, true);

        return redirect()->to('/');
    }
    private function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'first_name' => $user->given_name,
            'last_name' => $user->family_name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'password' => Hash::make(Str::random(24)),
            'photo' => $user->avatar_original,
        ]);
    }
}
