<?php

namespace App\Controllers;

/*Add your model*/
use App\Models\User;
class ExampleController extends Controller
{
    /**
     * @param $request
     * @param $response
     */
    public function index($request, $response)
    {
        /**
         * @see If you want to create new user:
            User::create([
            'name' => 'Subtelny',
            'email' => 'sub@gmail.com',
            'password' => '321'
            ]);
         */

        /**
         * @see If you want to pull out user:
            $user = User::where('email', 'hakim@gmail.com')->first();

            var_dump($user->name);
         */

        /**
         * @see If you want to return view:
            return $this->view->render($response, 'template.html.twig', [
            'titleWebsite' => 'Slim Template',
            ]);
         */

        return $this->view->render($response, 'main/slim_template.html.twig', [
            'titleWebsite' => 'Slim Template',
        ]);
    }
}