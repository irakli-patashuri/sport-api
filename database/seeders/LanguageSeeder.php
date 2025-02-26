<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            ['id' => 1, 'locale' => 'afghan', 'name' => 'پښتو', 'dir' => 'rtl', 'status' => 1],
            ['id' => 2, 'locale' => 'arab', 'name' => 'عربى', 'dir' => 'rtl', 'status' => 1],
            ['id' => 3, 'locale' => 'armenia', 'name' => 'Հայերէն', 'dir' => 'ltr', 'status' => 1],
            ['id' => 4, 'locale' => 'aze', 'name' => 'Azərbaycan dili', 'dir' => 'ltr', 'status' => 1],
            ['id' => 5, 'locale' => 'bulgaria', 'name' => 'Български', 'dir' => 'ltr', 'status' => 1],
            ['id' => 6, 'locale' => 'ch', 'name' => '普通话', 'dir' => 'ltr', 'status' => 1],
            ['id' => 7, 'locale' => 'croatian', 'name' => 'Hrvatski', 'dir' => 'ltr', 'status' => 1],
            ['id' => 8, 'locale' => 'elvish', 'name' => 'Elvish', 'dir' => 'ltr', 'status' => 1],
            ['id' => 9, 'locale' => 'en', 'name' => 'English', 'dir' => 'ltr', 'status' => 1],
            ['id' => 10, 'locale' => 'es', 'name' => 'Español', 'dir' => 'ltr', 'status' => 1],
            ['id' => 11, 'locale' => 'fr', 'name' => 'Français', 'dir' => 'ltr', 'status' => 1],
            ['id' => 12, 'locale' => 'geo', 'name' => 'ქართული', 'dir' => 'ltr', 'status' => 1],
            ['id' => 13, 'locale' => 'ger', 'name' => 'Deutsch', 'dir' => 'ltr', 'status' => 1],
            ['id' => 14, 'locale' => 'greek', 'name' => 'ελληνικά', 'dir' => 'ltr', 'status' => 1],
            ['id' => 15, 'locale' => 'hebrew', 'name' => 'עברית', 'dir' => 'rtl', 'status' => 1],
            ['id' => 16, 'locale' => 'hindi', 'name' => 'हिन्दी', 'dir' => 'ltr', 'status' => 1],
            ['id' => 17, 'locale' => 'hodor', 'name' => 'Hodor', 'dir' => 'ltr', 'status' => 1],
            ['id' => 18, 'locale' => 'ir', 'name' => 'فارسی', 'dir' => 'rtl', 'status' => 1],
            ['id' => 19, 'locale' => 'it', 'name' => 'Italiano', 'dir' => 'ltr', 'status' => 1],
            ['id' => 20, 'locale' => 'jp', 'name' => '日本語', 'dir' => 'ltr', 'status' => 1],
            ['id' => 21, 'locale' => 'kazakh', 'name' => 'Қазақ тілі', 'dir' => 'ltr', 'status' => 1],
            ['id' => 22, 'locale' => 'klingon', 'name' => 'Klingon', 'dir' => 'ltr', 'status' => 1],
            ['id' => 23, 'locale' => 'korea', 'name' => '한국어', 'dir' => 'ltr', 'status' => 1],
            ['id' => 24, 'locale' => 'kurdish', 'name' => 'Kurmancî', 'dir' => 'ltr', 'status' => 1],
            ['id' => 25, 'locale' => 'mogol', 'name' => 'монгол', 'dir' => 'ltr', 'status' => 1],
            ['id' => 26, 'locale' => 'norway', 'name' => 'Norsk', 'dir' => 'ltr', 'status' => 1],
            ['id' => 27, 'locale' => 'orcish', 'name' => 'Orcish', 'dir' => 'ltr', 'status' => 1],
            ['id' => 28, 'locale' => 'polish', 'name' => 'Polski', 'dir' => 'ltr', 'status' => 1],
            ['id' => 29, 'locale' => 'portugese', 'name' => 'Português', 'dir' => 'ltr', 'status' => 1],
            ['id' => 30, 'locale' => 'romanian', 'name' => 'Română', 'dir' => 'ltr', 'status' => 1],
            ['id' => 31, 'locale' => 'ru', 'name' => 'Русский', 'dir' => 'ltr', 'status' => 1],
            ['id' => 32, 'locale' => 'scotish', 'name' => 'Gàidhlig', 'dir' => 'ltr', 'status' => 1],
            ['id' => 33, 'locale' => 'serbian', 'name' => 'srpski', 'dir' => 'ltr', 'status' => 1],
            ['id' => 34, 'locale' => 'slovak', 'name' => 'slovenčina', 'dir' => 'ltr', 'status' => 1],
            ['id' => 35, 'locale' => 'tajik', 'name' => 'тоҷикӣ', 'dir' => 'ltr', 'status' => 1],
            ['id' => 36, 'locale' => 'thai', 'name' => 'ภาษาไทย', 'dir' => 'ltr', 'status' => 1],
            ['id' => 37, 'locale' => 'turk', 'name' => 'Türkçe', 'dir' => 'ltr', 'status' => 1],
            ['id' => 38, 'locale' => 'ukrainian', 'name' => 'українська', 'dir' => 'ltr', 'status' => 1],
            ['id' => 39, 'locale' => 'uzbek', 'name' => 'Ўзбек', 'dir' => 'ltr', 'status' => 1],
            ['id' => 40, 'locale' => 'vietnam', 'name' => 'Tiếng', 'dir' => 'ltr', 'status' => 1],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(['id' => $language['id']], $language);
        }
    }
}
