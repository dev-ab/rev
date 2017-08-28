<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = \App\User::create(['name' => 'abdou', 'username' => 'abdou', 'phone' => '', 'image' => '', 'email' => 'abdulrahman@toptal.com', 'password' => bcrypt('abdou')]);
        $role = \App\Role::create(['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'A system administrator']);
        $user->attachRole($role);

        //Group 1
        $wp = App\WorkPoint::create(['number' => 1000000, 'name' => 'الأصول', 'initial' => 1, 'level' => 1]);


        //level 2
        $wp1 = App\WorkPoint::create(['number' => 1100000, 'name' => 'الموجودات غير المتداولة', 'initial' => 1, 'level' => 2]);
        $wp1->theParent()->associate($wp)->save();
        $wp2 = App\WorkPoint::create(['number' => 1200000, 'name' => 'الموجودات المتداولة', 'initial' => 1, 'level' => 2]);
        $wp2->theParent()->associate($wp)->save();


        //level 3
        $wp11 = App\WorkPoint::create(['number' => 1110000, 'name' => 'الاصول الثابته', 'initial' => 1, 'level' => 3]);
        $wp11->theParent()->associate($wp1)->save();
        $wp12 = App\WorkPoint::create(['number' => 1120000, 'name' => 'مشروعات تحت التنفيذ', 'initial' => 1, 'level' => 3]);
        $wp12->theParent()->associate($wp1)->save();
        $wp13 = App\WorkPoint::create(['number' => 1130000, 'name' => 'أصول مستأجرة منتهية بالتملك', 'initial' => 1, 'level' => 3]);
        $wp13->theParent()->associate($wp1)->save();
        $wp14 = App\WorkPoint::create(['number' => 1140000, 'name' => 'نفقات إيرادية مؤجلة	', 'initial' => 1, 'level' => 3]);
        $wp14->theParent()->associate($wp1)->save();

        $wp21 = App\WorkPoint::create(['number' => 1210000, 'name' => 'بنوك', 'initial' => 1, 'level' => 3]);
        $wp21->theParent()->associate($wp2)->save();
        $wp22 = App\WorkPoint::create(['number' => 1220000, 'name' => 'صندوق وعهد مستديمة', 'initial' => 1, 'level' => 3]);
        $wp22->theParent()->associate($wp2)->save();
        $wp23 = App\WorkPoint::create(['number' => 1230000, 'name' => 'مدينون', 'initial' => 1, 'level' => 3]);
        $wp23->theParent()->associate($wp2)->save();
        $wp24 = App\WorkPoint::create(['number' => 1240000, 'name' => 'مخزون', 'initial' => 1, 'level' => 3]);
        $wp24->theParent()->associate($wp2)->save();
        $wp25 = App\WorkPoint::create(['number' => 1250000, 'name' => 'أطراف ذات علاقة مدينة', 'initial' => 1, 'level' => 3]);
        $wp25->theParent()->associate($wp2)->save();
        $wp26 = App\WorkPoint::create(['number' => 1260000, 'name' => 'أرصدة مدينة أخرى', 'initial' => 1, 'level' => 3]);
        $wp26->theParent()->associate($wp2)->save();


        //level 4
        $wp111 = App\WorkPoint::create(['number' => 1110001, 'name' => 'مبانى وانشاءات', 'initial' => 1, 'level' => 4]);
        $wp111->theParent()->associate($wp11)->save();
        $wp112 = App\WorkPoint::create(['number' => 1110002, 'name' => 'سيارات', 'initial' => 1, 'level' => 4]);
        $wp112->theParent()->associate($wp11)->save();
        $wp113 = App\WorkPoint::create(['number' => 1110003, 'name' => 'أراضى', 'initial' => 1, 'level' => 4]);
        $wp113->theParent()->associate($wp11)->save();
        $wp114 = App\WorkPoint::create(['number' => 1110004, 'name' => 'آلات ومعدات', 'initial' => 1, 'level' => 4]);
        $wp114->theParent()->associate($wp11)->save();
        $wp115 = App\WorkPoint::create(['number' => 1110005, 'name' => 'عدد وادوات', 'initial' => 1, 'level' => 4]);
        $wp115->theParent()->associate($wp11)->save();
        $wp116 = App\WorkPoint::create(['number' => 1110006, 'name' => 'أجهزة كهربائية', 'initial' => 1, 'level' => 4]);
        $wp116->theParent()->associate($wp11)->save();
        $wp117 = App\WorkPoint::create(['number' => 1110007, 'name' => 'حاسب آلى', 'initial' => 1, 'level' => 4]);
        $wp117->theParent()->associate($wp11)->save();

        $wp121 = App\WorkPoint::create(['number' => 1120001, 'name' => 'مشروع 1', 'initial' => 1, 'level' => 4]);
        $wp121->theParent()->associate($wp12)->save();
        $wp122 = App\WorkPoint::create(['number' => 1120002, 'name' => 'مشروع 2', 'initial' => 1, 'level' => 4]);
        $wp122->theParent()->associate($wp12)->save();

        $wp131 = App\WorkPoint::create(['number' => 1130001, 'name' => 'سيارة 1', 'initial' => 1, 'level' => 4]);
        $wp131->theParent()->associate($wp13)->save();
        $wp132 = App\WorkPoint::create(['number' => 1130002, 'name' => 'سيارة 2', 'initial' => 1, 'level' => 4]);
        $wp132->theParent()->associate($wp13)->save();

        $wp141 = App\WorkPoint::create(['number' => 1140001, 'name' => 'أعباء تمويل سيارة 1', 'initial' => 1, 'level' => 4]);
        $wp141->theParent()->associate($wp14)->save();
        $wp142 = App\WorkPoint::create(['number' => 1140002, 'name' => 'أعباء تمويل سيارة 1', 'initial' => 1, 'level' => 4]);
        $wp142->theParent()->associate($wp14)->save();

        $wp211 = App\WorkPoint::create(['number' => 1210001, 'name' => 'بنك 1', 'initial' => 1, 'level' => 4]);
        $wp211->theParent()->associate($wp21)->save();
        $wp212 = App\WorkPoint::create(['number' => 1210002, 'name' => 'بنك 2', 'initial' => 1, 'level' => 4]);
        $wp212->theParent()->associate($wp21)->save();

        $wp221 = App\WorkPoint::create(['number' => 1220001, 'name' => 'صندوق', 'initial' => 1, 'level' => 4]);
        $wp221->theParent()->associate($wp22)->save();
        $wp222 = App\WorkPoint::create(['number' => 1220002, 'name' => 'عهد', 'initial' => 1, 'level' => 4]);
        $wp222->theParent()->associate($wp22)->save();

        $wp231 = App\WorkPoint::create(['number' => 1230001, 'name' => 'عميل 1', 'initial' => 1, 'level' => 4]);
        $wp231->theParent()->associate($wp23)->save();
        $wp232 = App\WorkPoint::create(['number' => 1230002, 'name' => 'عميل 2', 'initial' => 1, 'level' => 4]);
        $wp232->theParent()->associate($wp23)->save();

        $wp241 = App\WorkPoint::create(['number' => 1240001, 'name' => 'مستودع 1', 'initial' => 1, 'level' => 4]);
        $wp241->theParent()->associate($wp24)->save();
        $wp242 = App\WorkPoint::create(['number' => 1240002, 'name' => 'مستودع 2', 'initial' => 1, 'level' => 4]);
        $wp242->theParent()->associate($wp24)->save();

        $wp251 = App\WorkPoint::create(['number' => 1250001, 'name' => 'مؤسسة 1', 'initial' => 1, 'level' => 4]);
        $wp251->theParent()->associate($wp25)->save();
        $wp252 = App\WorkPoint::create(['number' => 1250002, 'name' => 'مؤسسة 2', 'initial' => 1, 'level' => 4]);
        $wp252->theParent()->associate($wp25)->save();

        $wp261 = App\WorkPoint::create(['number' => 1260001, 'name' => 'دفعات مقدمة للموردين', 'initial' => 1, 'level' => 4]);
        $wp261->theParent()->associate($wp26)->save();
        $wp262 = App\WorkPoint::create(['number' => 1260002, 'name' => 'مصروفات مدفوعة مقدماً', 'initial' => 1, 'level' => 4]);
        $wp262->theParent()->associate($wp26)->save();
        $wp263 = App\WorkPoint::create(['number' => 1260003, 'name' => 'ذمم عاملين', 'initial' => 1, 'level' => 4]);
        $wp263->theParent()->associate($wp26)->save();
        $wp264 = App\WorkPoint::create(['number' => 1260004, 'name' => 'عهد مؤقتة', 'initial' => 1, 'level' => 4]);
        $wp264->theParent()->associate($wp26)->save();
        $wp265 = App\WorkPoint::create(['number' => 1260005, 'name' => 'تأمينات لدى الغير', 'initial' => 1, 'level' => 4]);
        $wp265->theParent()->associate($wp26)->save();


        //Group2
        $wp = App\WorkPoint::create(['number' => 2000000, 'name' => 'الخصوم', 'initial' => 1, 'level' => 1]);

        //level 2
        $wp1 = App\WorkPoint::create(['number' => 2100000, 'name' => 'الخصوم المتداولة', 'initial' => 1, 'level' => 2]);
        $wp1->theParent()->associate($wp)->save();
        $wp2 = App\WorkPoint::create(['number' => 2200000, 'name' => 'الخصوم الغير متداولة', 'initial' => 1, 'level' => 2]);
        $wp2->theParent()->associate($wp)->save();


        //level 3
        $wp11 = App\WorkPoint::create(['number' => 2110000, 'name' => 'الدائنون', 'initial' => 1, 'level' => 3]);
        $wp11->theParent()->associate($wp1)->save();
        $wp12 = App\WorkPoint::create(['number' => 2120000, 'name' => 'الجزء المتداول من دائنو شراء الاصول', 'initial' => 1, 'level' => 3]);
        $wp12->theParent()->associate($wp1)->save();
        $wp13 = App\WorkPoint::create(['number' => 2130000, 'name' => 'أطراف ذات علاقة دائنة', 'initial' => 1, 'level' => 3]);
        $wp13->theParent()->associate($wp1)->save();
        $wp14 = App\WorkPoint::create(['number' => 2140000, 'name' => 'مصروفات مستحقة', 'initial' => 1, 'level' => 3]);
        $wp14->theParent()->associate($wp1)->save();
        $wp15 = App\WorkPoint::create(['number' => 2150000, 'name' => 'ارصدة دائنة اخرى', 'initial' => 1, 'level' => 3]);
        $wp15->theParent()->associate($wp1)->save();
        $wp16 = App\WorkPoint::create(['number' => 2160000, 'name' => 'مخصصات', 'initial' => 1, 'level' => 3]);
        $wp16->theParent()->associate($wp1)->save();
        $wp17 = App\WorkPoint::create(['number' => 2170000, 'name' => 'قروض قصيرة الأجل', 'initial' => 1, 'level' => 3]);
        $wp17->theParent()->associate($wp1)->save();

        $wp21 = App\WorkPoint::create(['number' => 2210000, 'name' => 'قروض طويلة الأجل', 'initial' => 1, 'level' => 3]);
        $wp21->theParent()->associate($wp2)->save();


        //level 4
        $wp111 = App\WorkPoint::create(['number' => 2110001, 'name' => 'مورد 1', 'initial' => 1, 'level' => 4]);
        $wp111->theParent()->associate($wp11)->save();
        $wp112 = App\WorkPoint::create(['number' => 2110002, 'name' => 'مورد 2', 'initial' => 1, 'level' => 4]);
        $wp112->theParent()->associate($wp11)->save();

        $wp121 = App\WorkPoint::create(['number' => 2120001, 'name' => 'سيارة 1', 'initial' => 1, 'level' => 4]);
        $wp121->theParent()->associate($wp12)->save();
        $wp122 = App\WorkPoint::create(['number' => 2120002, 'name' => 'سيارة 2', 'initial' => 1, 'level' => 4]);
        $wp122->theParent()->associate($wp12)->save();

        $wp131 = App\WorkPoint::create(['number' => 2130001, 'name' => 'شركة', 'initial' => 1, 'level' => 4]);
        $wp131->theParent()->associate($wp13)->save();
        $wp132 = App\WorkPoint::create(['number' => 2130002, 'name' => 'مؤسسة', 'initial' => 1, 'level' => 4]);
        $wp132->theParent()->associate($wp13)->save();

        $wp141 = App\WorkPoint::create(['number' => 2140001, 'name' => 'رواتب مستحقة', 'initial' => 1, 'level' => 4]);
        $wp141->theParent()->associate($wp14)->save();
        $wp142 = App\WorkPoint::create(['number' => 2140002, 'name' => 'اتعاب مهنية', 'initial' => 1, 'level' => 4]);
        $wp142->theParent()->associate($wp14)->save();

        $wp151 = App\WorkPoint::create(['number' => 2150001, 'name' => 'دفعات مقدمة من العملاء', 'initial' => 1, 'level' => 4]);
        $wp151->theParent()->associate($wp15)->save();
        $wp152 = App\WorkPoint::create(['number' => 2150002, 'name' => 'ذمم دائنة', 'initial' => 1, 'level' => 4]);
        $wp152->theParent()->associate($wp15)->save();
        $wp153 = App\WorkPoint::create(['number' => 2150003, 'name' => 'عهد دائنة', 'initial' => 1, 'level' => 4]);
        $wp153->theParent()->associate($wp15)->save();
        $wp154 = App\WorkPoint::create(['number' => 2150004, 'name' => 'أوراق دفع', 'initial' => 1, 'level' => 4]);
        $wp154->theParent()->associate($wp15)->save();
        $wp155 = App\WorkPoint::create(['number' => 2150005, 'name' => 'تأمينات للغير', 'initial' => 1, 'level' => 4]);
        $wp155->theParent()->associate($wp15)->save();

        $wp161 = App\WorkPoint::create(['number' => 2160001, 'name' => 'مخصص الزكاة', 'initial' => 1, 'level' => 4]);
        $wp161->theParent()->associate($wp16)->save();

        $wp171 = App\WorkPoint::create(['number' => 2170001, 'name' => 'قرض 1', 'initial' => 1, 'level' => 4]);
        $wp171->theParent()->associate($wp17)->save();
        $wp172 = App\WorkPoint::create(['number' => 2170002, 'name' => 'قرض 2', 'initial' => 1, 'level' => 4]);
        $wp172->theParent()->associate($wp17)->save();

        $wp211 = App\WorkPoint::create(['number' => 2210001, 'name' => 'قرض 1', 'initial' => 1, 'level' => 4]);
        $wp211->theParent()->associate($wp21)->save();
        $wp212 = App\WorkPoint::create(['number' => 2210002, 'name' => 'قرض 2', 'initial' => 1, 'level' => 4]);
        $wp212->theParent()->associate($wp21)->save();
    }

}
