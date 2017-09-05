<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Arsip Berita</h4>
                </div>

                <div class="card-body">
                    <div class="card-block card-dashboard ">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                            <tr>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;width: 139px;">Judul</th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;width: 102px;">Waktu
                                    Penulisan
                                </th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;width: 102px;">Waktu
                                    Terbit
                                </th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;">Revisi</th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;">Kategori</th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;">Status</th>
                                <th style="font-size: 12px;font-weight: 700;text-align: center;">Opsional</th>
                            </tr>
                            </thead>

                            <tbody>
							<?php
								$counter   = 0;
								$query     = "SELECT * FROM tbl_berita";
								$news_data = $db -> getAllValue ( $query );
								
								foreach ( $news_data as $news_data )
								{
									$counter ++;
									
									$id_category = $news_data[ 'id_category' ];
									$id_state    = $news_data[ 'id_state' ];
									$id_berita   = $news_data[ 'id_berita' ];
									
									$category_name
										   = $act -> getCategoryName ( $id_category );
									$state = $act -> getStateName ( $id_state );
									
									$state_date_publish
										= ! empty( $news_data[ 'date_publish' ] ) ?
										$news_data[ 'date_publish' ] : "-";
									
									
									$button_option = $state == "publish"
										?
										"<button type=\"button\"
                                             class=\"btn btn-sm btn-secondary mr-1\"
                                             id=\"unpub" . $counter . "\">unpublish</button>"
										:
										"<button type=\"button\"
                                             class=\"btn btn-sm btn-secondary mr-1\"
											 id=\"pub" . $counter . "\">publish</button>";
									
									$label_state = $state == "publish"
										?
										"<span class=\"tag tag-primary\">" . $state . "</span>"
										:
										"<span class=\"tag tag-warning\">" . $state . "</span>";
									
									
									echo "<tr style=\"font-size: 14px;vertical-align: middle;\">";
									
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     "<a href=\"#\" id=\"title$counter\">" . $news_data[ 'judul_berita' ] . "</a>"
									     . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     $news_data[ 'date_create' ] . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     $state_date_publish . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     "-" . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     $category_name . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     $label_state . "</td>";
									echo "<td style=\"font-size: 12px; vertical-align: middle; padding: 12px; text-align: center; padding-top: 10px; padding-bottom: 10px;\">"
									     .
									     $button_option . "</td>";
									echo "<input type=\"hidden\" value=\"$id_berita\" id=\"id$counter\">";
									
									echo "</tr>";
								}
							?>

                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade text-xs-left"
     id="preview_news"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog modal-lg"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"
                    id="myModalLabel1">Preview Berita</h4>
            </div>
            <div class="modal-body">
                <h3 id="title_news"><strong></strong></h3>
                <br>
                <img id="image_news" src="" width="100%" alt="image not found"/><br><br><br>
                <p id="content_news"></p>
            </div>
            <!--	  <div class = "modal-footer" >-->
            <!--		<button type = "button"-->
            <!--                class = "btn grey btn-outline-secondary"-->
            <!--                data-dismiss = "modal" >Tutup</button >-->
            <!--		<button type = "button"-->
            <!--                class = "btn btn-outline-primary"-->
            <!--                id = "btn_approve" >Lanjutkan Approve</button >-->
            <!--	  </div >-->
        </div>
    </div>
</div>


<script type="text/javascript">
	
	$ ( document ).on ( 'click' , 'button[id^=pub]' , setPublish )
	$ ( document ).on ( 'click' , 'button[id^=unpub]' , setUnPublish )
	$ ( document ).on ( 'click' , 'a[id^=title]' , previewContent )
	
	var initApp = function ()
	{
	
	}
	
	function setPublish ()
	{
		var numbering = parseInt ( this.id.replace ( 'pub' , '' ) , 10 )
		var id_berita = $ ( '#id' + numbering ).val ()
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   dataType : 'JSON' ,
			   data     : 'type=reqsetpub' + '&id_berita=' + id_berita ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ 'type' ] === 'ressetpub' )
						   {
							   if ( JSONObject[ key ][ 'state' ] === 'true' )
							   {
								   document.location.reload ()
							   }
						   }
					   }
				   }
			   } ,
		   } )
		return false
	}
	
	function setUnPublish ()
	{
		var numbering = parseInt ( this.id.replace ( 'unpub' , '' ) , 10 )
		var id_berita = $ ( '#id' + numbering ).val ()
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   dataType : 'JSON' ,
			   data     : 'type=reqsetunpub' + '&id_berita=' + id_berita ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ 'type' ] === 'ressetunpub' )
						   {
							   if ( JSONObject[ key ][ 'state' ] === 'true' )
							   {
								   document.location.reload ()
							   }
						   }
					   }
				   }
			   } ,
		   } )
		return false
	}
	
	function previewContent ()
	{
		var numbering = parseInt ( this.id.replace ( 'title' , '' ) , 10 )
		var id_berita = $ ( '#id' + numbering ).val ()
		console.log ( id_berita )
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   dataType : 'JSON' ,
			   data     : 'type=reqpreviewnews' + '&id_berita=' + id_berita ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ 'type' ] === 'respreviewnews' )
						   {
							   var url_image = JSONObject[ key ][ 'pict' ]
							
							   console.log ( url_image )
							
							   $ ( '#title_news' ).html ( JSONObject[ key ][ 'title' ] )
							   $ ( '#content_news' ).html ( JSONObject[ key ][ 'kontent_berita' ] )
							   $ ( '#image_news' ).attr ( 'src' , url_image )
							   showModalPreview ()
						   }
					   }
				   }
			   } ,
		   } )
		return false
	}
	
	function showModalPreview ()
	{
		$ ( '#preview_news' ).modal ( 'show' )
	}
	
	$ ( document ).ready ( initApp )
</script>