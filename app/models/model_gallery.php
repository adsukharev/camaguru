<?php

class Model_gallery extends Model
{

    function __construct()
    {

        $this->user = $_SESSION['loggued_on_user'];
        $this->id = $this->getUser($this->user)['id'];
    }

    function countImages()
    {
        $sql = "SELECT COUNT(*)
		FROM photos;";
        try {
            $conn = $this->connectToDB();
            $sth = $conn->prepare($sql);
            $sth->execute();
            $amountPhotos = $sth->fetch()['COUNT(*)'];
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        return ($amountPhotos);
    }

    function getImages($page)
    {

        $until = $page * 5;
        $from = $until - 5;
        $sql = "SELECT id, path, likes, user_id
		FROM photos
		ORDER BY creation_date DESC
		LIMIT {$from}, {$until};";

        try {
            $conn = $this->connectToDB();
            $sth = $conn->prepare($sql);
            $sth->execute();
            $photos = $sth->fetchAll();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        return ($photos);
    }

    function getComments()
    {

        $sql = "SELECT author, comment, photo_id
		FROM comments
		ORDER BY photo_id ASC;";
        try {
            $conn = $this->connectToDB();
            $sth = $conn->prepare($sql);
            $sth->execute();
            $comments = $sth->fetchAll();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        return $comments;
    }

    function incLike($id, $like)
    {

        $sql = "UPDATE photos
 				SET likes =? WHERE id =?;";
        try {
            $conn = $this->connectToDB();
            $stmt= $conn->prepare($sql);
            $stmt->execute([$like, $id]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
    }

    function addComment($id, $comment)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO comments (author, comment, creation_date, photo_id)
 				VALUES (?,?,?,?);";
        try {
            $conn = $this->connectToDB();
            $stmt= $conn->prepare($sql);
            $stmt->execute([$this->user, $comment, $date, $id]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        return $this->user;
    }

    function sendNotification($photo_id, $comment)
    {
        $email = $this->checkNotificationStatus($photo_id);
        if (!$email){
            return;
        }
        $to = $email;
        $subject = 'New comment in Camaguru';
        $message =
            "<html>
				<head>
				  <title>Comment</title>
				</head>

				<body>
					You received a new comment in Camaguru: $comment
				</body>
			</html>";

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        mail($to, $subject, $message, implode("\r\n", $headers));

    }

    protected function checkNotificationStatus($photo_id){
        $sql = "SELECT user_id
                FROM photos
                WHERE photos.id = '{$photo_id}'
                ;";

        try {
            $conn = $this->connectToDB();
            $sth = $conn->prepare($sql);
            $sth->execute();
            $user_id = $sth->fetch()['user_id'];

            $sql2 = "SELECT email, notification
                     FROM users
                     WHERE id = '{$user_id}'
                 ;";
            $sth = $conn->prepare($sql2);
            $sth->execute();
            $emailNotificationArr = $sth->fetch();

        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        if (!$emailNotificationArr['notification']){
            return 0;
        }

        return $emailNotificationArr['email'];
    }
}

?>
