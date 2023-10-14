<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ImageUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('welcome');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function Signup(Request $request)
    {
        try {
            $image = $request->file('profilePic');

            if ($image) {
                $allowedTypes = ['jpeg', 'jpg', 'png'];
                $maxFileSize = 4096;

                $validationRules = [
                    'profilePic' => [
                        'required',
                        'image',
                        'mimes:' . implode(',', $allowedTypes),
                        'max:' . $maxFileSize,
                    ],
                ];
                $imageUploadService = new ImageUploadService();
                $uniqueName = $imageUploadService->upload($image, 'images/profile');
            } else {
                return redirect()->back()->with('error', 'Please Select Image');
            }

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'address' => 'required',
                'hobby' => 'required|array',
                'gender' => 'required|in:male,female',
                'dob' => 'required|date',
                'password' => 'required|min:6',
                'confirmPassword' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                $path = public_path('images/profile/' . $uniqueName);
                if (File::exists($path)) {
                    File::delete($path);
                }
                return redirect()->back()->withErrors($validator);
            }

            $data = $request->all();
            $data['profilePic'] = $uniqueName;

            // Create a new user record in the database (assuming you have a 'User' model)
            $user = User::create([
                'email' => $data['email'],
                'phone_no' => $data['phone'],
                'address' => $data['address'],
                'profile_pic' => $data['profilePic'],
                'hobby' => implode(',', $data['hobby']),
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'password' => Hash::make($data['password']),
            ]);


            return redirect()->to('/dashboard');
        } catch (Exception $e) {
            var_dump($e->getMessage());
            die;
            $path = public_path('images/profile/' . $uniqueName);
            if (File::exists($path)) {
                File::delete($path);
            }

            return redirect()->back()->with('error', 'Something went wrong while signup');
        }
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);
    
        $loginField = $request->input('login');
        $password = $request->input('password');
    
        $credentials = [];
        
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $loginField;
        } else {
            $credentials['phone'] = $loginField;
        }
    
        if (Auth::attempt($credentials + ['password' => $password])) {
            // Authentication passed
            return redirect()->intended('/dashboard'); // Redirect to the dashboard
        }
    
        return back()->withErrors(['error' => 'Invalid login or password']);
    }
}
