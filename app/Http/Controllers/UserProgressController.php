<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProgressRequest;
use App\Models\UserProgress;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    use HttpResponses;

    public function saveProgress(StoreUserProgressRequest $request)
    {
        $request->validated($request->all());

        $userInfo = UserProgress::where('id', $request->id)->first();

        UserProgress::where('id', $request->id)->update([
            'storyProgressId' => $request->storyProgressId,
            'level' => $request->level,
            'experience' => $request->experience,
            'coins' => $request->coins,
            'gems' => $request->gems,
        ]);

        return $this->success(
            $userInfo,
            "User progress saved successfully"
        );
    }
}
