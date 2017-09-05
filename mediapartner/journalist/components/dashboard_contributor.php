<div class = "card" >
    <div class = "card-body" >
		<div class = "card-block" >
		    <div class = "row" >
		        <div class = "col-xl-6 col-lg-6 col-md-12 border-right-blue-grey
		        border-right-lighten-5 clearfix" >
		            <div class = "media" >
		                <div class = "media-left" >
		                    <img class = "media-object img-xl"
		                         src = "app-assets/images/portrait/small/avatar-s-5.png"
		                         alt = "Generic placeholder image" >
		                </div >
		                <div class = "media-body" >
		                    <h6 class = "text-bold-500 pt-1 mb-0" ><?php echo $full_name ?></h6 >
		                    <p >
			                    <?php echo $level_name ?>
		                    </p >
		                </div >
		            </div >
		        </div >

		        <div class = "col-xl-3 col-lg-6 col-md-12 border-right-blue-grey
		        border-right-lighten-5 text-xs-center clearfix" >
			        <h6 class = "pt-1" style = "font-size:10px;" >
				        21 Juni 2017 20:00:00
		            </h6 >
		            <p style = "font-size: 17px;" >Login Terbaru</p >
		        </div >

		        <div class = "col-xl-3 col-lg-6 col-md-12 text-xs-center clearfix" >
		            <h6 class = "pt-1" style = "font-size:10px;" >
			            21 Juni 2017 15:00:00
		            </h6 >
		            <p style = "font-size: 17px;" >Login Terakhir</p >
		        </div >
		    </div >
		</div >
    </div >
</div >

<div class = "row" >
    <div class = "col-xs-12" >
        <div class = "card" >
            <div class = "card-body" >
                <div class = "row" >
                    <div class = "col-xl-6 col-lg-6 col-md-12 border-right-blue-grey
                    border-right-lighten-5" >
                        <div class = "my-1 text-xs-center" >
                            <div class = "card-header mb-2 pt-0" >
                                <h5 class = "primary" >Point Reward</h5 >
	                            <?php
		                            $total = 0;

		                            $query     = "SELECT * FROM tbl_point WHERE id_user=?";
		                            $point_dat = $db->getAllValue ($query , [ $id_user ]);

		                            foreach ( $point_dat as $point_dat )
		                            {
			                            $total = (int) $point_dat['nominal'] + $total;
		                            }

		                            echo "<h3 class = \"font-large-2 text-bold-200\" >" . $total . "</h3 >";
	                            ?>

                            </div >
                            <div class = "card-body" >

                            </div >
                        </div >
                    </div >
                    <div class = "col-xl-6 col-lg-6 col-md-12 border-right-blue-grey
                    border-right-lighten-5" >
                        <div class = "my-1 text-xs-center" >
                            <div class = "card-header mb-2 pt-0" >
                                <h5 class = "danger" >Kontribusi Berita</h5 >
	                            <?php
		                            $total = 0;

		                            $query    = "SELECT * FROM tbl_berita WHERE id_user_kontributor=?";
		                            $news_dat = $db->getAllValue ($query ,
			                            [ $id_user ]);

		                            foreach ( $news_dat as $news_dat )
		                            {
			                            $total = $total + 1;
		                            }

		                            echo " <h3 class = \"font-large-2 text-bold-200\" >" . $total . "</h3 >"
	                            ?>

                            </div >
                            <div class = "card-body" >

                            </div >
                        </div >
                    </div >
	                <!--                    <div class = "col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5" >-->
	                <!--                        <div class = "my-1 text-xs-center" >-->
	                <!--                            <div class = "card-header mb-2 pt-0" >-->
	                <!--                                <h5 class = "warning" >Calories</h5 >-->
	                <!--                                <h3 class = "font-large-2 text-bold-200" >4,025 <span-->
	                <!--			                                class = "font-medium-1 grey darken-1 text-bold-400" >kcal</span ></h3 >-->
	                <!--                            </div >-->
	                <!--                            <div class = "card-body" >-->
	                <!---->
	                <!--                            </div >-->
	                <!--                        </div >-->
	                <!--                    </div >-->
	                <!--                    <div class = "col-xl-3 col-lg-6 col-md-12" >-->
	                <!--                        <div class = "my-1 text-xs-center" >-->
	                <!--                            <div class = "card-header mb-2 pt-0" >-->
	                <!--                                <h5 class = "success" >Heart Rate</h5 >-->
	                <!--                                <h3 class = "font-large-2 text-bold-200" >102 <span class = "font-medium-1 grey darken-1 text-bold-400" >BPM</span ></h3 >-->
	                <!--                            </div >-->
	                <!--                            <div class = "card-body" >-->
	                <!---->
	                <!--                            </div >-->
	                <!--                        </div >-->
	                <!--                    </div >-->
                </div >
            </div >
        </div >
    </div >
</div >