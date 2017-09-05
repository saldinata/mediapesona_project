<section class = "ticker-news" >
    <div class = "container" >
        <div class = "ticker-news-box" >
            <span class = "breaking-news" >breaking news</span >
            <ul id = "js-news" >
                 <?php
                 $util->setDefaultTimeZone("Asia/Bangkok");
                 $date_time_today = $util->setRegisterDate($util->getDateTimeToday());

                 $query             = "SELECT * FROM tbl_breaking_news WHERE regdate = ?";
                 $breaking_news_dat = $db->getAllValue($query, [$date_time_today]);

                 foreach ($breaking_news_dat as $breaknewsdat)
                 {
                     echo "<li class = \"news-item\" >";
                     echo "<strong><span class = \"time-news\" >".$breaknewsdat[ 'date_time' ]."</span ></strong>";
                     echo "<strong style=\"color:#212121;\"><i>".$breaknewsdat[ 'content' ]."</i><strong>";
                     echo "</li >";
                 }
                 ?>
            </ul >
        </div >
    </div >
</section >