<section class = "basic-elements" >
    <div class = "row" >
        <div class = "col-md-12" >
            <div class = "card" >
                <div class = "card-header" >
                    <h4 class = "card-title" >Posting Breaking News</h4 >
                </div >
                <div class = "card-body" >
                    <div class = "card-block card-dashboard " >
                        <div class = "form-group" >
                            <fieldset class = "form-group" >
                                <label for = "newstitle" ><strong >Kontent Breaking News</strong ></label >
                                <input type = "text" class = "form-control" id = "breakingcontent" autocomplete = "off" >
                            </fieldset >
                            
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
      var content = $('#breakingcontent').val()
  
      $.ajax
        ({
          type    : 'POST',
          url     : 'API_journalist/api_journalist.php',
          data    : 'type=reqpostbreakingnews' + '&content=' + content,
          dataType: 'JSON',
          cache   : false,
          success : function (JSONObject)
          {
            for (var key in JSONObject)
            {
              if (JSONObject.hasOwnProperty(key))
              {
                if (JSONObject[key]['type'] === 'respostbreakingnews')
                {
                  if (JSONObject[key]['state'] === 'true')
                  {
                    $('#breakingcontent').val('')
              
                    alert('Berhasil menyimpang posting')
              
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