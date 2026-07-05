<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $demoUser = User::factory()->create([
            'name' => 'Demo',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
        ]);

        $demoLinks = [
            ['original_url' => 'https://laravel.com/docs', 'code' => 'laravel'],
            ['original_url' => 'https://filamentphp.com/docs/3.x/panels/installation', 'code' => 'panel3'],
            ['original_url' => 'https://example.com/special-offer', 'code' => 'offer1'],
        ];

        foreach ($demoLinks as $linkData) {
            $link = $demoUser->shortLinks()->create($linkData);

            $link->clicks()->createMany(
                collect(range(1, fake()->numberBetween(3, 10)))
                    ->map(fn () => [
                        'ip_address' => fake()->ipv4(),
                        'created_at' => fake()->dateTimeBetween('-14 days'),
                        'updated_at' => now(),
                    ])
                    ->all()
            );
        }

        User::factory(3)
            ->create()
            ->each(function (User $user): void {
                ShortLink::factory(fake()->numberBetween(2, 4))
                    ->for($user)
                    ->create()
                    ->each(function (ShortLink $link): void {
                        $link->clicks()->createMany(
                            collect(range(1, fake()->numberBetween(1, 8)))
                                ->map(fn () => [
                                    'ip_address' => fake()->ipv4(),
                                    'created_at' => fake()->dateTimeBetween('-30 days'),
                                    'updated_at' => now(),
                                ])
                                ->all()
                        );
                    });
            });
    }
}
