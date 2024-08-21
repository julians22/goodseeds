<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('content.aboutTitle', '');
        $this->migrator->add('content.aboutDescription', 'We are a consulting firm on a mission to empower business owners to scale up and sustain their enterprises by delivering end-to-end, customized solutions, including consulting, coaching & mentoring, training, and recruitment. Our approach is tailored to meet your specific needs and goals. We focus on creating long- term value by setting the right strategy, optimizing your business operations, and nurturing your people for sustained growth.');
        $this->migrator->add('content.servicesTitle', 'WHAT WE DO');
        $this->migrator->add('content.provideTitle', 'WHAT YOU GET');
        $this->migrator->add('content.diagramImage', '');
        $this->migrator->add('content.diagramImageMobile', '');
        $this->migrator->add('content.approachTitle', 'OUR APPROACH');
        $this->migrator->add('content.approachDescription', "At goodseeds.id, we understand that no two businesses are alike. That's why we take the time to understand your unique challenges and goals. Our holistic, customized, and structured approach is key to achieving your specific objectives and sustainable success. Here’s how we do it:");
    }
};
