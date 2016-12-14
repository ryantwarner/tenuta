<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;

use Illuminate\Support\Facades\Auth;

use App\Models\Unit;
use App\Models\Access\User\User;
use App\Models\Application;

class ApplicationsController extends Controller
{
    use RegistersUsers;
    
    protected $user;

    public function __construct(UserRepository $user)
    {
            // Where to redirect users after registering
            $this->redirectTo = route('frontend.index');

            $this->user = $user;
    }
    
    public function applicationForm(Request $request) {
        return view('frontend.availabilities.apply')->with([
            'unit' => Unit::with('location')->find($request->id),
            'user' => Auth::guest() ? new User() : Auth::user()
        ]);
    }
    
    private function createApplication($user, $request) {
        $application = Application::create([
                "user_id" => $user->id,
                "availability_id" => $request->id
            ]);
        return $application;
    }
    
    public function saveApplication(Request $request) {
        if (config('access.users.confirm_email')) {
            $user = $this->user->create($request->all());
            event(new UserRegistered($user));
            $application = $this->createApplication($user, $request);
            return redirect($this->redirectPath())->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.created_confirm'));
        } else {
            auth()->login($this->user->create($request->all()));
            event(new UserRegistered(access()->user()));
            $application = $this->createApplication($user, $request);
            return redirect($this->redirectPath());
        }
    }
}
