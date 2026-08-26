<?php
namespace Database\Seeders;
use App\Models\LoginInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        LoginInfo::updateOrCreate(['userName' => 'admin'], ['password' => Hash::make('admin123')]);
    }
}
