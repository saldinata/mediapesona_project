<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Approval Berita</h4>
                </div>

                <div class="card-body">
                    <div class="card-block card-dashboard ">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;width: 25%;">Judul</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Waktu penulisan</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Waktu terbit
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Revisi</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Kategori</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Status</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Opsional</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                $id_state = "2";
                                $counter  = 0;

                                $query     = "SELECT * FROM tbl_berita WHERE id_state=?";
                                $news_data = $db->getAllValue($query,
                                        [$id_state]);

                                foreach ($news_data as $news_data)
                                {
                                    $counter++;
                                    $id_category = $news_data['id_category'];
                                    $id_state    = $news_data['id_state'];
                                    $id_berita   = $news_data['id_berita'];

                                    $category_name = $act->getCategoryName($id_category);
                                    $state         = $act->getStateName($id_state);

                                    $state_date_publish = !empty($news_data['date_publish']) ? $news_data['date_publish'] : "-";

                                    echo "<tr style=\"font-size: 14px;vertical-align: middle;\">";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . $news_data['judul_berita'] . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . $news_data['date_create'] . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . $state_date_publish . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . "-" . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . $category_name . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\">" . $state . "</td>";
                                    echo "<td style=\"font-size: 14px;vertical-align: middle;\"> "
                                    . "<button type=\"button\" class=\"btn btn-icon btn-secondary mr-1\" id=\"pre" . $counter . "\"><i class=\"fa fa-eye\"></i></button>"
                                    . "<input type=\"hidden\" id=\"idberita" . $counter . "\" value=" . "\"" . $id_berita . "\"" . "/>"
                                    . "</td>";
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
</div>
</section>

<script type="text/javascript">
    
    const read_page = "read_news";
    
    $(document).on("click", "button[id^=pre]", previewNewsContent);

    var initApp = function ()
    {

    };


    function previewNewsContent()
    {
        var numbering = parseInt(this.id.replace("pre", ""), 10);
        var id_berita = $("#idberita" + numbering).val();

        var d = new Date();
        d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = "mp_dat" + "=" + id_berita + ";" + expires + ";path=/";
        
        document.location.href = read_page;
    }

    $(document).ready(initApp);

</script>