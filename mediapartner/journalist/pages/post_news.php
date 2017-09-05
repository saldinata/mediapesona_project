<script src = "app-assets/plugins/ckeditor/ckeditor.js" ></script >

<section class = "basic-elements" >
    <div class = "row" >
        <div class = "col-md-12" >
            <div class = "card" >
                <div class = "card-header" >
                    <h4 class = "card-title" >Posting Berita</h4 >
                </div >
                <div class = "card-body" >
                    <div class = "card-block card-dashboard " >
                        <div class = "form-group" >
                            <fieldset class = "form-group" >
                                <label for = "newstitle" ><strong >Judul Berita</strong ></label >
                                <input type = "text" class = "form-control" id = "newstitle" autocomplete = "off" >
                            </fieldset >

                            <br >
                            <label for = "ckeditor" ><strong >Kontent Berita</strong ></label >
                            <textarea id = "ckeditor" name = "ckeditor" ></textarea >
                            <script >CKEDITOR.replace('ckeditor', {height: 150})</script >

                            <br ><br >
                            <fieldset class = "form-group" >
                                <label for = "basicInputFile" ><strong >Thumbnail Gambar</strong ></label >
                                <input type = "file" class = "form-control-file" id = "thumbnail" name = "thumbnail" accept = "image/*" >
                            </fieldset >
                            
                            <br >
                            <fieldset class = "form-group" >
                            <label for = "category" ><strong >Sumber Gambar / Keterangan Gambar <i style = "font-size:11px;" >(cantumkan sumber apabila gambar diperoleh dari sumber lain atau berikan text keterangan pada gambar)</i ></strong ></label >
                            <input type = "text" class = "form-control" id = "source_image" autocomplete = "off" >
                            </fieldset >

                            <br >
                            <label for = "category" ><strong >Kategori Berita</strong ></label >
                            <select class = "select2-placeholder form-control" id = "category" >
                                <option >Pilihan</option >
    
                                <?php
                                $query         = "SELECT * FROM tbl_category";
                                $category_data = $db->getAllValue($query);
    
                                foreach ($category_data as $category_data)
                                {
                                    echo " <option value="."\"".$category_data[ 'id_category' ]."\"".">".$util->uppercaseFirstCharaEachWord($category_data[ 'category' ]).
                                         "</option>";
                                }
                                ?>
    
                                </optgroup>
                            </select >

                            <br ><br >
                            <button type = "button" class = "btn btn-secondary" style = "background-color: #4d4e4c; color: #f3f4f4; border-color: #4d4e4c;" id = "start_posting" >Mulai Posting</button >
                        </div >
                    </div >
                </div >

            </div >
        </div >
    </div >
    </div>
</section >

<script type = "text/javascript" >

    var initApp = function ()
    {
      $('#start_posting').click(postNews)
    }

    function postNews ()
    {
      var newstitle    = $('#newstitle').val()
      var source_image = $('#source_image').val()
      var contentnews  = CKEDITOR.instances['ckeditor'].getData()
      var category     = $('#category option:selected').val()
  
      contentnews = encodeURIComponent(contentnews)
  
      $.ajax
        ({
          type    : 'POST',
          url     : 'API_journalist/api_journalist.php',
          data    : 'type=reqpostnews' + '&newstitle=' + newstitle + '&contentnews=' + contentnews + '&category=' + category + '&source_img= ' + source_image,
          dataType: 'JSON',
          cache   : false,
          success : function (JSONObject)
          {
            for (var key in JSONObject)
            {
              if (JSONObject.hasOwnProperty(key))
              {
                if (JSONObject[key]['type'] === 'respostnews')
                {
                  if (JSONObject[key]['success'] === 'success')
                  {
                    $('#newstitle').val('')
                    $('#source_img').val()
                    CKEDITOR.instances['ckeditor'].setData('')
//                                        $("#category option:selected").val("");
              
                    var file_data = $('#thumbnail').prop('files')[0]
                    var form_data = new FormData()
                    form_data.append('file', file_data)
                    form_data.append('user_id', 123)
              
                    $.ajax
                      ({
                        type       : 'POST',
                        url        : 'API_journalist/upload_pict.php',
                        dataType   : 'script',
                        contentType: false,
                        processData: false,
                        data       : form_data,
                        cache      : false,
                        success    : function (res)
                        {
                          if (res == 1)
                          {
                            alert('Tulisan berhasil disimpan')
                          }
                          else
                          {
                            alert('Tulisan gagal disimpan')
                          }
                        },
                      })
              
                    $('#thumbnail').val('')
              
                  }
                  else
                  {
                    alert('Gagal menyimpang posting')
                  }
                }
              }
            }
          },
        })
    }
    $(document).ready(initApp)
</script >