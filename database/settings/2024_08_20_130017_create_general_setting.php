<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.headerLogo', '');
        $this->migrator->add('general.footerLogo', '');
        $this->migrator->add('general.siteAddress', '');
        $this->migrator->add('general.socialMediaLinks', []);
    }
};
