<h2 class="mb-4">Таблиця SCOTT.EMP</h2>

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
                                ?>
                                <th><?= odbc_field_name($result, $i) ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while (odbc_fetch_row($result)): ?>
                            <tr>
                                <?php for ($i = 1; $i <= $kol_num; $i++): ?>
                                    <td>
                                        <?php
                                        if (odbc_result($result, $i) == NULL):
                                            echo "<span class='text-muted'>NULL</span>";
                                        else:
                                            echo htmlspecialchars(odbc_result($result, $i));
                                        endif;
                                        ?>
                                    </td>
                                <?php endfor; ?>
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