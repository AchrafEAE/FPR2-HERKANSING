<?php

namespace Tests\Feature;

use Tests\TestCase;

class ErrorPageTest extends TestCase
{
    public function testUnknownPageShowsCustomNotFoundPage(): void
    {
        $this->get('/pagina-die-niet-bestaat')
            ->assertNotFound()
            ->assertSee('Pagina niet gevonden')
            ->assertSee('Controleer de URL');
    }

    public function testServerErrorViewCanBeRendered(): void
    {
        $this->view('errors.500')
            ->assertSee('Er ging iets mis')
            ->assertSee('Opnieuw proberen');
    }
}
