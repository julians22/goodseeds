<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('content.aboutTitle', '');
        $this->migrator->add('content.aboutDescription', 'We are a consulting firm on a mission to empower business owners to scale up and sustain their enterprises by delivering end-to-end, customized solutions, including consulting, coaching & mentoring, training, and recruitment. Our approach is tailored to meet your specific needs and goals. We focus on creating long- term value by setting the right strategy, optimizing your business operations, and nurturing your people for sustained growth.');
        $this->migrator->add('content.servicesTitle', [
            'en' => 'WHAT WE DO',
            'id' => 'APA YANG KAMI LAKUKAN',
        ]);
        $this->migrator->add('content.servicesNewTitle', [
            'en' => 'WHAT WE DO',
            'id' => 'APA YANG KAMI LAKUKAN',
        ]);

        $this->migrator->add('content.servicesDescription', [
            'en' => 'We provide end-to-end HR and business solutions...',
            'id' => 'Kami menyediakan solusi bisnis dan SDM end-to-end...',
        ]);
        $this->migrator->add('content.provideTitle', 'WHAT YOU GET');
        $this->migrator->add('content.diagramImage', '');
        $this->migrator->add('content.diagramImageMobile', '');
        $this->migrator->add('content.servicesNewTitle', [
            'en' => 'OUR APPROACH',
            'id' => 'PENDEKATAN KAMI',
        ]);

        $this->migrator->add('content.servicesDescription', [
            'en' => 'We provide end-to-end HR and business solutions...',
            'id' => 'Kami menyediakan solusi bisnis dan SDM end-to-end...',
        ]);
   }
};
