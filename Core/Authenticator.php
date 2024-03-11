<?php 


namespace Core;


class Authenticator
{
    

    public function attempt($email, $password)
    {
        
        // match the credentials
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();


        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                    //linha por conta própria
                    'id' => $user['id']
                ]);
                
                return true;
            }
        }

        return false;
    }

    public function login($user) 
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $user['id'],
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}