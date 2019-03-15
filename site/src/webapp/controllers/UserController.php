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

    function create()		  
    {
        $request = $this->app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $email = $request->post('email');
        $bio = $request->post('bio');
        $validation = new InputValidation();


        $user = User::makeEmpty();
        $user->setUsername($username);
        $user->setPassword($password);

        if($validation->validEmail($email) && $validation->ValidBio($bio)
            && $validation->validUserName($username) && $validation->validPassword($password))
            {
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

    function delete($tuserid)
    {
        if(Auth::userAccess($tuserid))
        {
            $user = User::findById($tuserid);
            $user->delete();
            $this->app->flash('info', 'User ' . $user->getUsername() . '  with id ' . $tuserid . ' has been deleted.');
            $this->app->redirect('/admin');
        } else {
            $username = Auth::user()->getUserName();
            $this->app->flash('info', 'You do not have access this resource. You are logged in as ' . $username);
            $this->app->redirect('/');
        }
    }

    function deleteMultiple()
    {
      if(Auth::isAdmin()){
          $request = $this->app->request;
          $userlist = $request->post('userlist'); 
          $deleted = [];

          if($userlist == NULL){
              $this->app->flash('info','No user to be deleted.');
          } else {
               foreach( $userlist as $duserid)
               {
                    $user = User::findById($duserid);
                    if(  $user->delete() == 1) { //1 row affect by delete, as expect..
                      $deleted[] = $user->getId();
                    }
               }
               $this->app->flash('info', 'Users with IDs  ' . implode(',',$deleted) . ' have been deleted.');
          }

          $this->app->redirect('/admin');
      } else {
          $username = Auth::user()->getUserName();
          $this->app->flash('info', 'You do not have access this resource. You are logged in as ' . $username);
          $this->app->redirect('/');
      }
    }


    function show($tuserid)   
    {
        if(Auth::userAccess($tuserid))
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

    function newuser()
    { 

        $user = User::makeEmpty();

        if (Auth::isAdmin()) {


            $request = $this->app->request;

            $username = $request->post('username');
            $password = $request->post('password');
            $email = $request->post('email');
            $bio = $request->post('bio');

            $isAdmin = ($request->post('isAdmin') != null);
            

            $user->setUsername($username);
            $user->setPassword($password);
            $user->setBio($bio);
            $user->setEmail($email);
            $user->setIsAdmin($isAdmin);

            $user->save();
            $this->app->flashNow('info', 'Your profile was successfully saved.');

            $this->app->redirect('/admin');


        } else {
            $username = $user->getUserName();
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
            $email = $request->post('email');
            $bio = $request->post('bio');
            print((string) $username);
            print((string) $password);
            print((string) $email);
            print((string) $bio);

            $isAdmin = ($request->post('isAdmin') != null);
            

            $user->setUsername($username);
            $user->setPassword($password);
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
