<?php

class DB
{

    protected $conn;

    public function conn()
    {
        try {
            //Database username
            $username = 'root';
            //Database password
            $password = '';
            //PDO Configuratie
            $options = [
                PDO::ATTR_EMULATE_PREPARES => false, // Zet emulatie uit voor echte prepared statements
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Zet errors aan voor debuggen
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Zet fetch automatisch op array
            ];
            //Host configuratie
            $dsn = "mysql:host=localhost;dbname=diary;charset=utf8mb4";
            //Maak PDO
            $this->conn = new PDO($dsn, $username, $password, $options);
            //return value boolean
            return true;
            //Zet variable conn op NULL
            $this->conn = NULL;
        } catch (PDOException $e) {
            //Database verbinding error
            exit('Er ging iets mis...');
            //Stuur variable terug
            return $e;
        }
    }
}

class Gebruikers extends DB
{

    public $id;
    public $firstname;
    public $insertions;
    public $lastname;
    public $email;

    public function create($firstname, $insertions, $lastname, $email, $password, $password2)
    {
        //Hash wachtwoord
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "INSERT INTO gebruikers (voornaam, tussenvoegsels, achternaam, email, wachtwoord) VALUES (:voornaam, :tussenvoegsels, :achternaam, :email, :wachtwoord)";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(":voornaam", $firstname);
            $stmt->bindParam(":tussenvoegsels", $insertions);
            $stmt->bindParam(":achternaam", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":wachtwoord", $hash);
            //SQL query daadwerkelijk uitvoeren
            $stmt->execute();
            //Zet verbinding op NULL
            $this->conn = NULL;
        } catch (PDOException $e) {

            return $e;
        }
    }

    public function login($email, $password)
    {
        try {
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "SELECT * FROM gebruikers WHERE email = :email";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(":email", $email);
            // sql query daadwerkelijk uitvoeren
            $stmt->execute();
            // data ophalen
            $data = $stmt->fetch();

            $this->conn = NULL;
            // controleren of het ingetypte wachtwoord overeenkomt met die in de database
            if (password_verify($password, $data['wachtwoord'])) {
                // class variabelen invullen
                $this->id = $data['id_gebruiker'];
                $this->firstname = $data['voornaam'];
                $this->insertions = $data['tussenvoegsels'];
                $this->lastname = $data['achternaam'];
                $this->email = $data['email'];
                // status terugsturen
                return true;
            }
            else{
                
                return "Email of wachtwoord is fout";
            }
        } catch (PDOException $e) {
            $this->conn = NULL;
            // status terugsturen
            return $e;
        }
    }
    public function is_loggedin()
    {
        if (isset($_SESSION['gebruiker_data'])) {
            return true;
        }
    }
    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['gebruiker_data']);
        return true;
    }

    public function update($firstname, $insertions, $lastname, $email, $oldpassword, $password)
    {
        if (empty($password)) {
        } else {
            //Hash wachtwoord
            $hash = password_hash($password, PASSWORD_DEFAULT);
        }
        try {
            //Pak sessie data uit
            $user = unserialize($_SESSION['gebruiker_data']);
            //Fetch gebruiker id uit sessie
            $user_id = $user->id;
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "UPDATE `gebruikers` 
                    SET 
			voornaam=COALESCE(NULLIF(:voornaam, ''),voornaam),
			tussenvoegsels=COALESCE(NULLIF(:tussenvoegsels, ''),tussenvoegsels),
			achternaam=COALESCE(NULLIF(:achternaam, ''),achternaam),
			email=COALESCE(NULLIF(:email, ''),email),
			wachtwoord=COALESCE(NULLIF(:nww1, ''),wachtwoord)			
                    WHERE id_gebruiker = :userid";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders	
            $stmt->bindParam(':userid', $user_id);
            $stmt->bindParam(':voornaam', $firstname);
            $stmt->bindParam(':tussenvoegsels', $insertions);
            $stmt->bindParam(':achternaam', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nww1', $hash);

            //Tweede SQL defineren voor oude wachtwoord fetchen
            $sql2 = "SELECT wachtwoord FROM gebruikers WHERE id_gebruiker = :id";
            //SQL voorbereiden
            $stmt2 = $this->conn->prepare($sql2);
            //Values verbinden met named placeholders
            $stmt2->bindParam(":id", $user_id);

            // sql query daadwerkelijk uitvoeren
            $stmt2->execute();
            // data ophalen
            $data = $stmt2->fetch();

            if (password_verify($oldpassword, $data['wachtwoord'])) {
                //sql uitvoeren
                $stmt->execute();
                return true;
            }
            else{
               
                return "wachtwoord onjuist";
            }
        } catch (PDOException $e) {
            $this->conn = NULL;
            // status terugsturen
            return $e;
        }
    }

    public function delete($user_id, $email, $password)
    {
        // maak een connectie met de database
        $this->conn();
        $sql2 = "SELECT * FROM gebruikers WHERE email = :email";
        // sql voorbereiden
        $stmt2 = $this->conn->prepare($sql2);
        // waardes verbinden met de named placeholders
        $stmt2->bindParam(":email", $email);
        // sql query daadwerkelijk uitvoeren
        $stmt2->execute();
        // data ophalen
        $data = $stmt2->fetch();

        // controleren of het ingetypte wachtwoord overeenkomt met die in de database
        if (password_verify($password, $data['wachtwoord'])) {
            // class variabelen invullen
            $this->id = $data['id_gebruiker'];
            $this->firstname = $data['voornaam'];
            $this->insertions = $data['tussenvoegsels'];
            $this->lastname = $data['achternaam'];
            $this->email = $data['email'];
            // status terugsturen


            // sql query defineren
            $sql = "DELETE FROM `gebruikers` WHERE id_gebruiker = :userid AND email = :email";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(':userid', $user_id);
            $stmt->bindParam(':email', $email);
            //Data ophalen
            $stmt->execute();

            session_destroy();
            return true;
        } else {
            // status terugsturen
            return "Het ingevoerde email en/of wachtwoord is onjuist.";
        }
        $this->conn = NULL;
    }
}
class Dagboeken extends Gebruikers
{

