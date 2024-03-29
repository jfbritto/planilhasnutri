<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('user.home');
    }

    public function show($id)
    {
        return view('user.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $data = [
            'id_unit' => auth()->user()->id_unit ?: $request->id_unit,
            'name' => trim($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'is_estagiario' => auth()->user()->id_unit ? true : false
        ];

        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'email' => trim($request->email)
        ];

        if (!empty($request->password)) {
            if ($request->password === $request->password_confirm) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:8',
                ]);

                if ($validator->fails()) {
                    return response()->json(['status'=>'error', 'message'=>'A senha deve conter 8 ou mais caracteres'], 400);
                }

                $data['password'] = Hash::make(trim($request->password));
            } else {
                return response()->json(['status'=>'error', 'message'=>'As senhas são divergentes'], 400);
            }
        }

        $response = $this->userService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function updatePassword(Request $request)
    {
        $data = [
            'id' => auth()->user()->id,
            'password' => Hash::make(trim($request->password))
        ];

        $response = $this->userService->updatePassword($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function destroy(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->userService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;

        $data = [
            'id' => trim($request->id),
            'status' => $status
        ];

        $response = $this->userService->changeStatus($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();
        $response = $this->userService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

}
