<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['section_key' => 'slider',        'title' => 'Relive the Moments of Discovery'],
            ['section_key' => 'international',  'title' => 'International Edu Tour'],
            ['section_key' => 'outstation',     'title' => 'Outstation - Excursion'],
            ['section_key' => 'edufun',         'title' => 'Edufun Hands-On Adventures'],
            ['section_key' => 'dayouting',      'title' => 'Day Outing'],
        ];

        foreach ($sections as $section) {
            Gallery::firstOrCreate(
                ['section_key' => $section['section_key']],
                ['title'       => $section['title']]
            );
        }
    }
}