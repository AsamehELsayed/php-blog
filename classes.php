<?php 

abstract class User {
    public $id;
    public $name;
    public $email;
    protected $ps;
    public $phone;
    function __construct($id, $name, $email, $phone ,$role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->role= $role;
    }
    public static function login($email, $ps) {
        $user=null;
        $qry="SELECT * FROM users WHERE email='$email' AND password='$ps'";
        require_once 'config.php';
        $cn=mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $rsl=mysqli_query($cn,$qry);
        $row = mysqli_fetch_assoc($rsl);
        if ($row) {
          switch ($row['role']) {
            case 'admin':
              $user = new Admin($row['id'], $row['name'], $row['email'], $row['phone'], $row['role']);
              break;
            case 'subscriber':
              $user = new Subscriber($row['id'], $row['name'], $row['email'], $row['phone'],$row['role']);
              break;
          }
          return $user;
        }else{
          echo "ffff";
        }
        mysqli_close($cn);
    }
}


    class Admin extends User {
        
    }
    class Subscriber extends User {
        public static function register($name, $email, $ps, $phone) {
            $qry="INSERT INTO users (name,email,password,phone) values ('$name','$email',md5('$ps'),'$phone')";
            require_once 'config.php';
            $cn=mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $rsl=mysqli_query($cn,$qry);
            mysqli_close($cn);
            $name = $email = $ps = $phone = '';
        }
    }
?>