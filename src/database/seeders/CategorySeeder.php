<?php

namespace Database\Seeders;

use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->skipBecauseOfEnvironment()) {
            return;
        }

        if ($this->skipBecauseRecordsExist()) {
            return;
        }

        Category::factory(10)->create();
    }

    private function skipBecauseOfEnvironment(): bool
    {
        if (!App::environment(['local', 'staging'])) {
            $this->command->info("本番環境の可能性があるためSeederの実行をスキップしました。");
            return true;
        }

        return false;
    }

    private function skipBecauseRecordsExist(): bool
    {
        if (Category::count() > 0) {
            $this->command->info('既にレコードが存在するためCategorySeederをスキップしました。');
            return true;
        }

        return false;
    }
}
