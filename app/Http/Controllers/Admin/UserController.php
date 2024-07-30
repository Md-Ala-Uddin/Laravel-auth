<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(Request $request): View
    {
        $users = User::whereNot('id', $request->user()->id)->get();
        return view('admin.users.index', ['users' => $users]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'role' => 'required|string|in:' . implode(',', UserRole::values())
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = $errors->all();
            $errorMessageString = implode(' ', $errorMessages);

            return redirect()->route('admin.users.index')
                ->with('error', 'Error: Validation failed. ' . $errorMessageString)
                ->withErrors($validator)
                ->withInput();
        }
        
        $user->update($validator->safe()->only('name'));

        // Manually update the role to prevent mass assignment vulnerability
        $user->role = $validator->safe()->only('role')['role'];
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Success: User updated.');
    }

    public function Delete(Request $request, User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Success: User deleted.');
    }
}
