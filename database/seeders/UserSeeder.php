<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user1 = new User();
        $user1->name = "ADMIN";
        $user1->email = "administrador@mail.com";
        $user1->password = bcrypt("admin54321");
        $user1->save();

        $user2 = new User();
        $user2->name = "CAJERO";
        $user2->email = "luis@mail.com";
        $user2->password = bcrypt("luis54321");
        $user2->save();

        $user3 = new User();
        $user3->name = "SUPER-ADMINISTRADOR";
        $user3->email = "superadmin@mail.com";
        $user3->password = bcrypt("super54321");
        $user3->save();

        // roles
        $rol1 = new Role();
        $rol1->nombre = "SUPERADMIN";
        $rol1->save();
        
        $rol2 = new Role();
        $rol2->nombre = "ADMIN";
        $rol2->save();

        $rol3 = new Role();
        $rol3->nombre = "CAJERO";
        $rol3->save();

        // permisos

        $per0 = new Permiso();
        $per0->nombre = "manage_all";
        $per0->save();

        $per1 = new Permiso();
        $per1->nombre = "index_producto";
        $per1->save();

        $per2 = new Permiso();
        $per2->nombre = "guardar_producto";
        $per2->save();

        $per3 = new Permiso();
        $per3->nombre = "mostrar_producto";
        $per3->save();

        $per4 = new Permiso();
        $per4->nombre = "modificar_producto";
        $per4->save();

        $per5 = new Permiso();
        $per5->nombre = "eliminar_producto";
        $per5->save();
        
        // asignar permisos a roles y roles a usuario
        $rol1->permisos()->attach([$per0->id]);
        $rol2->permisos()->attach([$per1->id, $per2->id, $per3->id, $per4->id, $per5->id]);
        $rol3->permisos()->attach([$per1->id, $per3->id]);

        // asignar role a usuario
        $user3->roles()->attach([$rol1->id]);

        $user1->roles()->attach([$rol2->id]);
        $user2->roles()->attach([$rol3->id]);
        
    }
}
