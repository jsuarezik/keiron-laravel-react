<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;


class PopulateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create(
            [
                'id' => '1',
                'name' => 'admin'
            ]
        );

        Role::create(
            [
                'id' => '2',
                'name' => 'user'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::all()->each(function($item) { 
            $item->delete();
        }); 
    }
}
