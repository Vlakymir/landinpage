<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaginaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_inicio()
    {
        $response = $this->get('/landingpage');

        $response->assertStatus(200);
    }
    /** @test */
    public function recibe_codigo()
    {
        $response = $this->get('/contacto/1234');
        $response->assertStatus(200);
        $this->assertEquals('Alejandro', $response['nombre']);
    }
    
    /** @test */
    public function formulario()
    {
        $response = $this->get('/contacto');
        $response->assertStatus(200);
    }

    /** @test */
    public function recibe_info()
    {
        $response = $this->post('/recibe-informacion', [
            'nombre' => ' ',
            'email'=> '2345678',
            'comentario'=> 'ae',
        ]);

        $response->assertSessionHasErrors([  
            'nombre',
            'email',
            'comentario',
        ]);
    }
}
