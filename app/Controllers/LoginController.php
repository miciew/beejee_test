<?php

namespace Miciew\Controllers;


use Miciew\User;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends BaseController
{
    public function register( Request $request )
    {
        $user = User::create([
            'password' => $this->hashPassword($request->get('password')),
            'username' => $request->get('username',''),
            'email' => $request->get('email')
        ]);

        $this->authenticate( $user, $this->hashPassword($request->get('password')) );
        $this->redirect('/');
    }

    public function auth( Request $request )
    {

        if( auth()->isLoggedIn() )
        {
            $this->redirect('/');
        }

        $this->render('auth', [
            'email' => $request->get('email', '')
        ]);
    }

    public function login( Request $request )
    {
        $users = User::findByAttributes([
            'email' => $request->get('email')
        ]);

        $user = array_shift($users);
        unset($users);

        $this->authenticate($user, $request->get('password'));

    }

    public function logout( Request $request )
    {
        auth()->logout();

        $this->redirect('/');
    }

    protected function authenticate($user, $password)
    {
        try
        {
            auth()->login($user, $password);

            $this->redirect('/');
        }
        catch(\pmill\Auth\Exceptions\PasswordException $e)
        {
            $this->redirect('/auth');
        }
    }

    protected function hashPassword($password)
    {
        $passwordHelper = new \pmill\Auth\Password;
        return $passwordHelper->hash($password);
    }
}