<?php
class Expert extends Connection
{
    public function getExpert($email, $password)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertEmail = '$email' AND expertPassword = '$password'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }
}
?>