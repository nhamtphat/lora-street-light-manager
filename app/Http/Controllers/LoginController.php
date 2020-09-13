<?php
  
namespace App\Http\Controllers;
   
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
   
class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('auth.login');
    }
   
    public function postLogin(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if(Auth::attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            return redirect()->route('user.dashboard.view.get');
        }else{
            return redirect()->route('guest.login.get')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('guest.login.get');
    }
}