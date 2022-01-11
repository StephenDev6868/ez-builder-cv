<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class UpdateFieldLinkInviteToRefcodeIntoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('link_invite', 'refcode');
        });

        $users = User::all();

        foreach ($users as $user) {
            $user->update([
                'refcode' => $user->getKey() . str::random(9),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('refcode', 'link_invite');
            $table->text('refcode')->nullable()->change();
        });
    }
}
