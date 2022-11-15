<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Setting::create(['key' => 'photo_home', 'value'=> '',]);
       Setting::create(['key' => 'features', 'value'=> 'توفير طرق دفع مختلفة	',]);
       Setting::create(['key' => 'features', 'value'=> 'توقع احتياجات العملاء	',]);
       Setting::create(['key' => 'features', 'value'=> 'معالجة مشاكل المنتجات بسرعة	',]);
       Setting::create(['key' => 'screen_shot', 'value'=> '',]);
       Setting::create(['key' => 'background_terms', 'value'=> '',]);
       Setting::create(['key' => 'terms', 'value'=> 'يجب على المستخدمين إنشاء حساب على المتجر لشراء أي عنصر من متجر	',]);
       Setting::create(['key' => 'terms', 'value'=> 'لا يتحمل المتجر المسؤولية عن القضايا القانونية وغيرها',]);
       Setting::create(['key' => 'terms', 'value'=> 'لا يتحمل المتجر المسؤولية عن القضايا القانونية وغيرها',]);
       Setting::create(['key' => 'question_1', 'value'=> 'ما هي طرق الدفع المتاح بالمتجر	',]);
       Setting::create(['key' => 'question_2', 'value'=> 'كيف يمكنني الغاء الطلب	',]);
       Setting::create(['key' => 'question_3', 'value'=> 'ما هي المناطق المتوفرة للتوصيل	',]);
       Setting::create(['key' => 'question_4', 'value'=> 'ما هي الحالات المسموح بها ارجاع الطلب بعد التسليم	',]);
       Setting::create(['key' => 'question_5', 'value'=> 'طريقة الابلاغ عن مشكلة	',]);
       Setting::create(['key' => 'question_6', 'value'=> 'الوقت المستغرق لارجاع الأموال بعد الغاء الطلب	',]);
       Setting::create(['key' => 'answer_1', 'value'=> 'يمكنك الدفع عن طريق الباي بال أو جوال باي أو الماستر كاش',]);
       Setting::create(['key' => 'answer_2', 'value'=> 'عن طريق الذهاب الى الصفحة الشخصية ثم طلباتي ثم تختار الطلب المراد إلغاءه وتضغط على كلمة إلغاء',]);
       Setting::create(['key' => 'answer_3', 'value'=> 'جميع مناطق قطاع غزة (الجنوب _ الوسطى _ غزة_الشمال)',]);
       Setting::create(['key' => 'answer_4', 'value'=> 'في حالة اختلاف المنتج المطلوب عن المنتح المستلم وفي حالة تلف المنتج المستلم',]);
       Setting::create(['key' => 'answer_5', 'value'=> 'عن طريق الذهاب الى اعدادت التطبيق ثم الابلاغ عن مشكلة	',]);
       Setting::create(['key' => 'answer_6', 'value'=> 'بعد يومين من تأكيد عملية الإلغاء	',]);
       Setting::create(['key' => 'phone', 'value'=> '00972595162557',]);
       Setting::create(['key' => 'email', 'value'=> 'onlinestore@app.com',]);
       Setting::create(['key' => 'address', 'value'=> 'غزة - تل الهوى	',]);
       Setting::create(['key' => 'background_download', 'value'=> '',]);
       Setting::create(['key' => 'download_link', 'value'=> '',]);
       Setting::create(['key' => 'logo', 'value'=> '',]);
       Setting::create(['key' => 'logo_header', 'value'=> '',]);
       Setting::create(['key' => 'facebook_link', 'value'=> '',]);
       Setting::create(['key' => 'twitter_link', 'value'=> '',]);
       Setting::create(['key' => 'instagram_link', 'value'=> '',]);
       Setting::create(['key' => 'loading', 'value'=> '',]);
       Setting::create(['key' => 'title', 'value'=> 'متجر اليوكاس',]);

    }
}
