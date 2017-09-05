<div class="sidebar">

    <div class="advertisement">
        <div class="desktop-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
        <div class="tablet-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
        <div class="mobile-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
    </div>


    <div class="widget tab-posts-widget">
        <ul class="nav nav-tabs"
            id="myTab">
            <li class="active">
                <a href="#option1"
                   data-toggle="tab">Populer</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active"
                 id="option1">
                <ul class="list-posts">
					
					<?php
						$counter         = 0;
						$date_today
						                 = ( $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
						                                                                                                  1 ) ) ) )
						                   . " 00:00:00";
						$date_5_days_ago = ( $util -> getDateBeforeToday ( $date_today , 10000 ) ) . " 00:00:00";
						
						$query
							= "SELECT * FROM tbl_berita
                                INNER JOIN tbl_statistic_read_news ON tbl_berita.id_berita=tbl_statistic_read_news.id_berita
                                WHERE tbl_berita.date_publish BETWEEN ? AND ? AND tbl_berita.id_category<=5
                                ORDER BY tbl_statistic_read_news.nominal DESC";
						
						$latest_news = $db -> getAllValue ( $query , [ $date_5_days_ago , $date_today ] );
						
						foreach ( $latest_news as $latest_news )
						{
							if ( $counter <= 10 )
							{
								$id_berita = $latest_news[ 'id_berita' ];
								
								$query     = "SELECT * FROM tbl_berita WHERE id_berita=?";
								$news_data = $db -> getValue ( $query , [ $id_berita ] );
								$date_publish
								           = $util -> changeFormatDateFromNumberToString ( $news_data[ 'date_publish' ] );
								
								$url = $img_directory . $news_data[ 'thumbnail' ];
								
								echo "<li >";
								echo "<img src = \"$url\" alt = \"\" height=\"50\"
										width=\"50\" >";
								echo "<div class = \"post-content\" >";
								echo "<h2 >";
								echo "<a href = \"read?id=$id_berita\"
                                >" . $news_data[ 'judul_berita' ] . "</a >";
								echo "</h2 >";
								echo "<ul class = \"post-tags\" >";
								echo "<li ><i class = \"fa fa-clock-o\" ></i >" . $date_publish . "</li >";
								echo "</ul >";
								echo "</div >";
								echo "</li >";
							}
							
							$counter ++;
						}
					?>
                </ul>
            </div>
        </div>
    </div>


    <div class="advertisement">
        <div class="desktop-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
        <div class="tablet-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
        <div class="mobile-advert">
            <span>Advertisement</span>
            <img src="images/visit.png"
                 alt="">
        </div>
    </div>

</div>