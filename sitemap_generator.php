<?php
/**
 * Created by PhpStorm.
 * User: vasilioskaloidis
 * Date: 9/23/16
 * Time: 7:10 PM
 */

namespace BlueHelmet;


class sitemap_generator
{

    public $db_username = "";
    public $db_password = "";
    public $db_server = "";
    public $db_name = "";

    public function run()
    {
        // Connect to DB
        // Iterate through Course Table + print
        // Iterate through College table + print
        // Write to file
    }

    public function parseConfig() {
        include './application/config/datbase.php';
        $db_server = $db['default']['hostname'];
        $db_username = $db['default']['username'];
        $db_password = $db['default']['password'];
        $db_database = $db['default']['database'];

        

    }

    public function dbConnect()
    {
        $con = mysqli_connect("localhost", "my_user", "my_password", "my_db");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    public function iterateCourses()
    {

    }

    public function iterate()
    {

    }

    public function writeFile()
    {

    }


}