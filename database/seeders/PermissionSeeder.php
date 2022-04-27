<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::query()->truncate();
        $this->seedPermissions();
    }

    public function seedPermissions()
    {
        $data = array(

            #contact-us
            [
                'name' =>  "contact-us-read",
                'label' => "نمایش پیامهای تماس با ما",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #about
            [
                'name' =>  "about-read",
                'label' => "نمایش در باره ما",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "about-update",
                'label' => "ویرایش درباره ما",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #policies
            [
                'name' =>  "policies-read",
                'label' => "نمایش قوانین",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "policies-update",
                'label' => "ویرایش قوانین",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #news
            [
                'name' =>  "news-read",
                'label' => "نمایش اخبار اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "news-update",
                'label' => "ویرایش اخبار اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "news-create",
                'label' => "ایجاد اخبار اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "news-delete",
                'label' => "حذف اخبار اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #faq-cat
            [
                'name' =>  "faq-cat-read",
                'label' => "نمایش دسته بندی ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-cat-update",
                'label' => "ویرایش دسته بندی ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-cat-create",
                'label' => "ایجاد دسته بندی ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-cat-delete",
                'label' => "حذف دسته بندی ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #faq
            [
                'name' =>  "faq-read",
                'label' => "نمایش پرس و پاسخ ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-update",
                'label' => "ویرایش پرس و پاسخ ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-create",
                'label' => "ایجاد پرس و پاسخ ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "faq-delete",
                'label' => "حذف پرس و پاسخ ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #site-content
            [
                'name' =>  "site-content-read",
                'label' => "نمایش سایر اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-content-update",
                'label' => "ویرایش سایر اطلاعات",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #commission-text
            [
                'name' =>  "commission-text-read",
                'label' => "نمایش  راهنمای کارمزد",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "commission-text-update",
                'label' => "ویرایش راهنمای کارمزد",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #commission
            [
                'name' =>  "commission-read",
                'label' => "نمایش کارمزد معاملات",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "commission-update",
                'label' => "ویرایش کارمزد معاملات",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #market
            [
                'name' =>  "market-read",
                'label' => "نمایش مدیرت مارکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "market-update",
                'label' => "ویرایش مدیرت مارکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #wallet-address
            [
                'name' =>  "wallet-address-create",
                'label' => "ایجاد آدرس ها کیف پول",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "wallet-address-read",
                'label' => "نمایش آدرس ها کیف پول",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "wallet-address-check",
                'label' => "بررسی آدرس ها کیف پول",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #slideshow
            [
                'name' =>  "slideshow-create",
                'label' => "ایجاد اسلاید شو",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "slideshow-read",
                'label' => "نمایش اسلاید شو",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "slideshow-update",
                'label' => "ویرایش اسلاید شو",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "slideshow-delete",
                'label' => "حذف اسلاید شو",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #currency
            [
                'name' =>  "ticket-create",
                'label' => "ایجاد تیکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "ticket-read",
                'label' => "نمایش تیکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "ticket-update",
                'label' => "ویرایش تیکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "ticket-delete",
                'label' => "حذف تیکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "ticket-reply",
                'label' => "پاسخ تیکت ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],


            #site-fee
            [
                'name' =>  "site-fee-read",
                'label' => "مشاهده گزارش عملکرد",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #report-wallet
            [
                'name' =>  "report-wallet-read",
                'label' => "مشاهده گزارش صندوق",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "report-wallet-user-balance",
                'label' => "مشاهده موجودی کاربران در گزارش صندوق",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #transaction
            [
                'name' =>  "transaction-read",
                'label' => "مشاهده گردش حساب کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #withdraws
            [
                'name' =>  "withdraws-read",
                'label' => "مشاهده برداشتهای رمز ارزی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "withdraws-confirmation",
                'label' => "تایید و عدم تایید برداشتهای رمز ارزی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "withdraws-pay",
                'label' => "پرداخت برداشتهای رمز ارزی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #withdrawsIrt
            [
                'name' =>  "withdraws-irt-read",
                'label' => "مشاهده برداشتهای ریالی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "withdraws-irt-confirmation",
                'label' => "تایید و عدم تایید برداشتهای ریالی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "withdraws-irt-pay",
                'label' => "پرداخت برداشتهای ریالی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #order
            [
                'name' =>  "order-read",
                'label' => "نمایش سفارشها",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #currency
            [
                'name' =>  "currency-create",
                'label' => "ایجاد رمز ارز",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "currency-read",
                'label' => "نمایش رمز ارز",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "currency-update",
                'label' => "ویرایش رمز ارز",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "currency-delete",
                'label' => "حذف رمز ارز",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #deposit_irt
            [
                'name' =>  "deposit-irt-read",
                'label' => "نمایش واریز ریالی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #deposit
            [
                'name' =>  "deposit-read",
                'label' => "نمایش واریز رمز ارزی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "deposit-confirmation",
                'label' => "تایید و عدم تایید واریز ها",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #site_transaction
            [
                'name' =>  "site-transaction-create",
                'label' => "ایجاد تراکنشهای کیفهای خارجی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-transaction-read",
                'label' => "مشاهده تراکنشهای کیفهای خارجی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-transaction-delete",
                'label' => "حذف تراکنشهای کیفهای خارجی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #site_settings
            [
                'name' =>  "site-settings-create",
                'label' => "ایجاد تنظیمات سایت",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-settings-read",
                'label' => "نمایش تنظیمات سایت",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-settings-update",
                'label' => "ویرایش تنظیمات سایت",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "site-settings-delete",
                'label' => "حذف تنظیمات سایت",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #bank_accounts
            [
                'name' =>  "bank-account-create",
                'label' => "ایجاد حساب بانکی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "bank-account-read",
                'label' => "نمایش حساب بانکی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "bank-account-update",
                'label' => "ویرایش حساب بانکی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "bank-account-delete",
                'label' => "حذف حساب بانکی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #log
            [
                'name' => 'api-log-read',
                'label' => "مشاهده فراخوانی های api",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'activity-log-read',
                'label' => "مشاهده ریز فعالیت های سایت",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            # users
            [
                'name' =>  "user-create",
                'label' => "ایجاد کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-read",
                'label' => "نمایش کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-update",
                'label' => "ویرایش کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-delete",
                'label' => "حذف کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-auth",
                'label' => "احراز هویت کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-hard-update",
                'label' => "ویرایش تمامی اطلاعات کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-pics-read",
                'label' => "مشاهده تصاویر کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-pics-delete",
                'label' => "حذف تصاویر کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            # wallet
            [
                'name' =>  "user-wallet-read",
                'label' => "مشاهده کیف پول کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "user-wallet-manual-deposit-withdraw",
                'label' => " تغییر موجودی کیف پول کاربر",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            # permissions
            [
                'name' =>  "permission-create",
                'label' => "ایجاد دسترسی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "permission-read",
                'label' => "نمایش دسترسی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "permission-update",
                'label' => "ویرایش دسترسی",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "permission-delete",
                'label' => "حذف دسترسی",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            # roles
            [
                'name' =>  "role-create",
                'label' => "ایجادنقش",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "role-read",
                'label' => "نمایش نقش",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "role-update",
                'label' => "ویرایش نقش",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "role-delete",
                'label' => "حذف نقش",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            #adnin
            [
                'name' =>  "admin-create",
                'label' => "ایجاد ادمین",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "admin-read",
                'label' => "نمایش ادمین",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "admin-update",
                'label' => "ویرایش ادمین",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "admin-delete",
                'label' => "حذف ادمین",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  "admin-self-read",
                'label' => "نمایش پروفایل مدیر"
            ],
            [
                'name' =>  "admin-self-update",
                'label' => "ویرایش پروفایل مدیر"
            ],

        );


        $idCounter = 1;
        foreach ($data as $object) {
            Permission::create([
                'id' => $idCounter++,
                'name' => $object['name'],
                'label' => $object['label'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
