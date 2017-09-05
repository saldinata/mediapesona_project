<div class = "col-sm-8" >
    <div class = "block-content" >
        <div class = "single-post-box" >

            <div class = "title-post" >
                <h1 ><?php echo $news_data->{'title'} ?></h1 >
                <ul class = "post-tags" >
                    <li >
                        <i class = "fa fa-clock-o" ></i ><?php echo $date_publish ?>
                    </li >
                    <li >
                        <i class = "fa fa-user" ></i >oleh
                        <a href = "#" ><?php echo $contributor_name ?></a >
                    </li >
                    <li >
                        <i class = "fa fa-comments-o" ></i >
                        <span ><?php echo $comment_stats ?></span >
                    </li >
                    <li ><i class = "fa fa-eye" ></i ><?php echo $read_stats ?></li >
                </ul >
            </div >

            <div class = "post-gallery" >
                <img src = "<?php echo $img_directory.$news_data->{'pict'} ?>"
                     alt = "" >
                <span class = "image-caption" ><?php echo $pict_noted ?></span >
            </div >

            <div class = "post-content" >
				<?php echo $news_data->{'kontent_berita'} ?>
            </div >

            <br ><br ><br >
    
            <!-- contact form box -->
            <div class = "contact-form-box" >
                <div class = "title-section" >
                    <h1 >
	                    <span >Tinggalkan Komentar</span >
	                    <span class = "email-not-published" >
		                    Email Anda tidak dipublish</span >
                    </h1 >
                </div >

                <div id = "form_comment"
                     style = "display:none;" >
                    <form >
                        <label for = "comment" >Komentar Anda</label >
                        <br >
                        <textarea id = "comment"
                                  style = "width: 100%; height: 20%; margin-bottom: 3%;" ></textarea >
                        <br >
                        <button id = "comment_btn" >
                            <i class = "fa fa-comment" ></i > Post Comment
                        </button >
                    </form >
                </div >

                <div id = "login_reader"
                     style = "display:block;" >
                    <button type = "button"
                            class = "btn btn-secondary btn-min-width mr-1 mb-1"
                            id = "comment_login_btn"
                            style = "background-color: rgba(245, 245, 245, 0.59);border: 1px solid rgba(189, 189, 189, 0.9);" >
                        Login untuk komentar
                    </button >
                </div >
            </div >
        </div >
    </div >
</div >