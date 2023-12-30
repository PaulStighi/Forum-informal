<?php

include 'connect.php';
include 'header.php';
 
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description,
			cat_date
        FROM
            categories;";
 
$result = mysqli_query($con, $sql);
 
if(!$result or !isset($_SESSION['signed_in']))
{
    echo 'The categories could not be displayed, please <a href="signin.php" style = "color: black">sign in</a> or try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while($row = mysqli_fetch_assoc($result))
        {
			
		$sql2 = "SELECT
					topic_id,
					topic_subject,
					topic_date
				FROM
					topics
				WHERE
					topic_date = 
					(SELECT MAX(topic_date) FROM topics WHERE topic_cat = " . $row['cat_id'] . ")";
		
		$result2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($result2);
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id='. $row['cat_id'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
					if(!$row2['topic_id'])	echo 'There\'s no topic in this category';	
					else	echo '<a href="topic.php?id=' . $row2['topic_id'].'"> ' . $row2['topic_subject'] . ' </a><br> at ' . $row2['topic_date'];
                echo '</td>';
            echo '</tr>';
        }
		
		echo '</table>';
    }
}

include 'footer.php';
?>