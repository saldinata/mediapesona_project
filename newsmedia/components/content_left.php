<div class="block-content">
    <div class="carousel-box owl-wrapper">
        <div class="title-section">
            <h1><span>TRAVEL</span></h1>
        </div>

        <div class="owl-carousel"
             data-num="2">
			<?php
				$id_news   = [];
				$firsttime = 0;
				$show      = 0;
				$loop      = 0;
				
				$id_category = json_decode ( $act -> getIDTopic ( "Travel" ) );
				$id_category = $id_category ->{'id_category'};
				
				$date_today
					             = $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
					                                                                                            1 ) ) );
				$date_5_days_ago = $util -> getDateBeforeToday ( $date_today , 10000 );
				
				$id_news = $act -> getIDNews (
					$id_category ,
					$date_today ,
					$date_5_days_ago );
				
				
				$number_of_contents = sizeof ( $id_news );
				
				for ( $loop ; $loop < $number_of_contents ; $loop ++ )
				{
					$newsData = json_decode ( $act -> getNewsContent ( $id_news[ $loop ] ) );
					$id       = $newsData ->{'id_berita'};
					$date_pub = $newsData ->{'date_pub'};
					$date_pub = $util -> changeFormatDateFromNumberToString ( $date_pub );
					
					if ( $loop == ( $number_of_contents - 1 ) )
					{
						if ( $firsttime == 0 )
						{
							echo "<div class=\"item\">";
							echo "<ul class=\"list-posts\">";
							
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							echo "</ul>";
							echo "</div>";
						}
						else
						{
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
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
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							
							$firsttime = 1;
							$show ++;
						}
						else
						{
							if ( $show < 1 )
							{
								echo "<li>";
								echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
								echo "<div class=\"post-content\">";
								echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
								echo "<ul class=\"post-tags\">";
								echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</li>";
								
								$show ++;
							}
							else
							{
								if ( $show == 1 )
								{
									echo "<li>";
									echo "<img src=\"" . $img_directory.$newsData ->{'pict'}
									     . "\" alt=\"\" height=\"70\" weight=\"100\">";
									echo "<div class=\"post-content\">";
									echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
									echo "<ul class=\"post-tags\">";
									echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
									echo "</ul>";
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


    <div class="carousel-box owl-wrapper">
        <div class="title-section">
            <h1><span>SPORT</span></h1>
        </div>

        <!--        <div class = "title-section" style = "border-bottom: 2px solid #4ee8a1;" >-->
        <!--            <h1 ><span class = "world" style = "background-color: #4ee8a1; color:-->
        <!--            #F5F5F5; padding: 10px; border-bottom: none;font-size: 14px;" >SPORT</span ></h1 >-->
        <!--        </div >-->

        <div class="owl-carousel"
             data-num="2">
			<?php
				$id_news   = [];
				$firsttime = 0;
				$show      = 0;
				$loop      = 0;
				
				$id_category = json_decode ( $act -> getIDTopic ( "Sport" ) );
				$id_category = $id_category ->{'id_category'};
				
				$date_today
					             = $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
					                                                                                            1 ) ) );
				$date_5_days_ago = $util -> getDateBeforeToday ( $date_today , 10000 );
				
				$id_news = $act -> getIDNews (
					$id_category ,
					$date_today ,
					$date_5_days_ago );
				
				
				$number_of_contents = sizeof ( $id_news );
				
				for ( $loop ; $loop < $number_of_contents ; $loop ++ )
				{
					$newsData = json_decode ( $act -> getNewsContent ( $id_news[ $loop ] ));
					$id       = $newsData ->{'id_berita'};
					$date_pub = $newsData ->{'date_pub'};
					$date_pub = $util -> changeFormatDateFromNumberToString ( $date_pub );
					
					if ( $loop == ( $number_of_contents - 1 ) )
					{
						if ( $firsttime == 0 )
						{
							echo "<div class=\"item\">";
							echo "<ul class=\"list-posts\">";
							
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							echo "</ul>";
							echo "</div>";
						}
						else
						{
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
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
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							
							$firsttime = 1;
							$show ++;
						}
						else
						{
							if ( $show < 1 )
							{
								echo "<li>";
								echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
								echo "<div class=\"post-content\">";
								echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
								echo "<ul class=\"post-tags\">";
								echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</li>";
								
								$show ++;
							}
							else
							{
								if ( $show == 1 )
								{
									echo "<li>";
									echo "<img src=\"" . $img_directory.$newsData ->{'pict'}
									     . "\" alt=\"\" height=\"70\" weight=\"150\">";
									echo "<div class=\"post-content\">";
									echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
									echo "<ul class=\"post-tags\">";
									echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
									echo "</ul>";
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
            <img src="images/advertising.png"
                 alt="">
        </div>
        <div class="tablet-advert">
            <span>Advertisement</span>
            <img src="images/advertising.png"
                 alt="">
        </div>
        <div class="mobile-advert">
            <span>Advertisement</span>
            <img src="images/advertising.png"
                 alt="">
        </div>
    </div>


    <div class="carousel-box owl-wrapper">
        <div class="title-section">
            <h1><span>FASHION</span></h1>
        </div>

        <!--        <div class = "title-section" style = "border-bottom: 2px solid #bb4ee8;" >-->
        <!--            <h1 ><span class = "world" style = "background-color: #bb4ee8; color:-->
        <!--            #F5F5F5; padding: 10px; border-bottom: none;font-size: 14px;" >FASHION</span ></h1 >-->
        <!--        </div >-->

        <div class="owl-carousel"
             data-num="2">
			<?php
				$id_news   = [];
				$firsttime = 0;
				$show      = 0;
				$loop      = 0;
				
				$id_category = json_decode ( $act -> getIDTopic ( "Fashion" ) );
				$id_category = $id_category ->{'id_category'};
				
				$date_today
					             = $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
					                                                                                            1 ) ) );
				$date_5_days_ago = $util -> getDateBeforeToday ( $date_today , 10000 );
				
				$id_news = $act -> getIDNews (
					$id_category ,
					$date_today ,
					$date_5_days_ago );
				
				
				$number_of_contents = sizeof ( $id_news );
				
				for ( $loop ; $loop < $number_of_contents ; $loop ++ )
				{
					$newsData = json_decode ( $act -> getNewsContent ( $id_news[ $loop ]) );
					$id       = $newsData ->{'id_berita'};
					$date_pub = $newsData ->{'date_pub'};
					$date_pub = $util -> changeFormatDateFromNumberToString ( $date_pub );
					
					if ( $loop == ( $number_of_contents - 1 ) )
					{
						if ( $firsttime == 0 )
						{
							echo "<div class=\"item\">";
							echo "<ul class=\"list-posts\">";
							
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							echo "</ul>";
							echo "</div>";
						}
						else
						{
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
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
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							
							$firsttime = 1;
							$show ++;
						}
						else
						{
							if ( $show < 1 )
							{
								echo "<li>";
								echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
								echo "<div class=\"post-content\">";
								echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
								echo "<ul class=\"post-tags\">";
								echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</li>";
								
								$show ++;
							}
							else
							{
								if ( $show == 1 )
								{
									echo "<li>";
									echo "<img src=\"" . $img_directory.$newsData ->{'pict'}
									     . "\" alt=\"\" height=\"70\" weight=\"150\">";
									echo "<div class=\"post-content\">";
									echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
									echo "<ul class=\"post-tags\">";
									echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
									echo "</ul>";
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


    <div class="carousel-box owl-wrapper">
        <div class="title-section">
            <h1><span>TELECOMUNICATION</span></h1>
        </div>

        <!--        <div class = "title-section" style = "border-bottom: 2px solid #ade84e;" >-->
        <!--            <h1 ><span class = "world" style = "background-color: #ade84e; color:-->
        <!--            #F5F5F5; padding: 10px; border-bottom: none;font-size: 14px;" >TELECOMUNICATION</span ></h1 >-->
        <!--        </div >-->

        <div class="owl-carousel"
             data-num="2">
			<?php
				$id_news   = [];
				$firsttime = 0;
				$show      = 0;
				$loop      = 0;
				
				$id_category = json_decode ( $act -> getIDTopic ( "Telecomunication" ) );
				$id_category = $id_category ->{'id_category'};
				
				$date_today
					             = $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
					                                                                                            1 ) ) );
				$date_5_days_ago = $util -> getDateBeforeToday ( $date_today , 10000 );
				
				$id_news = $act -> getIDNews (
					$id_category ,
					$date_today ,
					$date_5_days_ago );
				
				$number_of_contents = sizeof ( $id_news );
				
				for ( $loop ; $loop < $number_of_contents ; $loop ++ )
				{
					$newsData = json_decode ( $act -> getNewsContent ( $id_news[ $loop ] ) );
					$id       = $newsData ->{'id_berita'};
					$date_pub = $newsData ->{'date_pub'};
					$date_pub = $util -> changeFormatDateFromNumberToString ( $date_pub );
					
					if ( $loop == ( $number_of_contents - 1 ) )
					{
						if ( $firsttime == 0 )
						{
							echo "<div class=\"item\">";
							echo "<ul class=\"list-posts\">";
							
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							echo "</ul>";
							echo "</div>";
						}
						else
						{
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
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
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							
							$firsttime = 1;
							$show ++;
						}
						else
						{
							if ( $show < 1 )
							{
								echo "<li>";
								echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
								echo "<div class=\"post-content\">";
								echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
								echo "<ul class=\"post-tags\">";
								echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</li>";
								
								$show ++;
							}
							else
							{
								if ( $show == 1 )
								{
									echo "<li>";
									echo "<img src=\"" . $img_directory.$newsData ->{'pict'}
									     . "\" alt=\"\" height=\"70\" weight=\"150\">";
									echo "<div class=\"post-content\">";
									echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
									echo "<ul class=\"post-tags\">";
									echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
									echo "</ul>";
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
            <img src="images/advertising.png"
                 alt="">
        </div>
        <div class="tablet-advert">
            <span>Advertisement</span>
            <img src="images/advertising.png"
                 alt="">
        </div>
        <div class="mobile-advert">
            <span>Advertisement</span>
            <img src="images/advertising.png"
                 alt="">
        </div>
    </div>

    <div class="carousel-box owl-wrapper">
        <div class="title-section">
            <h1><span>FOOD AND HEALTHY</span></h1>
        </div>

        <!--        <div class = "title-section" style = "border-bottom: 2px solid #e84ec0;" >-->
        <!--            <h1 ><span class = "world" style = "background-color: #e84ec0; color:-->
        <!--            #F5F5F5; padding: 10px; border-bottom: none;font-size: 14px;" >FOOD AND HEALTHY</span ></h1 >-->
        <!--        </div >-->

        <div class="owl-carousel"
             data-num="2">
			<?php
				$id_news   = [];
				$firsttime = 0;
				$show      = 0;
				$loop      = 0;
				
				$id_category = json_decode ( $act -> getIDTopic ( "Food And Healthy" ) );
				$id_category = $id_category ->{'id_category'};
				
				$date_today
					             = $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday ( $util -> getDateToday () ,
					                                                                                            1 ) ) );
				$date_5_days_ago = $util -> getDateBeforeToday ( $date_today , 10000 );
				
				$id_news = $act -> getIDNews (
					$id_category ,
					$date_today ,
					$date_5_days_ago );
				
				
				$number_of_contents = sizeof ( $id_news );
				
				for ( $loop ; $loop < $number_of_contents ; $loop ++ )
				{
					$newsData = json_decode ( $act -> getNewsContent ( $id_news[ $loop ] ) );
					$id       = $newsData ->{'id_berita'};
					$date_pub = $newsData ->{'date_pub'};
					$date_pub = $util -> changeFormatDateFromNumberToString ( $date_pub );
					
					if ( $loop == ( $number_of_contents - 1 ) )
					{
						if ( $firsttime == 0 )
						{
							echo "<div class=\"item\">";
							echo "<ul class=\"list-posts\">";
							
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							echo "</ul>";
							echo "</div>";
						}
						else
						{
							echo "<li>";
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
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
							echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
							echo "</ul>";
							echo "</div>";
							echo "</li>";
							
							
							$firsttime = 1;
							$show ++;
						}
						else
						{
							if ( $show < 1 )
							{
								echo "<li>";
								echo "<img src=\"" . $img_directory.$newsData ->{'pict'} . "\" alt=\"\" height=\"70\" weight=\"150\">";
								echo "<div class=\"post-content\">";
								echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
								echo "<ul class=\"post-tags\">";
								echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
								echo "</ul>";
								echo "</div>";
								echo "</li>";
								
								$show ++;
							}
							else
							{
								if ( $show == 1 )
								{
									echo "<li>";
									echo "<img src=\"" . $img_directory.$newsData ->{'pict'}
									     . "\" alt=\"\" height=\"70\" weight=\"150\">";
									echo "<div class=\"post-content\">";
									echo "<h2><a href=\"read?id=" . $id . "\">" . $newsData ->{'title'} . "</a></h2>";
									echo "<ul class=\"post-tags\">";
									echo "<li><i class=\"fa fa-clock-o\"></i> " . $date_pub . "</li>";
									echo "</ul>";
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
</div>