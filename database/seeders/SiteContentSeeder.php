<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteContent::query()->truncate();
        $this->seedSiteContents();
    }

    public function seedSiteContents()
    {
        $objects = [
            [
                'tag' => 'site',
                'key' => 'status',
                'value' => 1,
            ],
            [
                'tag' => 'site',
                'key' => 'message',
                'value' => '',
            ],
            [
                'tag' => 'content',
                'key' => 'about_us',
                'value' => 'خرید و فروش ارز دیجیتال بدون واسطه بهترین و ساده‌ترین راه برای نگه‌داری، خرید و فروش ارزهای دیجیتال در ایران که امنیت آن توسط تی بیتو تضمین می‌شود. خرید و فروش ارز دیجیتال بدون واسطه بهترین و ساده‌ترین راه برای نگه‌داری، خرید و فروش ارزهای دیجیتال در ایران که امنیت آن توسط تی بیتو تضمین می‌شود.',
            ],
            [
                'tag' => 'content',
                'key' => 'rules',
                'value' => '',
            ],
            [
                'tag' => 'content',
                'key' => 'commissions',
                'value' => '',
            ],
            [
                'tag' => 'banner',
                'key' => 'src1',
                'value' => '',
            ],
            [
                'tag' => 'banner',
                'key' => 'link1',
                'value' => '',
            ],
            [
                'tag' => 'banner',
                'key' => 'src2',
                'value' => '',
            ],
            [
                'tag' => 'banner',
                'key' => 'link2',
                'value' => '',
            ],
            [
                'tag' => 'contact_info',
                'key' => 'support',
                'value' => 'همه روزه از ساعت ۸صبح تا ۳ بامداد 02191070771',
            ],
            [
                'tag' => 'contact_info',
                'key' => 'trade',
                'value' => 'همه روزه حتی در ایام تعطیل',
            ],
            [
                'tag' => 'contact_info',
                'key' => 'auth',
                'value' => 'همه روزه بجز ایام تعطیل از ساعت ۸صبح تا ۱۷ عصر',
            ],
            [
                'tag' => 'contact_info',
                'key' => 'address',
                'value' => 'ایران، تهران، منطقه ۲، سعادت آباد، سرو غربی، خیابان صدف، تی بیتو',
            ],
            [
                'tag' => 'socials',
                'key' => 'telegram',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'instagram',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'aparat',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'youtube',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'linkedin',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'facebook',
                'value' => '#',
            ],
            [
                'tag' => 'socials',
                'key' => 'twitter',
                'value' => '#',
            ],
            [
                'tag' => 'app',
                'key' => 'android',
                'value' => '#',
            ],
            [
                'tag' => 'app',
                'key' => 'ios',
                'value' => '#',
            ],
            [
                'tag' => 'stats',
                'key' => 'users',
                'value' => '150,000',
            ],
            [
                'tag' => 'stats',
                'key' => 'trades',
                'value' => '+1.4M',
            ],
            [
                'tag' => 'stats',
                'key' => 'trade_volume',
                'value' => '+200B',
            ],
        ];

        $idCounter = 1;
        foreach ($objects as $object) {
            $obj = new SiteContent();
            $obj->tag = $object['tag'];
            $obj->key = $object['key'];
            $obj->value = $object['value'];
            $obj->save();
            $idCounter++;
        }
    }
}
