<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'email' => 'email|unique:users,email,'.$user->id,
        ]);

        return tap($user)->update($request->only('name', 'email', 'caloonday', 'cannang_from', 'cannang_to', 'tdee_guide'));
    }
}
