<div class="col-sm-4">
    <div class="sidebar">

        <div class="carousel-box owl-wrapper">
            <div class="title-section">
                <h1><span class="world">Komentar Terakhir</span></h1>
            </div>

            <div class="owl-carousel"
                 data-num="1">
				
				<?php
					$id_comment    = [];
					$result_get_id = json_decode ( $act -> getIDComment ( $id ) );
					$id_comment    = $result_get_id ->{'id_comment'};
					
					$firsttime = 0;
					$show      = 0;
					$loop      = 0;
					
					$number_of_contents = sizeof ( $id_comment );
					
					for ( $loop ; $loop < $number_of_contents ; $loop ++ )
					{
						$comData = json_decode ( $act -> getCommentContent ( $id_comment[ $loop ] ) );
						
						if ( $loop == ( $number_of_contents - 1 ) )
						{
							if ( $firsttime == 0 )
							{
								echo "<div class=\"item\">";
								echo "<ul class=\"list-posts\">";
								
								echo "<li>";
								echo "<img src=\"upload/news-posts/bubble_smiley.png\" alt=\"\"
										style = \"/*border-radius: 100%;*/ width: 40px;height: 40px;\">";
								
								echo "<div class=\"comment-content\">";
								echo "<p class=\"main-message\">" . html_entity_decode ( $comData ->{'comment'} )
								     . "</p>";
								echo "<span style = \"font-size: 11px;font-weight: 700;font-style: italic;
											color: rgba(12, 12, 12, 0.35);\">
										<i class=\"fa fa-user\"></i> 
										&nbsp;&nbsp; oleh " . $comData ->{'commentator_name'} . "</span>";
								
								echo "</div>";
								echo "</li>";
								
								echo "</ul>";
								echo "</div>";
							}
							else
							{
								echo "<li>";
								echo "<img src=\"upload/news-posts/bubble_smiley.png\" alt=\"\"
										style = \"/*border-radius: 100%;*/ width: 40px;height: 40px;\">";
								
								echo "<div class=\"comment-content\">";
								echo "<p class=\"main-message\">" . $comData ->{'comment'} . "</p>";
								echo "<span style = \"font-size: 11px;font-weight: 700;font-style: italic;
											color: rgba(12, 12, 12, 0.35);\">
										<i class=\"fa fa-user\"></i>
										&nbsp;&nbsp; oleh " . $comData ->{'commentator_name'} . "</span>";
								
								echo "</div>";
								echo "</li>";
								
								
								echo "</ul>";
								echo "</div>";
								$firsttime = 0;
								$show      = 1;
							}
						}
						else
						{
							if ( $firsttime == 0 )
							{
								echo "<div class=\"item\">";
								echo "<ul class=\"list-posts\">";
								echo "<li>";
								echo "<img src=\"upload/news-posts/bubble_smiley.png\" alt=\"\"
										style = \"/*border-radius: 100%;*/ width: 40px;height: 40px;\">";
								
								echo "<div class=\"comment-content\">";
								echo "<p class=\"main-message\">" . html_entity_decode ( $comData ->{'comment'} )
								     . "</p>";
								echo "<span style = \"font-size: 11px;font-weight: 700;font-style: italic;
											color: rgba(12, 12, 12, 0.35);\">
										<i class=\"fa fa-user\"></i>
										&nbsp;&nbsp; oleh " . $comData ->{'commentator_name'} . "</span>";
								
								echo "</div>";
								echo "</li>";
								
								$firsttime = 1;
								$show ++;
							}
							else
							{
								if ( $show < 4 )
								{
									echo "<li>";
									echo "<img src=\"upload/news-posts/bubble_smiley.png\" alt=\"\"
										style = \"/*border-radius: 100%;*/ width: 40px;height: 40px;\">";
									
									echo "<div class=\"comment-content\">";
									echo "<p class=\"main-message\">" . html_entity_decode ( $comData ->{'comment'} )
									     . "</p>";
									echo "<span style = \"font-size: 11px;font-weight: 700;font-style: italic;
												color: rgba(12, 12, 12, 0.35);\">
											<i class=\"fa fa-user\"></i>
											&nbsp;&nbsp; oleh " . $comData ->{'commentator_name'} . "</span>";
									
									echo "</div>";
									echo "</li>";
									
									$show ++;
								}
								else
								{
									if ( $show == 4 )
									{
										echo "<li>";
										echo "<img src=\"upload/news-posts/bubble_smiley.png\" alt=\"\"
											style = \"/*border-radius: 100%;*/ width: 40px;height: 40px;\">";
										
										echo "<div class=\"comment-content\">";
										echo "<p class=\"main-message\">" . $comData ->{'comment'} . "</p>";
										echo "<span style = \"font-size: 11px;font-weight: 700;font-style: italic;
												color: rgba(12, 12, 12, 0.35);\">
												<i class=\"fa fa-user\"></i>
												&nbsp;&nbsp; oleh " . $comData ->{'commentator_name'} . "</span>";
										
										echo "</div>";
										echo "</li>";
										
										echo "</ul>";
										echo "</div>";
										$show      = 0;
										$firsttime = 0;
									}
									else
									{
									
									}
								}
							}
						}
					}
				?>

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


        <div class="widget tab-posts-widget">
            <ul class="nav nav-tabs"
                id="myTab">
                <li class="active">
                    <a href="#option1"
                       data-toggle="tab">Top Review</a>
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
                                  INNER JOIN tbl_statistic_comment_news
                                  ON tbl_berita.id_berita=tbl_statistic_comment_news.id_berita
                                  WHERE tbl_berita.date_publish BETWEEN ? AND ? AND tbl_berita.id_category <=5
                                  ORDER BY tbl_statistic_comment_news.nominal DESC";
							
							$top_rev_dat = $db -> getAllValue ( $query , [ $date_5_days_ago , $date_today ] );
							
							foreach ( $top_rev_dat as $top_review )
							{
								
								if ( $counter <= 4 )
								{
									$id_berita = $top_review[ 'id_berita' ];
									
									$query     = "SELECT * FROM tbl_berita WHERE id_berita=?";
									$news_data = $db -> getValue ( $query , [ $id_berita ] );
									$date_publish
									           = $util -> changeFormatDateFromNumberToString ( $news_data[ 'date_publish' ] );
									
									$url = $img_directory.$news_data[ 'thumbnail' ];
									
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
								if ( $counter <= 4 )
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

        <div class="widget tab-posts-widget">
            <ul class="nav nav-tabs"
                id="myTab">
                <li class="active">
                    <a href="#option1"
                       data-toggle="tab">Terbaru</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active"
                     id="option1">
                    <ul class="list-posts">
						<?php
							$counter  = 0;
							$id_state = 1;
							
							$date_today
								             = ( $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
								                                                                                              1 ) ) ) )
								               . " 00:00:00";
							$date_5_days_ago = ( $util -> getDateBeforeToday ( $date_today , 10000 ) ) . " 00:00:00";
							
							$query
								       = "SELECT * FROM tbl_berita
                                          WHERE id_state=? AND date_publish BETWEEN ? AND ? AND id_category<=5
                                          ORDER BY id_berita DESC";
							$news_data = $db -> getAllValue (
								$query ,
								[
									$id_state ,
									$date_5_days_ago ,
									$date_today ,
								] );
							
							foreach ( $news_data as $news_data )
							{
								if ( $counter <= 4 )
								{
									$url       = $img_directory . $news_data[ 'thumbnail' ];
									$id_berita = $news_data[ 'id_berita' ];
									$date_publish
									           = $util -> changeFormatDateFromNumberToString ( $news_data[ 'date_publish' ] );
									
									echo "<li >";
									echo "<img src = \"$url\" alt = \"\" height=\"50\"
				                width=\"50\" >";
									echo "<div class = \"post-content\" >";
									echo "<h2 >";
									echo "<a href = \"read?id=$id_berita\"
                                >" . $news_data[ 'judul_berita' ] . "</a >";
									echo "</h2 >";
									echo "<ul class = \"post-tags\" >";
									echo "<li >
										<i class = \"fa fa-clock-o\" ></i >
										" . $date_publish . "
                                       </li >";
									
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
</div>