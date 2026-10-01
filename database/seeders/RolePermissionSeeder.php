<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();


        $guard = 'web';



        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // Users
            'users.view',
            'users.create',
            'users.update',
            'users.delete',


            // Roles & Permissions
            'roles.view',
            'roles.manage',



            // Company
            'companies.view',
            'companies.create',
            'companies.update',


            // Branches
            'branches.view',
            'branches.create',
            'branches.update',



            // Warehouses
            'warehouses.view',
            'warehouses.create',
            'warehouses.update',



            // Categories
            'categories.view',
            'categories.create',
            'categories.update',
            'categories.delete',



            // Units
            'units.view',
            'units.create',
            'units.update',



            // Products
            'products.view',
            'products.create',
            'products.update',
            'products.delete',



            // Inventory
            'inventory.view',
            'inventory.transfer',
            'inventory.adjust',
            'inventory.movements',



            // Suppliers
            'suppliers.view',
            'suppliers.create',
            'suppliers.update',



            // Purchasing
            'purchase_orders.view',
            'purchase_orders.create',
            'purchase_orders.update',
            'purchase_orders.approve',


            'goods_receipts.view',
            'goods_receipts.create',



            // Customers
            'customers.view',
            'customers.create',
            'customers.update',



            // Sales
            'sales_orders.view',
            'sales_orders.create',
            'sales_orders.update',
            'sales_orders.approve',


            'deliveries.view',
            'deliveries.create',


            'sales_invoices.view',
            'sales_invoices.create',



            // Accounting
            'accounts.view',

            'journal_entries.view',
            'journal_entries.create',

            'reports.view',



            // Audit
            'audit.view',

        ];



        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard
            ]);
        }





        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */


        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => $guard
        ]);



        $companyAdmin = Role::firstOrCreate([
            'name' => 'company_admin',
            'guard_name' => $guard
        ]);



        $warehouseManager = Role::firstOrCreate([
            'name' => 'warehouse_manager',
            'guard_name' => $guard
        ]);



        $salesManager = Role::firstOrCreate([
            'name' => 'sales_manager',
            'guard_name' => $guard
        ]);



        $procurementOfficer = Role::firstOrCreate([
            'name' => 'procurement_officer',
            'guard_name' => $guard
        ]);



        $accountant = Role::firstOrCreate([
            'name' => 'accountant',
            'guard_name' => $guard
        ]);



        $auditor = Role::firstOrCreate([
            'name' => 'auditor',
            'guard_name' => $guard
        ]);






        /*
        |--------------------------------------------------------------------------
        | Assign Permissions
        |--------------------------------------------------------------------------
        */



        // صلاحيات كاملة
        $superAdmin->syncPermissions(
            Permission::all()
        );





        // مدير الشركة

        $companyAdmin->syncPermissions([

            'users.view',
            'users.create',
            'users.update',

            'companies.view',
            'companies.update',

            'branches.view',
            'branches.create',
            'branches.update',

            'warehouses.view',

            'products.view',

            'reports.view',

        ]);






        // مدير المخزن

        $warehouseManager->syncPermissions([

            'products.view',

            'inventory.view',
            'inventory.transfer',
            'inventory.adjust',
            'inventory.movements',

            'warehouses.view',

            'goods_receipts.view',
            'goods_receipts.create',

        ]);







        // مدير المبيعات

        $salesManager->syncPermissions([

            'customers.view',
            'customers.create',
            'customers.update',

            'sales_orders.view',
            'sales_orders.create',
            'sales_orders.update',
            'sales_orders.approve',

            'deliveries.view',
            'deliveries.create',

            'sales_invoices.view',
            'sales_invoices.create',

        ]);







        // مسؤول المشتريات

        $procurementOfficer->syncPermissions([

            'suppliers.view',
            'suppliers.create',
            'suppliers.update',

            'purchase_orders.view',
            'purchase_orders.create',
            'purchase_orders.update',

            'goods_receipts.view',
            'goods_receipts.create',

        ]);







        // المحاسب

        $accountant->syncPermissions([

            'accounts.view',

            'journal_entries.view',
            'journal_entries.create',

            'sales_invoices.view',

            'reports.view',

        ]);







        // المراجع

        $auditor->syncPermissions([

            'audit.view',

            'reports.view',

            'products.view',

            'inventory.view',

            'sales_orders.view',

            'purchase_orders.view',

        ]);
    }
}
