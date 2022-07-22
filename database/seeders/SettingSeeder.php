<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->INSERT([
            [
                'key' => 'title_admin',
                'value' => 'MMZ PKL'
            ],
            [
                'key' => 'website_name',
                'value' => 'Hệ thống website thương mại điện tử'
            ],
            [
                'key' => 'website_description',
                'value' => 'Hệ thống website thương mại điện tử',
            ],
            [
                'key' => 'website_phone',
                'value' => '1900 63 68 09',
            ],
            [
                'key' => 'website_hotline',
                'value' => '1900 63 68 09',
            ],
            [
                'key' => 'website_fax',
                'value' => '1900 63 68 09',
            ],
            [
                'key' => 'admin_email',
                'value' => 'minh171112b@gmail.com',
            ],
            [
                'key' => 'website_copyright',
                'value' => '',
            ],
            [
                'key' => 'website_address',
                'value' => 'Nhân Mỹ, Phường Mỹ Đình 1, Quận Nam Từ Liêm, TP Hà Nội',
            ],
            [
                'key' => 'company_city',
                'value' => 'Hà Nội',
            ],
            [
                'key' => 'company_district',
                'value' => 'Hà Nội',
            ],
            [
                'key' => 'company_postal_code',
                'value' => '26000',
            ],
            [
                'key' => 'company_lat',
                'value' => 'Hải Dương',
            ],
            [
                'key' => '_social_skype',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_social_facebook',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_social_google_plus',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_social_youtube',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_social_twitter',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_social_instagram',
                'value' => 'https://fb.com',
            ],
            [
                'key' => '_google_analytics_id',
                'value' => '',
            ],
            [
                'key' => 'format_date',
                'value' => 'd-m-Y',
            ],
            [
                'key' => 'format_datetime',
                'value' => 'Y-m-d H:i',
            ],
            [
                'key' => 'format_time',
                'value' => 'H:i',
            ],
            [
                'key' => 'website_header',
                'value' => '',
            ],
            [
                'key' => 'website_footer',
                'value' => '',
            ],
            [
                'key' => 'website_body',
                'value' => '',
            ],
            [
                'key' => 'website_css',
                'value' => '',
            ],
            [
                'key' => 'website_fanpage',
                'value' => '',
            ],
            [
                'key' => 'website_logo',
                'value' => '',
            ],
            [
                'key' => 'website_favicon',
                'value' => '',
            ],
            [
                'key' => 'sms_server',
                'value' => 'smtp.gmail.com',
            ],
            [
                'key' => 'sms_port',
                'value' => '587',
            ],
            [
                'key' => 'sms_username',
                'value' => 'minh171112b@gmail.com',
            ],
            [
                'key' => 'sms_password',
                'value' => '',
            ]
        ]);
    }
}
