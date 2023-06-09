<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class UpdateLinkInviteIntoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->update([
                'link_invite' => config('app.url') . 'invite/?refcode=' . $user->getKey() . str::random(9),
            ]);
        }
    }
}
