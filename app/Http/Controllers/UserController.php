<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View|Factory|JsonResponse|Application
    {
        if ($request->ajax()) {
            $users = User::query()->get();
            if (auth()->user()->can('admin')) {
                return Datatables::of($users)
                    ->addColumn('actions', function ($user) {
                        $actionBtn = '<a id="add" title="Add" data-toggle="tooltip" data-id='. $user->id .'><i class="material-icons green cursor-pointer p-1">&#xE03B;</i></a>
                                      <a id="edit" title="Edit" data-toggle="tooltip" data-id='. $user->id .'><i class="material-icons yellow cursor-pointer p-1">&#xE254;</i></a>
                                      <a id="delete" title="Delete" data-toggle="tooltip" data-id='. $user->id .'><i class="material-icons red cursor-pointer p-1">&#xE872;</i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            } else {
                return Datatables::of($users)
                    ->make(true);
            }
        }

        return view('users.index',
            ['inputs' => [
                ['name' => 'name'],
                ['name' => 'email']
            ]]);
    }

    /**
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('users.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('admin')) {
            $rules = [
                "name" => ['required', 'string'],
                "email" => ['required', 'unique:users'],
                "password" => ['required', 'min:8', 'max:30'],
            ];

            $validator = Validator::make($request->all(), $rules, []);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator->errors());
            }
            User::query()->create($validator->attributes());

            return redirect(route('user.index'))->with("success", "The user has been registered");
        }

        abort(403, 'Forbidden');
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request): void
    {
        if (auth()->user()->can('admin')) {
            User::query()->where('id', $request->get('id'))->delete();
        } else {
            abort(403, 'Forbidden');
        }
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        if (auth()->user()->can('admin')) {
            $rules = [
                "name" => ['required', 'string'],
                "email" => ['required', 'unique:users,email,' . $request->get('id')],
            ];
            $validator = Validator::make($request->all(), $rules, []);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 401);
            }

            User::query()->where('id', $request->get('id'))->update($validator->attributes());
        } else {
            abort(403, 'Forbidden');
        }
    }
}
