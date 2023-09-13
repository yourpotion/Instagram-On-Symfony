# Instagram On Symfony

## Project Description

Instagram On Symfony is a web application inspired by Instagram, built using the Symfony framework. This application allows users to register, create profiles, post images, and interact with other users.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [UML Class Diagram](#uml-class-diagram)
- [Contributing](#contributing)
- [License](#license)

## Features

- User Registration: Users can register on the website using their email addresses.
- Email Confirmation: After registration, users receive a confirmation email with a unique link.
- Profile Management: Users can edit their profiles, including adding their full name, bio, and avatar.
- Image Posting: Users can post images.
- Image Viewing: Users can view images posted by other users.
- Privacy Controls: Unauthorized guests cannot view user profiles and pictures.

## Installation

To run this application locally, follow these steps:

1. Clone the repository:
git clone https://github.com/yourpotion/instagram-on-symfony.git

2.Navigate to the project directory:
cd instagram-on-symfony

3.Install dependencies:
composer install

4.Configure your database connection in .env and run migrations:
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5.Start the Symfony development server:
symfony server:start

Access the application in your web browser at http://localhost:8000.

# Usage
Register as a new user using your email address.
Check your email for a confirmation link.
Click the confirmation link to access your profile page.
Edit your profile by adding your full name, bio, and avatar.
Start using SymfonyGramm by posting images and exploring other users' content.
Project Structure
The project follows a typical Symfony application structure:

src/: Contains application source code.
config/: Configuration files.
templates/: Twig templates for rendering views.
public/: Publicly accessible assets like CSS, JavaScript, and uploaded images.
var/: Temporary files and cache.
vendor/: Composer dependencies.
bin/: Console commands and scripts.
tests/: Unit and functional tests.
UML Class Diagram

Insert your UML class diagram here to provide an overview of the application's architecture.

Contributing
Contributions to this project are welcome. Please follow the contributing guidelines for details on how to contribute.

License
This project is licensed under the MIT License.
