<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;

class MainInstagramPageControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        
        $this->assertResponseIsSuccessful();
    }

    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/create');

        $form = $crawler->selectButton('Create')->form();
        // Set form data and submit the form
        $client->submit($form, [
            'post_form_type_field' => 'value', // Provide form field data here
        ]);

        // Assert response after form submission
        $this->assertResponseRedirects('/');

        // You can also assert changes in the database or session here
    }

    public function testProfile()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/profile');

        $form = $crawler->selectButton('Save')->form();
        // Set form data and submit the form
        $client->submit($form, [
            'user_form_type_field' => 'value', // Provide form field data here
        ]);

        // Assert response after form submission
        $this->assertResponseRedirects('/');

        // You can also assert changes in the database or session here
    }
}