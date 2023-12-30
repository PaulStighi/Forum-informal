<?php

include 'connect.php';
include 'header.php';

$topic_id = mysqli_real_escape_string($con, $_GET['id']);
 
$sql = "SELECT
            topic_id,
            topic_subject
            topic_cat
        FROM
            topics
        WHERE
            topic_id = '$topic_id';";
 
$result = mysqli_query($con, $sql);
 
if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysqli_error();
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Posts in ′' . $row['topic_cat'] . '′ topic</h2>';
        }
     
        $sql = "SELECT
                    post_id
                    post_topic,
                    post_content,
                    post_date,
                    post_by,
                    user_id,
                    user_name
                FROM
                    posts
                LEFT JOIN
                    users
                ON
                    post_by = user_id
                WHERE
                    post_topic = '$topic_id';";
         
        $result = mysqli_query($con, $sql);
         
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no topics in this category yet.';
            }
            else
            {
                echo "<table border=1>";
                     
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart2">';
                            echo '<h3> '. $row['user_name'] . '<br>' . $row['post_date'] . '<h3>';
                        echo '</td>';
                        echo '<td class="rightpart2">';
                            echo '<h3>' . $row['post_content'] . '<h3>';
                        echo '</td>';
                    echo '</tr>';
                }

                echo "</table>";

                echo '<br>Reply to this topic: <br> <form method="post" action="reply.php?id= ' . $topic_id . '"> <br>
                        <textarea name="reply-content" placeholder="Remember, be nice!"></textarea> <br><br>
                        <input type="submit" value="Submit reply" />
                    </form>';

            }
        }
    }
}

include 'footer.php';
?>