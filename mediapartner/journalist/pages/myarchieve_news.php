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
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;width: 25%;">Judul</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Waktu penulisan</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Waktu terbit
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Revisi</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Kategori</th>
                                    <th style="font-size: 14px;font-weight: 700;text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $username = $util->decode($_COOKIE['mp_journalist']);
                                $id_user  = $auth->getUserID($username);

                                $query     = "SELECT * FROM tbl_berita WHERE id_user_kontributor=?";
                                $news_data = $db->getAllValue($query, [$id_user]);

                                foreach ($news_data as $news_data)
                                {
                                    $id_category = $news_data['id_category'];
                                    $id_state    = $news_data['id_state'];

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
