<h2 class="mb-4">Таблиця DEMO.CUSTOMER</h2>

<?php if ($result): ?>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <?php
                            $kol_num = odbc_num_fields($result);
                            for ($i = 1; $i <= $kol_num; $i++):
                                try {
                                    $field_name = odbc_field_name($result, $i);
                                    if ($field_name) {
                                        ?>
                                        <th><?= $field_name ?></th>
                                        <?php
                                    }
                                }
                                catch (Exception $e) {
                                    echo "<th>Error</th>";
                                }
                            endfor;
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while (odbc_fetch_row($result)): ?>
                            <tr>
                                <?php for ($i = 1; $i <= $kol_num; $i++):
                                    try {
                                        $value = @odbc_result($result, $i);
                                        ?>
                                        <td>
                                            <?php
                                            if ($value === false || $value === NULL):
                                                echo "<span class='text-muted'>NULL</span>";
                                            else:
                                                echo htmlspecialchars($value);
                                            endif;
                                            ?>
                                        </td>
                                        <?php
                                    }
                                    catch (Exception $e) {
                                        echo "<td>Error</td>";
                                    }
                                endfor;
                                ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info">Немає даних для відображення</div>
<?php endif; ?>