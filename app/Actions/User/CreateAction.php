<?php

namespace App\Actions\User;

use App\Models\User;
use App\Models\UserPosition;
use App\Models\UserSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    /**
     * Registration of new user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        session()->save();

        $data = $request->all();

        $photo_path = $request->file('photo')->store('users_photos', 'public');

        $data['photo'] = $photo_path;

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        if ($user) {
            $this->fillLinkedTables($user->id, $request->position_id);

            $json['success'] = 'User successfully created';
        } else {
            $json['error'] = 'Failed to create user';
        }
        return response()->json($json);
    }

    /**
     * Filling linked tables
     *
     * @param $user_id
     * @param $position_id
     * @return void
     */
    private function fillLinkedTables($user_id, $position_id): void
    {
        UserSchedule::create([
            'user_id' => $user_id,
            'schedule_id' => 2
        ]);

        UserPosition::create([
            'user_id'     => $user_id,
            'position_id' => $position_id
        ]);
    }
}
