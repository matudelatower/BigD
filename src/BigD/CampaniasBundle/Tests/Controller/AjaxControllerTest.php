<?php

namespace BigD\CampaniasBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxControllerTest extends WebTestCase
{
    public function testAgregarpreguntas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/agregar_preguntas');
    }

}
