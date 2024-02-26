<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(): View|Factory|Application|RedirectResponse
    {
        $users = User::query()->get();

        return view('users.index',
            compact('users'),
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
