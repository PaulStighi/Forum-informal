<?php

include 'connect.php';
include 'header.php';
 
echo '<h3>Create a topic</h3> <br>';

if(!isset($_SESSION['signed_in']))
{
    echo 'Sorry, you have to be <a href="signin.php" style = "color: black">signed in</a> to create a topic.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {  
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysqli_query($con, $sql);
         
        if(!$result)
        {
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for someone to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" /> <br><br>
                    Category: '; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select> <br><br>'; 
                     
                echo 'Message: <br> <textarea name="post_content" /></textarea> <br><br>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        $query  = "BEGIN WORK;";
        $result = mysqli_query($con, $query);
         
        if(!$result)
        {
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . mysqli_real_escape_string($con, $_POST['topic_subject']) . "',
                               NOW(),
                               " . mysqli_real_escape_string($con, $_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . ")";
                      
            $result = mysqli_query($con, $sql);
            if(!$result)
            {
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error();
                $sql = "ROLLBACK;";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $topicid = mysqli_insert_id();
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($con, $_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysqli_query($con, $sql);
                 
                if(!$result)
                {
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error();
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($con, $sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($con, $sql);
                     
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '" style = "color: black">your new topic</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>