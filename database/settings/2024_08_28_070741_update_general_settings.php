<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.whatsappContactNumber', '');
        $this->migrator->add('general.whatsappContactMessage', '');
    }

    public function down(): void
    {
        $this->migrator->delete('general.whatsappContactNumber');
        $this->migrator->delete('general.whatsappContactMessage');
    }
};
