<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class UpdateNewLinkInviteIntoUsersTable extends Migration
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
                'link_invite' => env('APP_URL') . '/invite/?refcode=' . $user->getKey() . str::random(9),
            ]);
        }
    }
}
