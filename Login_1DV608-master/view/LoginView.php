<?php

//namespace view;
setcookie("login", "", 0);

class LoginView {

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
    private $username = ''; //user input of username
    private $serverFile = '/home/a8979129/public_html/model/status.txt';
    private $localFile = 'model\status.txt';

    public function _constructor() {
        
    }

    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {
        $stat = stat($this->serverFile);
        $message = '';

        if (file_get_contents($this->serverFile) != NULL && time() - $stat['mtime'] < 25) {     //cheking for a logged in user and time of login less than 25 seconds
            $message = '';
            $response = $this->generateLogoutButtonHTML($message);
        } else {
            if (isset($_POST[self::$login]) || self::$login == 'login') {       //making sure the login button has been pressed
                if (empty($_POST[self::$name]) && empty($_POST[self::$password])) {       //username and password are empty
                    $message = 'Username is missing';
                    $response = $this->generateLoginFormHTML($message);
                } else if (!empty($_POST[self::$name]) && empty($_POST[self::$password])) {     //username with no password
                    $message = 'Password is missing';
                    $this->username = $_POST[self::$name];
                    $response = $this->generateLoginFormHTML($message);
                } else if (empty($_POST[self::$name]) && !empty($_POST[self::$password])) {     //password with no username
                    $message = 'Username is missing';
                    $response = $this->generateLoginFormHTML($message);
                } else if ($_POST[self::$name] != "Admin" || $_POST[self::$password] != "Password") {       //incorrect username or password
                    $message = 'Wrong name or password';
                    $this->username = $_POST[self::$name];
                    $response = $this->generateLoginFormHTML($message);
                } else if ($_POST[self::$name] == "Admin" || $_POST[self::$password] == "Password") {       //correct username or password
                    $GLOBALS['loggedIn'] = TRUE;
                    file_put_contents("model/status.txt", "true");
                    if (isset($_POST[self::$keep])){
                        $password = $this->passwordGenerator();
                        setcookie(self::$cookieName, 'Admin', time() + 120);
                        setcookie(self::$cookiePassword, $password, time() + 120);
                        $message = 'Welcome and you will be remembered';
                        $response = $this->generateLogoutButtonHTML($message);
                    } else {
                        $message = 'Welcome';
                        $response = $this->generateLogoutButtonHTML($message);
                    }
                }
            } else {
                $response = $this->generateLoginFormHTML($message);
            }
        }

        if (isset($_POST[self::$logout]) || self::$logout == 'login') {      //when the logout button has been pressed
            $GLOBALS['loggedIn'] = FALSE;
            if (file_get_contents($this->serverFile) != NULL) {       //logging out for the first time
                $message = 'Bye bye!';
            } else {          //preventing logging out without being logged in
                $message = '';
            }
            file_put_contents("model/status.txt", "");
            $response = $this->generateLoginFormHTML($message);
        }

        return $response;
    }

    /*
     * run to make sure the logged in variable has the correct status
     */

    public function responsetest() {
$stat = stat($this->serverFile);
        $message = '';

        if (file_get_contents($this->serverFile) != NULL && time() - $stat['mtime'] < 25) {     //cheking for a logged in user and time of login less than 25 seconds
            $message = '';
            $response = $this->generateLogoutButtonHTML($message);
        } else {
            if (isset($_POST[self::$login]) || self::$login == 'login') {       //making sure the login button has been pressed
                if (empty($_POST[self::$name]) && empty($_POST[self::$password])) {       //username and password are empty
                    $message = 'Username is missing';
                    $response = $this->generateLoginFormHTML($message);
                } else if (!empty($_POST[self::$name]) && empty($_POST[self::$password])) {     //username with no password
                    $message = 'Password is missing';
                    $this->username = $_POST[self::$name];
                    $response = $this->generateLoginFormHTML($message);
                } else if (empty($_POST[self::$name]) && !empty($_POST[self::$password])) {     //password with no username
                    $message = 'Username is missing';
                    $response = $this->generateLoginFormHTML($message);
                } else if ($_POST[self::$name] != "Admin" || $_POST[self::$password] != "Password") {       //incorrect username or password
                    $message = 'Wrong name or password';
                    $this->username = $_POST[self::$name];
                    $response = $this->generateLoginFormHTML($message);
                } else if ($_POST[self::$name] == "Admin" || $_POST[self::$password] == "Password") {       //correct username or password
                    $GLOBALS['loggedIn'] = TRUE;
                    if (isset($_POST[self::$keep])){
                        $message = 'Welcome and you will be remembered';
                        $response = $this->generateLogoutButtonHTML($message);
                    } else {
                        $message = 'Welcome';
                        $response = $this->generateLogoutButtonHTML($message);
                    }
                }
            } else {
                $response = $this->generateLoginFormHTML($message);
            }
        }

        if (isset($_POST[self::$logout]) || self::$logout == 'login') {      //when the logout button has been pressed
            $GLOBALS['loggedIn'] = FALSE;
            if (file_get_contents($this->serverFile) != NULL) {       //logging out for the first time
                $message = 'Bye bye!';
            } else {          //preventing logging out without being logged in
                $message = '';
            }
            $response = $this->generateLoginFormHTML($message);
        }

        return $response;
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLogoutButtonHTML($message) {
        return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLoginFormHTML($message) {
        return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
                                        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->username . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }

    //CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
    private function getRequestUserName() {
        //RETURN REQUEST VARIABLE: USERNAME
    }
    
    function passwordGenerator() {
        
    $bank = '~!@#$%&*0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random = '';
    for ($i = 0; $i < 16; $i++) {
        $random .= $bank[rand(0, strlen($bank))];
    }
    return $random;
}

}
