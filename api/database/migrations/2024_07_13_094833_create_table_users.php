<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            <<<SQL
            CREATE TABLE IF NOT EXISTS `users` (
                `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(45) NOT NULL,
                `email` VARCHAR(90) NOT NULL,
                `birth_date` DATE NOT NULL,
                `password` VARCHAR(297) NOT NULL,
                `profile_picture_url` VARCHAR(60) NULL,
                `type` ENUM('admin', 'regular'),
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NOT NULL,
                PRIMARY KEY (`id`),
                INDEX `email_idx` (`email`)
            )
            SQL,
        );

        DB::unprepared(
            <<<SQL
            INSERT INTO `users` (
                `id`,
                `name`,
                `email`,
                `birth_date`,
                `password`,
                `profile_picture_url`,
                `type`,
                `created_at`,
                `updated_at`
            ) VALUES (
                NULL,
                'Admin',
                'admin@gmail.com',
                '2002-07-12',
                '$2y$12$6NeRRglyOz1Bj6XdqOz7.e2ocy3EXixtt6JBSD8z72IAlrmrFCtFS',
                'https://avatars.githubusercontent.com/u/72869261?v=4',
                'admin',
                '2024-07-13 15:30:52',
                '2024-07-13 15:30:52'
            );
            SQL,
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared(
            <<<SQL
            DROP TABLE IF EXISTS `users`;
            SQL,
        );
    }
};
