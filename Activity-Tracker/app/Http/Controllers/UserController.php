<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        if (!$users) {
            return response()->json([
                'code' => 201,
                'message' => 'No Record Found',
                'status' => false,
                'error' => false,
                'data' => []

            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'Users Data Found',
                'status' => true,
                'error' => false,
                'data' => $users
            ]);
        }
    }


    public function registerform()
    {
        $roles = DB::table('roles')->get();
        return view('user.register', [
            'roles' => $roles
        ]);
    }

    public function save(Request $request)
    {
        $userId = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'type' => 'user', //admin you can insert by changing the type
            'designation' => $request->designation,
        ]);

        if ($userId) {
            return redirect()->to('login');
        }
    }


    public function loginform()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userRecord = DB::table('users')->where('email', $request->email)->first();
        $dbHash = $userRecord->password;

        if (Hash::check($request->password, $dbHash)) {

            //Before Redirection Add the data to Session.
            session([
                'userdata' => $userRecord,
            ]);

            $RedirectionPath = [
                'user' => 'dashboard/user',
                'admin' => 'dashboard/admin',
            ];

            $type = $userRecord->type;
            $route = $RedirectionPath[$type];

            return redirect()->to("{$route}?msg=Login-Success");
        } else {
            return redirect()->to('login?msg=Invalid Email or Password');
        }


    }

    public function contactForm(Request $request){
        $contactData = DB::table('contact')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'message'=>$request->message,
        ]);
         if($contactData){
        // Add a session flash message
        $request->session()->flash('success', 'Message Sent Successfully');
        return redirect()->to('contact');
    }
       
    }


    public function logout(Request $request)
    {

        $request->session()->flush();
        return redirect()->to('login?msg=logout success');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $userExistingRecord = User::where('email', $request->email)->exists();
        //for checking if Record exist or not
        if ($userExistingRecord) {
            return response()->json([
                'code' => 201,
                'message' => 'Duplicate Record Found,Try Unique Data',
                'status' => false,
                'error' => false,
                'data' => []
            ]);
        } else {
            //Insert New Record.

            //insert Query Builder
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $newId = $user->id;
            $userData = User::where('id', $newId)->get();
            if ($userData) {
                return response()->json([
                    'code' => 200,
                    'message' => 'User Inserted Successfully',
                    'status' => true,
                    'error' => false,
                    'data' => $userData
                ]);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'User Not Inserted',
                    'status' => false,
                    'error' => false,
                    'data' => []
                ]);
            }


        }





    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$id) {
            return response()->json([
                'code' => 201,
                'message' => 'Id is Required',
                'status' => false,
                'error' => true,
                'data' => [],

            ]);
        } else {
            $users = User::where('id', $id)->get(); //column name = user_id
            // $users = User::find($id); //column name = id 
            if ($users) {
                return response()->json([
                    'code' => 200,
                    'message' => "Record found for $id",
                    'status' => true,
                    'error' => false,
                    'data' => $users,
                ]);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => "No found for $id",
                    'status' => false,
                    'error' => false,
                    'data' => [],
                ]);
            }


        }



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userExist = User::where('id', $id)->exists();
        if ($userExist) {
            $name = $request->name;
            $email = $request->email;
            $user = User::where('id', $id)->update([
                'name' => $name,
                'email' => $email,
            ]);
            $UpdatedUser = User::where('id', $id)->get();

            if ($UpdatedUser) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Record Updated Successfully',
                    'status' => true,
                    'error' => false,
                    'data' => $UpdatedUser,
                ]);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Record Not Updated',
                    'status' => false,
                    'error' => false,
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Record Not Found,Try Another Id ',
                'status' => false,
                'error' => false,
                'data' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->get();
        if ($user) {
            $user = User::where('id', $id)->delete();
            if ($user) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Record Deleted Successfully',
                    'status' => true,
                    'error' => false,
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Record Not Deleted',
                    'status' => true,
                    'error' => false,
                    'data' => []
                ]);

            }
        }
    }
}