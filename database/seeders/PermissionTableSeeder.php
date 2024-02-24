<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'invoices list',
            'add invoice',
            'invoice trashed',
            'invoices status',
            'invoice paid',
            'unpaid invoice',
            'partially paid invoice',
            'delete invoice',
            'show invoice',
            'invoice edit',
            'print invoice',
            'invoice force',
            'invoice restore',

            'reports',
            'invoices report',
            'customer report',

            'users',
            'user list',
            'add user',
            'edit user',
            'delete user',

            'user permissions',

            'settings',
            'add file',
            'EXCEL EXPORT',

            'payment status change',
            'delete file',

            'view permission',
            'show permission',
            'add permission',
            'edit permission',
            'delete permission',

            'products',
            'add product',
            'edit product',
            'delete product',

            'sections',
            'add section',
            'edit section',
            'delete section',

            'notifications',

            // 'الفواتير',
            // 'قائمة الفواتير',
            // 'الفواتير المدفوعة',
            // 'الفواتير المدفوعة جزئيا',
            // 'الفواتير الغير مدفوعة',
            // 'ارشيف الفواتير',
            // 'التقارير',
            // 'تقرير الفواتير',
            // 'تقرير العملاء',
            // 'المستخدمين',
            // 'قائمة المستخدمين',
            // 'صلاحيات المستخدمين',
            // 'الاعدادات',
            // 'المنتجات',
            // 'الاقسام',


            // 'اضافة فاتورة',
            // 'حذف الفاتورة',
            // 'تصدير EXCEL',
            // 'تغير حالة الدفع',
            // 'تعديل الفاتورة',
            // 'ارشفة الفاتورة',
            // 'طباعةالفاتورة',
            // 'اضافة مرفق',
            // 'حذف المرفق',

            // 'اضافة مستخدم',
            // 'تعديل مستخدم',
            // 'حذف مستخدم',

            // 'عرض صلاحية',
            // 'اضافة صلاحية',
            // 'تعديل صلاحية',
            // 'حذف صلاحية',

            // 'اضافة منتج',
            // 'تعديل منتج',
            // 'حذف منتج',

            // 'اضافة قسم',
            // 'تعديل قسم',
            // 'حذف قسم',
            // 'الاشعارات',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
