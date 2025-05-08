<h2 class="mb-4">Пошук працівників за номером відділу</h2>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="/employee/search" class="row g-3 align-items-end">
            <div class="col-md-6">
                <label for="deptno" class="form-label">Номер відділу:</label>
                <input type="number" id="deptno" name="deptno" class="form-control"
                    value="<?= htmlspecialchars($deptno ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Знайти</button>
            </div>
        </form>
    </div>
</div>

<?php if ($result): ?>
    <div class="card">
        <div class="card-header bg-light">
            <h3 class="mb-0">Результати пошуку для відділу №<?= htmlspecialchars($deptno) ?></h3>
        </div>
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
                        <?php
                        $rowsCount = 0;
                        while (odbc_fetch_row($result)):
                            $rowsCount++;
                            ?>
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

            <?php if ($rowsCount == 0): ?>
                <div class="alert alert-info mt-3">У відділі №<?= htmlspecialchars($deptno) ?> не знайдено працівників</div>
            <?php endif; ?>
        </div>
    </div>
<?php elseif ($deptno !== null): ?>
    <div class="alert alert-warning">Не вдалося виконати пошук. Спробуйте ще раз</div>
<?php endif; ?>