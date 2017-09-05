<script src="app-assets/plugins/ckeditor/ckeditor.js"></script>

<?php
	$id_berita = $_COOKIE[ 'mp_dat' ];
	$news_dat  = json_decode ( $act -> getNewsData ( $id_berita ) );
	
	echo "<input type=\"hidden\" value=\"$id_berita\" id=\"id_news\"/>";
	
	$title_news   = $news_dat ->{'title'};
	$content_news = $news_dat ->{'kontent_berita'};
	$pict         = $news_dat ->{'pict'};
	$id_category  = $news_dat ->{'id_category'};
	$source_img   = $news_dat ->{'pict_source'};
?>

<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Posting Berita</h4>
                </div>

                <div class="card-body">
                    <div class="card-block card-dashboard ">
                        <div class="form-group">
                            <fieldset class="form-group">
                                <label for="newstitle"><strong>Judul Berita</strong></label>
                                <input type="text" class="form-control" id="newstitle" autocomplete="off"
                                       value="<?php echo $title_news ?>">
                            </fieldset>

                            <br>
                            <label for="ckeditor"><strong>Kontent Berita</strong></label>
                            <textarea id="ckeditor" name="ckeditor"><?php echo $content_news ?></textarea>
                            <script>CKEDITOR.replace ( 'ckeditor' , { height : 150 } )</script>

                            <br><br>
                            <fieldset class="form-group">
                                <label for="basicInputFile"><strong>Thumbnail Gambar</strong></label>
                                <br>
                                <img src="<?php echo $img_directory . $pict ?>" width="40%" alt="not found image"/>
                                <br><br>
                                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail"
                                       accept="image/*">
                            </fieldset>

                            <br>
                            <fieldset class="form-group">
                                <label for="category"><strong>Sumber Gambar / Keterangan Gambar <i
                                                style="font-size:11px;">(cantumkan sumber apabila gambar diperoleh dari
                                            sumber lain atau berikan text keterangan pada gambar)</i></strong></label>
                                <input type="text" class="form-control" id="source_image" autocomplete="off"
                                       value="<?php echo $source_img ?>">
                            </fieldset>

                            <br>
                            <label for="category"><strong>Kategori Berita</strong></label>
                            <select class="select2-placeholder form-control" id="category">
                                <option>Pilihan</option>
								
								<?php
									$query         = "SELECT * FROM tbl_category";
									$category_data = $db -> getAllValue ( $query );
									
									foreach ( $category_data as $category_data )
									{
										$selected = $id_category == $category_data[ 'id_category' ] ? "selected" : "";
										
										echo " <option value=" . "\"" . $category_data[ 'id_category' ] . "\""
										     . $selected . ">"
										     . $util -> uppercaseFirstCharaEachWord ( $category_data[ 'category' ] ) .
										     "</option>";
									}
								?>

                                </optgroup>
                            </select>

                            <br/><br/>
                            <button type="button" class="btn btn-secondary"
                                    style="background-color: #4d4e4c; color: #f3f4f4; border-color: #4d4e4c;"
                                    id="start_posting">Edit Posting
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
	
	var initApp = function ()
	{
		$ ( '#start_posting' ).click ( postNews )
	}
	
	function postNews ()
	{
		var newstitle    = $ ( '#newstitle' ).val ()
		var source_image = $ ( '#source_image' ).val ()
		var contentnews  = CKEDITOR.instances[ 'ckeditor' ].getData ()
		var category     = $ ( '#category option:selected' ).val ()
		var id_news      = $ ( '#id_news' ).val ()
		
		contentnews = encodeURIComponent ( contentnews )
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   data     : 'type=reqeditpostnews' + '&newstitle=' + newstitle + '&contentnews=' + contentnews + '&category=' + category + '&id_news=' + id_news + '&source_img= ' +
			              source_image ,
			   dataType : 'JSON' ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ 'type' ] === 'reseditpostnews' )
						   {
							   if ( JSONObject[ key ][ 'success' ] === 'success' )
							   {
								   $ ( '#newstitle' ).val ( '' )
								   CKEDITOR.instances[ 'ckeditor' ].setData ( '' )
								
								   var file_data = $ ( '#thumbnail' ).prop ( 'files' )[ 0 ]
								   var form_data = new FormData ()
								   form_data.append ( 'file' , file_data )
								   form_data.append ( 'user_id' , 123 )
								
								   console.log ( 'data image = ' + file_data )
								
								   if ( file_data === undefined )
								   {
									   alert ( "kontent berita berhasil diperbaharui" )
								   }
								   else
								   {
									   $.ajax
									    ( {
										      type        : 'POST' ,
										      url         : 'API_journalist/upload_pict.php' ,
										      dataType    : 'script' ,
										      contentType : false ,
										      processData : false ,
										      data        : form_data ,
										      cache       : false ,
										      success     : function ( res )
										      {
											      if ( res == 1 )
											      {
												      alert ( 'kontent berita berhasil disimpan' )
											      }
											      else
											      {
												      alert ( 'kontent berita gagal disimpan' )
											      }
										      } ,
									      } )
									
									   $ ( '#thumbnail' ).val ( '' )
								   }
								
							   }
							   else
							   {
								   alert ( 'Gagal menyimpang memperbaharui kontent berita' )
							   }
						   }
					   }
				   }
			   } ,
		   } )
	}
	
	$ ( document ).ready ( initApp )
</script>