    <?php
    require_once('../../database/database.php');

    $query = isset($_GET['query']) ? $_GET['query'] : '';
    $query = "%{$query}%";
    
    $sql = "SELECT posts.id, users.id as user_id, users.name, users.surname, posts.title, posts.campo 
            FROM posts 
            INNER JOIN users ON posts.user_id = users.id";

    if (!empty($_GET['query'])) {
        $sql .= " WHERE users.name LIKE ? OR users.surname LIKE ? OR posts.title LIKE ?";
    } else {
        $sql .= " ORDER BY RAND()";
    }
    

    $exc = $pdo->prepare($sql);
    
    if (!empty($_GET['query'])) {
        $exc->execute([$query, $query, $query]);
    } else {
        $exc->execute();
    }
    $results = [];
    if ($exc->rowCount() > 0) {
        while ($row = $exc->fetch(PDO::FETCH_ASSOC)) {
            $profile_pic_extensions = ['.jpg', '.jpeg', '.png'];
            $profile_pic = false;
            foreach ($profile_pic_extensions as $ext) {
                $filename = $row['user_id'] . $ext;
                if (file_exists("../../profileimages/" . $filename)) {
                    $profile_pic = $filename;
                    break;
                }
            }

            $profile_image = $profile_pic ? "../profileimages/$profile_pic" : " ../images/default-profile-image.png";

            $results[] = [
                'id' => $row['id'],
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'title' => $row['title'],
                'campo' => $row['campo'],
                'profile_image' => $profile_image
            ];
        }
    }
    echo json_encode($results);