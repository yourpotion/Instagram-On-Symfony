<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');
        $form = $crawler->selectButton('Register')->form();

        // Fill in the form fields with appropriate data
        $form['registration_form[email]'] = 'test@example.com';
        $form['registration_form[plainPassword]'] = 'testpassword';


        $client->submit($form);

        // Check if the user was redirected to the login page
        $this->assertResponseRedirects('/login');
    }

    public function testVerifyUserEmail()
    {
        $client = static::createClient();

        // Mock an authenticated user
        $userRepository = $client->getContainer()->get('doctrine')->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'test@example.com']);
        $client->loginUser($user);

        // Send a request to the verify email route
        $client->request('GET', '/verify/email');

        // Check if the user was redirected to the profile page
        $this->assertResponseRedirects('/profile');
    }
}

