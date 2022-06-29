<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('role_has_permissions')->truncate();

        // create permissions
        Permission::updateOrCreate(['name' => 'administration']);
        Permission::updateOrCreate(['name' => 'documents']);
        Permission::updateOrCreate(['name' => 'documents.send']);
        Permission::updateOrCreate(['name' => 'employee']);
        Permission::updateOrCreate(['name' => 'employee.update']);
        Permission::updateOrCreate(['name' => 'expedient']);
        Permission::updateOrCreate(['name' => 'expedient.view']);
        Permission::updateOrCreate(['name' => 'expedient.create']);
        Permission::updateOrCreate(['name' => 'expedient.update']);
        Permission::updateOrCreate(['name' => 'expedient.delete']);
        Permission::updateOrCreate(['name' => 'expedient.own']);
        Permission::updateOrCreate(['name' => 'expedient.status.update']);
        Permission::updateOrCreate(['name' => 'gabinete']);
        Permission::updateOrCreate(['name' => 'gabinete.allEmployees']);
        Permission::updateOrCreate(['name' => 'gabinete.create']);
        Permission::updateOrCreate(['name' => 'gabinete.update']);
        Permission::updateOrCreate(['name' => 'gabinete.delete']);
        Permission::updateOrCreate(['name' => 'gabinete.expedients.view']);
        Permission::updateOrCreate(['name' => 'password.update']);
        Permission::updateOrCreate(['name' => 'product.']);
        Permission::updateOrCreate(['name' => 'product.create']);
        Permission::updateOrCreate(['name' => 'product.update']);
        Permission::updateOrCreate(['name' => 'product.delete']);
        Permission::updateOrCreate(['name' => 'roles']);
        Permission::updateOrCreate(['name' => 'roles.create']);
        Permission::updateOrCreate(['name' => 'roles.update']);
        Permission::updateOrCreate(['name' => 'roles.delete']);
        Permission::updateOrCreate(['name' => 'subcontractor']);
        Permission::updateOrCreate(['name' => 'subcontractor.create']);
        Permission::updateOrCreate(['name' => 'subcontractor.update']);
        Permission::updateOrCreate(['name' => 'subcontractor.delete']);
        Permission::updateOrCreate(['name' => 'user']);
        Permission::updateOrCreate(['name' => 'user.create']);
        Permission::updateOrCreate(['name' => 'user.update']);
        Permission::updateOrCreate(['name' => 'user.delete']);
        Permission::updateOrCreate(['name' => 'zipCoverage']);
        Permission::updateOrCreate(['name' => 'zipCoverage.create']);
        Permission::updateOrCreate(['name' => 'zipCoverage.update']);
        Permission::updateOrCreate(['name' => 'zipCoverage.delete']);

        $user = User::find(1);
        $adminRole = Role::updateOrCreate(['name' => 'Super Admin'], [
            'level' => 100,
            'description' => 'Los super-administradores tienen un control total sobre la herramienta',
            'background_color' => 'green-100',
            'text_color' => 'green-800',
        ]);

        $user->assignRole($adminRole);

        // updateOrCreate roles and assign existing permissions
        Role::updateOrCreate(['name' => 'Administrator'], [
            'level' => 80,
            'description' => 'Los administradores pueden realizar cualquier acción',
            'background_color' => 'green-100',
            'text_color' => 'green-800',
        ])
            ->givePermissionTo('user')
            ->givePermissionTo('roles.update')
            ->givePermissionTo('password.update')
            ->givePermissionTo('expedient')
            ->givePermissionTo('gabinete.update')
            ->givePermissionTo('gabinete.expedients.view')
            ->givePermissionTo('expedient.status.update');
        //ß->givePermissionTo('documents.send');

        Role::updateOrCreate(['name' => 'TechManager'], [
            'level' => 60,
            'description' => 'Los directores técnicos pueden realizar cualquier acción relacionada con trabajos y salidas, además de acceder a la cuenta de facturación',
            'background_color' => 'blue-100',
            'text_color' => 'blue-800',
        ])
            ->givePermissionTo('user.create')
            ->givePermissionTo('user.update');
        //->givePermissionTo('documents.send');

        Role::updateOrCreate(['name' => 'Technician'], [
            'level' => 40,
            'description' => 'Los técnicos solo pueden editar sus propios trabajos y salidas',
            'background_color' => 'yellow-100',
            'text_color' => 'yellow-800',
        ])
            ->givePermissionTo('expedient.own');

        Role::updateOrCreate(['name' => 'Accountant'], [
            'level' => 60,
            'description' => 'Los usuarios con acceso a facturación pueden acceder a la información contable',
            'background_color' => 'blue-100',
            'text_color' => 'blue-800',
        ])
            ->givePermissionTo('user.create')
            ->givePermissionTo('roles.update')
            ->givePermissionTo('user.update');

        Role::updateOrCreate(['name' => 'Administrative'], [
            'level' => 40,
            'description' => 'Los administrativos pueden consultar, crear y actualizar encargos, además de acceder a la cuenta de facturación',
            'background_color' => 'yellow-100',
            'text_color' => 'yellow-800',
        ])
            ->givePermissionTo('expedient.own');
    }
}
