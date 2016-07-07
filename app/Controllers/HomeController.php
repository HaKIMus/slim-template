<?php

namespace App\Controllers;

use App\Models\User;
use Slim\Views\Twig as Twig;
class HomeController extends Controller
{
    /**
     * @param $request
     * @param $response
     */
    public function index($request, $response)
    {
        /*
        User::create([
           'name' => 'Test',
            'email' => 'email@gmail.com',
            'password' => '321'
        ]);
        */

        /*
        $user = User::where('email', 'hakim@gmail.com')->first();

        var_dump($user->name);
        */
        /*
        return $this->view->render($response, 'template.html.twig', [
            'titleWebsite' => 'Slim Template',
        ]);*/
    }
}