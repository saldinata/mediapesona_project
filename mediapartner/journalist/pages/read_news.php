<section class = "basic-elements" >
    <div class = "row" >
        <div class = "col-md-12" >
            <div class = "card" >
                <div class = "card-header" >
                    <h4 class = "card-title" >Preview Berita</h4 >
                </div >

                <div class = "card-body" >
                    <div class = "card-block card-dashboard " >
                        <?php
                        $id_berita = $_COOKIE[ 'mp_dat' ];

                        echo "<input type=\"hidden\" value=\"$id_berita\" id=\"idberita\"/>";

                        $query   = "SELECT * FROM tbl_berita WHERE id_berita=?";
                        $newsdat = $db->getValue($query, [$id_berita]);
                        ?>
                        <div class = "card-text" >
                            <?php
                            echo "<h1>".$newsdat[ 'judul_berita' ]."</h1>";
                            echo "<span style=\"font-size: 12px; font-style: italic;\"> tanggal penulisan : ".$newsdat[ 'date_create' ]."</span><br><br><br>";
                            
                            echo "<img src=\"".$img_directory.$newsdat[ 'thumbnail' ]."\" width=\"100%\" alt=\"image not found\"/><br><br><br>";

                            echo $newsdat[ 'content_berita' ];
                            ?>
                            <br ><br >
                            <button type = "button"
                                    class = "btn btn-secondary btn-min-width mr-1 mb-1"
                                    id = "btn_show_modal_reward"
                                    data-toggle = \"modal\"
                                    data-target = \"#default\" >Approve</button >
                            <button type = "button"
                                    class = "btn btn-secondary btn-min-width mr-1 mb-1"
                                    id = "btn_edit"
                                    data-toggle = \"modal\"
                                    data-target = \"#default\" >Edit</button >
                        </div >
                    </div >
                </div >
            </div >
        </div >
    </div >
    </div>
</section >


 <div class = "modal fade text-xs-left"
      id = "default"
      tabindex = "-1"
      role = "dialog"
      aria-labelledby = "myModalLabel1"
      aria-hidden = "true" >
  <div class = "modal-dialog"
       role = "document" >
	<div class = "modal-content" >
	  <div class = "modal-header" >
		<button type = "button"
                class = "close"
                data-dismiss = "modal"
                aria-label = "Close" >
		  <span aria-hidden = "true" >&times;</span >
		</button >
		<h4 class = "modal-title"
            id = "myModalLabel1" >Approve Dialog</h4 >
	  </div >
	  <div class = "modal-body" >
		<h5 >Point Reward Kontributor</h5 >
		  <input type = "text"
                 class = "form-control"
                 id = "point_reward"
                 placeholder = "Nominal Point Reward"
                 autocomplete = "off" />
	  </div >
	  <div class = "modal-footer" >
		<button type = "button"
                class = "btn grey btn-outline-secondary"
                data-dismiss = "modal" >Tutup</button >
		<button type = "button"
                class = "btn btn-outline-primary"
                id = "btn_approve" >Lanjutkan Approve</button >
	  </div >
	</div >
  </div >
</div >



<script type = "text/javascript" >

    const approval_news_page = 'approval_news'
    const edit_news_page     = 'edit_news'

    var initApp = function ()
    {
      $('#btn_approve').click(approveNews)
      $('#btn_show_modal_reward').click(showModal)
      $('#btn_edit').click(editContent)
    }

    function showModal ()
    {
      $('#default').modal('show')
    }

    function closeModal ()
    {
      $('#point_reward').val()
      $('#default').modal('hide')
    }

    function editContent ()
    {
      var id_berita = $('#idberita').val()
      setCookie ("mp_dat", id_berita, 1)
      document.location.href = edit_news_page
    }

    function setCookie (cname, cvalue, exdays)
    {
      var d = new Date()
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
      var expires     = 'expires=' + d.toUTCString()
      document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/'
    }

    function approveNews ()
    {
      var id_berita    = $('#idberita').val()
      var point_reward = $('#point_reward').val()
  
      storePointReward(point_reward, id_berita)
      setApproveNews(id_berita)
    }

    function setApproveNews (id_berita)
    {
      $.ajax
        ({
          type    : 'POST',
          url     : 'API_journalist/api_journalist.php',
          data    : 'type=reqapprovenews' + '&id_berita=' + id_berita,
          dataType: 'JSON',
          cache   : false,
          async   : false,
          success : function (JSONObject)
          {
            for (var key in JSONObject)
            {
              if (JSONObject.hasOwnProperty(key))
              {
                if (JSONObject[key]['type'] === 'resapprovenews')
                {
                  if (JSONObject[key]['state'] === 'true')
                  {
                    alert('berita berhasil diapprove')
                    document.location.href = approval_news_page
                  }
                }
              }
            }
          },
        })
      return false
    }

    function storePointReward (point, id_berita)
    {
      var point     = point
      var id_berita = id_berita
  
      $.ajax
        ({
          type    : 'POST',
          url     : 'API_journalist/api_journalist.php',
          data    : 'type=reqstorepointreward' + '&point=' + point + '&id_berita=' +
                    id_berita,
          dataType: 'JSON',
          cache   : false,
          async   : false,
          success : function (JSONObject)
          {
            for (var key in JSONObject)
            {
              if (JSONObject.hasOwnPropety(key))
              {
                if (JSONObject[key]['type'] === 'resstorepointreward')
                {
                  if (JSONObject[key]['state'] === 'true')
                  {
                    console.log('points have been saved')
                    closeModal()
                  }
                }
              }
            }
          },
        })
      return false
    }

    $(document).ready(initApp)
</script >