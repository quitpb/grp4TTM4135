<?php

namespace ttm4135\webapp\controllers;

use ttm4135\webapp\models\User;
use ttm4135\webapp\Auth;
use ttm4135\webapp\InputValidation;

class UserController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if (Auth::guest()) {
            $this->render('newUserForm.twig', []);
        } else {
            $username = Auth::user()->getUserName();
            $this->app->flash('info', 'You are already logged in as ' . $username);
            $this->app->redirect('/');
        }
    }

    static function setCookieUsername($username){
    	parent::setCookie("username", $username, "/login");
    }

    function create()
    {
        $request = $this->app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $email = $request->post('email');
        $bio = $request->post('bio');
        $validation = new InputValidation();


        if($validation->isValidEmail($email) && $validation->isValidBio($bio)
            && $validation->isValidUserName($username) && $validation->isValidPassword($password))
            {
                $user = User::makeEmpty();
                $user->setUsername($username);
                $password_hashed =  password_hash($password, PASSWORD_DEFAULT);
                $user->setPassword($password_hashed);
                $user->setEmail($email);
                $user->setBio($bio);
                $user->save();

                $this->app->flash('info', 'Thanks for creating a user. You may now log in.');
                $this->app->redirect('/login');
            }
            else{

                $this->app->flash('error', 'Invalid input field.');
                $this->app->redirect('/register');
            }


#        if($request->post('email'))
#        {
         #$email = $request->post('email');
#         if($validation->validEmail($email)){
#            $user->setEmail($email);
#         }
#          else{
#            $this->app->flash('error', 'Email not valid');
#            $this->app->redirect('/register');
#          }
#        }
#        if($request->post('bio'))
#        {
#          #$bio = $request->post('bio');
#          if($validation->ValidBio($bio)){
#            $user->setBio($bio);
#          }
#          else{
#            $this->app->flash('error', 'Bio not valid');
#            $this->app->redirect('/register');
#          }
#        }


#       $user->save();
#        $this->app->flash('info', 'Thanks for creating a user. You may now log in.');
#        $this->app->redirect('/login');
    }

    function show($tuserid)
    {
        if(Auth::userAccess($tuserid) )
        {
          $user = User::findById($tuserid);
          $this->render('showuser.twig', [
            'user' => $user
          ]);
        } else {
            $username = Auth::user()->getUserName();
            $this->app->flash('info', 'You do not have access this resource. You are logged in as ' . $username);
            $this->app->redirect('/');
        }
    }


    function edit($tuserid)
    {

        $user = User::findById($tuserid);

        if (! $user) {
            throw new \Exception("Unable to fetch logged in user's object from db.");
        } elseif (Auth::userAccess($tuserid)) {


            $request = $this->app->request;

            $username = $request->post('username');
            $password = $request->post('password');
	          $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $email = $request->post('email');
            $bio = $request->post('bio');


            $isAdmin = ($request->post('isAdmin') != null);


            $user->setUsername($username);
            $user->setPassword($password_hashed);
            $user->setBio($bio);
            $user->setEmail($email);
            $user->setIsAdmin($isAdmin);

            $user->save();
            $this->app->flashNow('info', 'Your profile was successfully saved.');

            $user = User::findById($tuserid);

            $this->render('showuser.twig', ['user' => $user]);


        } else {
            $username = $user->getUserName();
            $this->app->flash('info', 'You do not have access this resource. You are logged in as ' . $username);
            $this->app->redirect('/');
        }
    }

}
