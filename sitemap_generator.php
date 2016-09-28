<?php
/**
 * Created by PhpStorm.
 * User: vasilioskaloidis
 * Date: 9/23/16
 * Time: 7:10 PM
 */

// namespace BlueHelmet;


class SitemapGenerator
{
    public $conn;
    public $db_username = "";
    public $db_password = "";
    public $db_server = "";
    public $db_name = "";

    public function run()
    {
        try {
            $this->parseConfig();
            $this->dbConnect();
            $this->iterateCourses();
            $this->iterateColleges();
            $this->writeFile();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function parseConfig()
    {
        //define( 'APPLICATION_LOADED', true );
        //define('BASEPATH', "foobar");
        //include './application/config/database.php';
        //global $db;
        //$this->db_server = $db['default']['hostname']; //TODO: Properly pull DB Configs from Codeigniter
        //$this->db_username = $db['default']['username'];
        //$this->db_password = $db['default']['password'];
        //$this->db_database = $db['default']['database'];

        $this->db_server = 'localhost'; //TODO: Properly pull DB Configs from Codeigniter
        $this->db_username = 'root';
        $this->db_password = 'root';
        $this->db_database = 'onlineclasssearch';
        //$this->url = "http://onlineclasssearch.com/search/?terms=;
        $this->url = "http://localhost/search/?terms=";

    }

    public function dbConnect()
    {
        $this->conn = new mysqli($this->db_server, $this->db_username, $this->db_password, $this->db_database);
        if ($this->conn->connect_errno) {
            printf("Connect failed: %s\n", $this->conn->connect_error);
            exit();
        }
    }

    //9966 8 74488

    public function iterateCourses()
    {
        // SCHEME: rowid, code, name, detail, url, uni_id, prior, uname, date_entered
        //         date_modified, modified_user_id, created_by, deleted
        $output = "";
        $sql = "SELECT * FROM `ypusa_course`";
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $output += "Site: " . $this->url . " - " . "\n";
            }
            echo $output;
        }
    }

    public function iterateColleges()
    {

    }

    public function writeFile()
    {

    }
}
// Execute Generator
$sg = new SitemapGenerator();
$sg->run();