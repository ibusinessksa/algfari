<?php

namespace Tests\Feature\Api\V1;

use App\Models\AppSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInfoTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_info_is_public(): void
    {
        $s = AppSetting::current();
        $s->fill([
            'contact_phone' => '+966500000000',
            'contact_email' => 'info@algfari.test',
            'twitter_url' => 'https://x.com/algfari',
        ])->save();

        $response = $this->getJson('/api/v1/contact-info');

        $response->assertOk()
            ->assertJsonStructure(['contact_phone', 'contact_whatsapp', 'contact_email', 'social' => ['twitter']]);

        $this->assertSame('+966500000000', $response->json('contact_phone'));
        $this->assertSame('info@algfari.test', $response->json('contact_email'));
        $this->assertSame('https://x.com/algfari', $response->json('social.twitter'));
    }
}