    public function getDiaries()
    {
        //Pak sessie data uit
        $user = unserialize($_SESSION['gebruiker_data']);
        //Zet gebruikers id uit sessie in variable
        $user_id = $user->id;
        try {
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "SELECT * FROM dagboeken WHERE id_gebruiker = :id";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(':id', $user_id);
            //Voer SQL uit
            $stmt->execute();
            // data ophalen
            $data = $stmt->fetchAll();
            // database connectie sluiten
            $this->conn = NULL;

            // opgehaalde rijen terugsturen
            return $data;
        } catch (PDOException $e) {
            // database connectie sluiten
            $this->conn = NULL;
            //stuur variable terug
            return $e;
        }
    }

    public function getStories($did)
    {
        try {
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "SELECT * FROM posts WHERE id_dagboek = :iddagboek";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(':iddagboek', $did);

            $stmt->execute();

            // data ophalen
            $data = $stmt->fetchAll();
            // database connectie sluiten
            $this->conn = NULL;

            // opgehaalde rijen terugsturen
            return $data;
        } catch (PDOException $e) {
            // database connectie sluiten
            $this->conn = NULL;
            //stuur variable terug
            return $e;
        }
    }

    public function getStory($diaryid, $id_post)
    {
        try {
            // maak een connectie met de database
            $this->conn();
            // sql query defineren
            $sql = "SELECT post FROM posts WHERE id_dagboek = :iddagboek AND id_post = :posts";
            // sql voorbereiden
            $stmt = $this->conn->prepare($sql);
            // waardes verbinden met de named placeholders
            $stmt->bindParam(':iddagboek', $diaryid);
            $stmt->bindParam(':posts', $id_post);
            //Voer SQL uit
            $stmt->execute();

            // data ophalen
            $data = $stmt->fetch();

            // database connectie sluiten
            $this->conn = NULL;

            // opgehaalde rijen terugsturen
            return $data;
        } catch (PDOException $e) {
            // database connectie sluiten
            $this->conn = NULL;
            return $e;
        }
    }

    public function setDiary($name, $user_id)
    {
        // maak een connectie met de database
        $this->conn();
        // sql query defineren
        $sql = "INSERT INTO `dagboeken` (id_gebruiker, naam) VALUES (:userid, :naam)";
        // sql voorbereiden
        $stmt = $this->conn->prepare($sql);
        // waardes verbinden met de named placeholders	
        $stmt->bindParam(':userid', $user_id);
        $stmt->bindParam(':naam', $name);
        // sql query daadwerkelijk uitvoeren
        $stmt->execute();
        //sluit verbinding
        $this->conn = NULL;
    }

    public function setStory($diaryid, $posts, $date)
    {
        // maak een connectie met de database
        $this->conn();
        // sql query defineren
        $sql = "INSERT INTO `posts` (id_dagboek, post, datum) VALUES (:dagboekid, :post, :datum)";
        // sql voorbereiden
        $stmt = $this->conn->prepare($sql);
        // waardes verbinden met de named placeholders	
        $stmt->bindParam(':post', $posts);
        $stmt->bindParam(':datum', $date);
        $stmt->bindParam(':dagboekid', $diaryid);
        // sql query daadwerkelijk uitvoeren
        $stmt->execute();
        //sluit verbinding
        $this->conn = NULL;
    }

    public function deleteDiary($diaryid, $user_id)
    {
        // maak een connectie met de database
        $this->conn();
        // sql query defineren
        $sql = "DELETE FROM `dagboeken` WHERE id_gebruiker = :userid AND id_dagboek = :dagboekid";
        // sql voorbereiden
        $stmt = $this->conn->prepare($sql);
        // waardes verbinden met de named placeholders	
        $stmt->bindParam(':userid', $user_id);
        $stmt->bindParam(':dagboekid', $diaryid);
        // sql query daadwerkelijk uitvoeren
        $stmt->execute();
        //sluit verbinding
        $this->conn = NULL;
    }
}
