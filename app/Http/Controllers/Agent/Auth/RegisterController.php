<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\Agent;
use App\Rules\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:agent');
    }

    /**
     * (重构注册方法)Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        self::autoAssignRoles($user);

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required','unique:agents',new Phone()],
            'phone_captcha' => 'required|min:6',
            'password' => 'required|string|min:6|confirmed',
            'captcha' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return Agent::create([
            'openid' => str_random(32),
            'username' => make_username(),
            'nickname' => 'B_'.str_random(6).$data['phone'],
            'avatar' => '',
            'sex' => 0,
            'source' => 0,
            'status' => 1,
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('agent.auth.register');
    }

    /**
     * 重构认证驱动
     *
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('agent');
    }

    /**
     * 代理商注册后自动分配权限
     *
     * @param Agent $agent
     * @return Agent
     */
    public static function autoAssignRoles(Agent $agent)
    {
        return $agent->syncRoles(10);
    }
}
