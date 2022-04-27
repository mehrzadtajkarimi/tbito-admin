<?php

namespace Database\Seeders;

use App\Models\Gateway;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::query()->truncate();
        $this->seedGlobalSettings();
    }

    public function seedGlobalSettings()
    {
        $objects = [
            [
                'tag' => 'otp',
                'key' => 'otp_resendable_at',
                'value' => '2',
                'title' => 'زمان لازم برای فعال شدن قابلیت ارسال مجدد کد تایید',
                'text' => 'دقیقه',
                'editable' => true
            ],
            [
                'tag' => 'otp',
                'key' => 'max_otp_try_counts',
                'value' => '3',
                'title' => 'دفعات مجاز برای وارد کردن کد تایید',
                'text' => 'مرتبه',
                'editable' => true
            ],
            [
                'tag' => 'otp',
                'key' => 'email_otp_expires_in',
                'value' => '15',
                'title' => 'زمان مجاز برای وارد کردن کد تایید ارسالی به ایمیل',
                'text' => 'دقیقه',
                'editable' => true
            ],
            [
                'tag' => 'otp',
                'key' => 'mobile_otp_expires_in',
                'value' => '5',
                'title' => 'زمان مجاز برای وارد کردن کد تایید ارسالی به موبایل',
                'text' => 'دقیقه',
                'editable' => true
            ],

            [
                'tag' => 'referral',
                'key' => 'refcode_deadline',
                'value' => '72',
                'title' => 'زمان مجاز برای وارد کردن کد معرف',
                'text' => 'ساعت',
                'editable' => true
            ],

            [
                'tag' => 'referral',
                'key' => 'referral_percent',
                'value' => '30',
                'title' => 'سهم معرف از کارمزد ترید',
                'text' => 'درصد',
                'editable' => true
            ],

            [
                'tag' => 'verification_flags',
                'key' => 'verified',
                'value' => 1,
                'title' => 'وضعیت تایید',
                'text' => 'تایید شده',
                'editable' => false
            ],
            [
                'tag' => 'verification_flags',
                'key' => 'unverified',
                'value' => 0,
                'title' => 'وضعیت تایید',
                'text' => 'تایید نشده',
                'editable' => false
            ],
            [
                'tag' => 'verification_flags',
                'key' => 'pending',
                'value' => 2,
                'title' => 'وضعیت تایید',
                'text' => 'در انتظار تایید',
                'editable' => false
            ],
            [
                'tag' => 'verification_flags',
                'key' => 'unknown',
                'value' => null,
                'title' => 'وضعیت تایید',
                'text' => 'نامشخص',
                'editable' => false
            ],

            [
                'tag' => 'priority',
                'key' => 'high',
                'value' => 1,
                'title' => 'اولویت',
                'text' => 'زیاد',
                'editable' => false
            ],

            [
                'tag' => 'priority',
                'key' => 'normal',
                'value' => 2,
                'title' => 'اولویت',
                'text' => 'متوسط',
                'editable' => false
            ],

            [
                'tag' => 'priority',
                'key' => 'low',
                'value' => 3,
                'title' => 'اولویت',
                'text' => 'کم',
                'editable' => false
            ],

            [
                'tag' => 'ticket_status',
                'key' => 'pending',
                'value' => 1,
                'title' => 'وضعیت تیکت',
                'text' => 'در انتظار بررسی',
                'editable' => false
            ],

            [
                'tag' => 'ticket_status',
                'key' => 'awaiting_response',
                'value' => 2,
                'title' => 'وضعیت تیکت',
                'text' => 'در حال بررسی',
                'editable' => false
            ],

            [
                'tag' => 'ticket_status',
                'key' => 'customer_reply',
                'value' => 3,
                'title' => 'وضعیت تیکت',
                'text' => 'پاسخ مشتری',
                'editable' => false
            ],

            [
                'tag' => 'ticket_status',
                'key' => 'admin_reply',
                'value' => 4,
                'title' => 'وضعیت تیکت',
                'text' => 'پاسخ پشتیبان',
                'editable' => false
            ],

            [
                'tag' => 'ticket_status',
                'key' => 'closed',
                'value' => 5,
                'title' => 'وضعیت تیکت',
                'text' => 'بسته شده',
                'editable' => false
            ],

            [
                'tag' => 'deposit_type',
                'key' => 'toman',
                'value' => 1,
                'title' => 'نوع واریز',
                'text' => 'واریز تومان',
                'editable' => false
            ],

            [
                'tag' => 'deposit_type',
                'key' => 'crypto',
                'value' => 2,
                'title' => 'نوع واریز',
                'text' => 'واریز رمز ارز',
                'editable' => false
            ],

            [
                'tag' => 'transaction_type',
                'key' => 'deposit',
                'value' => 1,
                'title' => 'نوع تراکنش',
                'text' => 'واریز',
                'editable' => false
            ],

            [
                'tag' => 'transaction_type',
                'key' => 'order',
                'value' => 2,
                'title' => 'نوع تراکنش',
                'text' => 'معامله',
                'editable' => false
            ],

            [
                'tag' => 'transaction_type',
                'key' => 'withdraw',
                'value' => 3,
                'title' => 'نوع تراکنش',
                'text' => 'برداشت',
                'editable' => false
            ],

            [
                'tag' => 'transaction_type',
                'key' => 'referral',
                'value' => 4,
                'title' => 'نوع تراکنش',
                'text' => 'رفرال',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_type',
                'key' => 'toman',
                'value' => 1,
                'title' => 'نوع برداشت',
                'text' => 'برداشت تومان',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_type',
                'key' => 'crypto',
                'value' => 2,
                'title' => 'نوع برداشت',
                'text' => 'برداشت رمزارز',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_status',
                'key' => 'pending',
                'value' => 1,
                'title' => 'وضعیت درخواست برداشت',
                'text' => 'در انتظار بررسی',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_status',
                'key' => 'confirmed',
                'value' => 2,
                'title' => 'وضعیت درخواست برداشت',
                'text' => 'تایید شده',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_status',
                'key' => 'processing',
                'value' => 3,
                'title' => 'وضعیت درخواست برداشت',
                'text' => 'در حال واریز',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_status',
                'key' => 'done',
                'value' => 4,
                'title' => 'وضعیت درخواست برداشت',
                'text' => 'انجام شده',
                'editable' => false
            ],

            [
                'tag' => 'withdraw_status',
                'key' => 'canceled',
                'value' => 5,
                'title' => 'وضعیت درخواست برداشت',
                'text' => 'لغو شده',
                'editable' => false
            ],

            [
                'tag' => 'deposit_gateway',
                'key' => 'min_amount',
                'value' => '100000',
                'title' => 'کمترین مقدار قابل پرداخت از طریق درگاه بانکی جهت شارژ کیف پول - تومان',
                'text' => 'تومان',
                'editable' => true
            ],

            [
                'tag' => 'desc',
                'key' => 'deposit_card_check_failed',
                'value' => 1,
                'title' => 'توضیحات',
                'text' => 'واریز شده از کارت بانکی غیر از کارت اعلام شده',
                'editable' => false
            ],

            [
                'tag' => 'desc',
                'key' => 'unverified_deposit_by_bank',
                'value' => 2,
                'title' => 'توضیحات',
                'text' => 'عدم تایید پرداخت از سمت بانک',
                'editable' => false
            ],

            [
                'tag' => 'order_type',
                'key' => 'limit',
                'value' => 1,
                'title' => 'نوع سفارش',
                'text' => 'limit',
                'editable' => false
            ],

            [
                'tag' => 'order_type',
                'key' => 'market',
                'value' => 2,
                'title' => 'نوع سفارش',
                'text' => 'market',
                'editable' => false
            ],

            [
                'tag' => 'order_type',
                'key' => 'stop',
                'value' => 3,
                'title' => 'نوع سفارش',
                'text' => 'stop',
                'editable' => false
            ],

            [
                'tag' => 'order_type',
                'key' => 'oco',
                'value' => 4,
                'title' => 'نوع سفارش',
                'text' => 'oco',
                'editable' => false
            ],

            [
                'tag' => 'order_side',
                'key' => 'buy',
                'value' => 1,
                'title' => 'جهت سفارش',
                'text' => 'خرید',
                'editable' => false
            ],

            [
                'tag' => 'order_side',
                'key' => 'sell',
                'value' => 2,
                'title' => 'جهت سفارش',
                'text' => 'فروش',
                'editable' => false
            ],

            [
                'tag' => 'order_status',
                'key' => 'done',
                'value' => 1,
                'title' => 'وضعیت سفارش',
                'text' => 'انجام شده',
                'editable' => false
            ],

            [
                'tag' => 'order_status',
                'key' => 'open',
                'value' => 2,
                'title' => 'وضعیت سفارش',
                'text' => 'باز',
                'editable' => false
            ],

            [
                'tag' => 'order_status',
                'key' => 'canceled',
                'value' => 3,
                'title' => 'وضعیت سفارش',
                'text' => 'لغو شده',
                'editable' => false
            ],

            [
                'tag' => 'order_status',
                'key' => 'expired',
                'value' => 4,
                'title' => 'وضعیت سفارش',
                'text' => 'منقضی شده',
                'editable' => false
            ],

            [
                'tag' => 'order_status',
                'key' => 'draft',
                'value' => 5,
                'title' => 'وضعیت سفارش',
                'text' => 'پیش نویس',
                'editable' => false
            ],

            [
                'tag' => 'consume_status',
                'key' => 'not_consumed',
                'value' => 0,
                'title' => 'وضعیت بررسی پیام در بروکر',
                'text' => 'مصرف نشده',
                'editable' => false
            ],

            [
                'tag' => 'consume_status',
                'key' => 'consumed',
                'value' => 1,
                'title' => 'وضعیت بررسی پیام در بروکر',
                'text' => 'مصرف شده',
                'editable' => false
            ],

            [
                'tag' => 'markets',
                'key' => 'USDTIRT',
                'value' => 25000,
                'title' => 'نرخ تتر',
                'text' => 'تومان',
                'editable' => true
            ],

            [
                'tag' => 'currency_status',
                'key' => 'active',
                'value' => 1,
                'title' => 'وضعیت ارز',
                'text' => 'فعال',
                'editable' => false
            ],

            [
                'tag' => 'currency_status',
                'key' => 'inactive',
                'value' => 0,
                'title' => 'وضعیت ارز',
                'text' => 'غیرفعال',
                'editable' => false
            ],

            [
                'tag' => 'currency_status',
                'key' => 'soon',
                'value' => 2,
                'title' => 'وضعیت ارز',
                'text' => 'به زودی',
                'editable' => false
            ],

            [
                'tag' => 'login_status',
                'key' => 'successful',
                'value' => 1,
                'title' => 'وضعیت ورود به سیستم',
                'text' => 'موفق',
                'editable' => false
            ],

            [
                'tag' => 'login_status',
                'key' => 'unsuccessful',
                'value' => 0,
                'title' => 'وضعیت ورود به سیستم',
                'text' => 'ناموفق',
                'editable' => false
            ],

            [
                'tag' => 'deposit_status',
                'key' => 'successful',
                'value' => 1,
                'title' => 'وضعیت واریز',
                'text' => 'موفق',
                'editable' => false
            ],

            [
                'tag' => 'deposit_status',
                'key' => 'unsuccessful',
                'value' => 0,
                'title' => 'وضعیت واریز',
                'text' => 'ناموفق',
                'editable' => false
            ],

            [
                'tag' => 'deposit_status',
                'key' => 'awaiting_approval',
                'value' => 2,
                'title' => 'وضعیت واریز',
                'text' => 'در انتظار تایید',
                'editable' => false
            ],

            [
                'tag' => 'currency_wallet_generator',
                'key' => 'api',
                'value' => 1,
                'title' => 'نوع تولید کیف پول',
                'text' => 'استفاده از سرور تولید کننده کیف پول',
                'editable' => false
            ],

            [
                'tag' => 'currency_wallet_generator',
                'key' => 'database',
                'value' => 2,
                'title' => 'نوع تولید کیف پول',
                'text' => 'استفاده از دیتابیس داخلی و آدرس های تولید شده',
                'editable' => false
            ],

            [
                'tag' => 'creation_type',
                'key' => 'automatic',
                'value' => 1,
                'title' => 'طریقه ایجاد رکورد',
                'text' => 'سیستمی',
                'editable' => false
            ],

            [
                'tag' => 'creation_type',
                'key' => 'manual',
                'value' => 2,
                'title' => 'طریقه ایجاد رکورد',
                'text' => 'دستی',
                'editable' => false
            ],

            [
                'tag' => 'payment_type',
                'key' => 'automatic',
                'value' => 1,
                'title' => 'طریقه پرداخت',
                'text' => 'سیستمی',
                'editable' => false
            ],

            [
                'tag' => 'payment_type',
                'key' => 'manual',
                'value' => 2,
                'title' => 'طریقه پرداخت',
                'text' => 'دستی',
                'editable' => false
            ],

            [
                'tag' => 'confirm_type',
                'key' => 'automatic',
                'value' => 1,
                'title' => 'طریقه تایید',
                'text' => 'سیستمی',
                'editable' => false
            ],

            [
                'tag' => 'confirm_type',
                'key' => 'manual',
                'value' => 2,
                'title' => 'طریقه تایید',
                'text' => 'دستی',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_type',
                'key' => 'user_withdraw',
                'value' => 1,
                'title' => 'تراکنش از کیف پولهای سایت',
                'text' => 'جهت درخواست برداشت کاربر',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_type',
                'key' => 'cost',
                'value' => 2,
                'title' => 'تراکنش از کیف پولهای سایت',
                'text' => 'هزینه',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_type',
                'key' => 'income',
                'value' => 3,
                'title' => 'تراکنش از کیف پولهای سایت',
                'text' => 'درآمد',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_type',
                'key' => 'transfer',
                'value' => 4,
                'title' => 'تراکنش از کیف پولهای سایت',
                'text' => 'انتقال به منابع مالی دیگر',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_destination',
                'key' => 'user',
                'value' => 1,
                'title' => 'مقصد تراکنش از کیف پول سایت',
                'text' => 'مشتری',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_destination',
                'key' => 'cold_wallet',
                'value' => 2,
                'title' => 'مقصد تراکنش از کیف پول سایت',
                'text' => 'کیف پول سخت افزاری',
                'editable' => false
            ],

            [
                'tag' => 'site_transaction_destination',
                'key' => 'other',
                'value' => 3,
                'title' => 'مقصد تراکنش از کیف پول سایت',
                'text' => 'مقاصد دیگر',
                'editable' => false
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'user_id',
                'value' => 107,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'شناسه کاربری',
                'editable' => false
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'user_token',
                'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMGEwNWQyYzY5YmVjN2Q2YjhmNzdkY2MwNzJmNTllYjBiZDk2MGMxNGZmM2YzODE3MGNlNWYwYWE4Nzc0NmY3NDg4NzdjYWM0Yjc5NTRhMDQiLCJpYXQiOjE2MDUzMzUxMDgsIm5iZiI6MTYwNTMzNTEwOCwiZXhwIjoxNjM2ODcxMTA4LCJzdWIiOiIxMDciLCJzY29wZXMiOltdfQ.MESmg4lz1p2vZpwweoqqFmGeJmWwNpevhBTfN86zgA-ru01dnNXwd5NGl8lWETLY2MwLxLROjkw_eHdftHCzz1SMsutUHJwa4YM12v3j2F9WEnDADLyvl3Ll_AD3SrYbKRW9I8JMDNz6Ueq_6ehMsxdEnbSQHYb-6qcXptmgSMtIwtppnRnbOycZ5fvD0O4VSwbIAGcXG80c88j0c03kBcc47-QqktqRrc2a5FJc6w2EMz3aqt1DTs1-nuDja7mjmKrELPYjlrBynYfS89JoIyv0EuTXjgQhoUgj7x8P0Unbso3CR46Uu64cMtsIy4gdVfDQtgX-iH9qcivV_aZPExcLV3AWoX5-suglQKn5DoMSX3vY1S1icEUvigWZWRgihRlnNk71XK68qEEW7WTBPzns7ppUi7UxSfbdIz8m6cqsqhrUYG_izjcBBMqMY6hKqWWBDifUw5iM0n1iJDZ7N5A3r-6Stto0nUhdMTGXUOAHD3Wt4srlkHguQUUyor0a5vSsKBfnfDaFnffgzLxmMolebDkzDJHsmmlC1Y4TdTr5aIkKqnZ2jWttOloep_VYQ6_z233iwACKcEjbMznYVbU-gbeyP2yif1SsdOev8rbNd5omuZ_S5GgwN0NzMbsQTX5crmQrQsPN618UeYSWZkGOud5qvT2YT9nPTxlKsfo',
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'توکن در صرافی داخلی',
                'editable' => false
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'token',
                'value' => '90add14ab7c66c68b6c11c41f6b704a0a0810298',
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'توکن در صرافی خارجی',
                'editable' => false
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_numbers',
                'value' => 4,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'تعداد سفارشات در هر مارکت',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_diff_percent_1',
                'value' => 0.2,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد تغییر قیمت نسبت به صرافی همکار برای سفارش اول',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_diff_percent_2',
                'value' => 0.3,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد تغییر قیمت نسبت به صرافی همکار برای سفارش دوم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_diff_percent_3',
                'value' => 0.4,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد تغییر قیمت نسبت به صرافی همکار برای سفارش سوم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_diff_percent_4',
                'value' => 0.5,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد تغییر قیمت نسبت به صرافی همکار برای سفارش چهارم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_diff_percent_5',
                'value' => 0.6,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد تغییر قیمت نسبت به صرافی همکار برای سفارش پنجم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_vol_1',
                'value' => 0.3,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد حجم معامله از موجودی برای سفارش اول',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_vol_2',
                'value' => 0.25,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد حجم معامله از موجودی برای سفارش دوم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_vol_3',
                'value' => 0.2,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد حجم معامله از موجودی برای سفارش سوم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_vol_4',
                'value' => 0.15,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد حجم معامله از موجودی برای سفارش چهارم',
                'editable' => true
            ],

            [
                'tag' => 'trader_bot',
                'key' => 'order_vol_5',
                'value' => 0.1,
                'title' => 'تنظیمات ربات تریدر',
                'text' => 'درصد حجم معامله از موجودی برای سفارش پنجم',
                'editable' => true
            ],


        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new SiteSetting();
            $obj->id = $idCounter;
            $obj->key = $object['key'];
            $obj->value = $object['value'];
            $obj->tag = $object['tag'];
            $obj->title = $object['title'];
            $obj->text = $object['text'];
            $obj->editable = $object['editable'];
            $obj->save();
            $idCounter++;
        }
    }
}
