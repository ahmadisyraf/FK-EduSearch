<?php
class Middleware
{
    public function authSession($session)
    {
        session_start();

        // Check if last activity was set
        if ($session && time() - $session > 900) {
            // last request was more than 15 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time
            session_destroy(); // destroy session data in storage
            return false;
        } else {
            $_SESSION['last_activity'] = time(); // update last activity time stamp
            return $_SESSION['last_activity'];
        }
    }
}

?>