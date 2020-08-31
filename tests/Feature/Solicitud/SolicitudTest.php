<?php

namespace Tests\Feature\Solicitud;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Solicitud;

class SolicitudTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_single_sol()
    {
        $this->withoutExceptionHandling();
        $solicitud = factory(\App\Rol::class)->create();
        $response = $this->getJson('api/solicitud/list');
        $response->assertSee($solicitud->title);
    }
}
