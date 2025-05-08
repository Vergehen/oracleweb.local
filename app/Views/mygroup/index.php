<div class="container mt-4">
    <h1>Група студентів</h1>

    <div class="mb-3">
        <a href="/mygroup/create" class="btn btn-primary">Додати новий запис</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ім'я</th>
                    <th>Прізвище</th>
                    <th>Дата народження</th>
                    <th>Номер телефону</th>
                    <th>Група</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td data-field="FIRST_NAME" data-firstname="<?= htmlspecialchars($row['FIRST_NAME']) ?>"
                            data-lastname="<?= htmlspecialchars($row['LAST_NAME']) ?>" class="editable">
                            <?= htmlspecialchars($row['FIRST_NAME']) ?>
                        </td>
                        <td data-field="LAST_NAME" data-firstname="<?= htmlspecialchars($row['FIRST_NAME']) ?>"
                            data-lastname="<?= htmlspecialchars($row['LAST_NAME']) ?>" class="editable">
                            <?= htmlspecialchars($row['LAST_NAME']) ?>
                        </td>
                        <td data-field="BIRTH_DATE" data-firstname="<?= htmlspecialchars($row['FIRST_NAME']) ?>"
                            data-lastname="<?= htmlspecialchars($row['LAST_NAME']) ?>" class="editable">
                            <?= htmlspecialchars($row['BIRTH_DATE']) ?>
                        </td>
                        <td data-field="PHONE_NUMBER" data-firstname="<?= htmlspecialchars($row['FIRST_NAME']) ?>"
                            data-lastname="<?= htmlspecialchars($row['LAST_NAME']) ?>" class="editable">
                            <?= htmlspecialchars($row['PHONE_NUMBER']) ?>
                        </td>
                        <td data-field="GROUP_ID" data-firstname="<?= htmlspecialchars($row['FIRST_NAME']) ?>"
                            data-lastname="<?= htmlspecialchars($row['LAST_NAME']) ?>" class="editable">
                            <?= htmlspecialchars($row['GROUP_ID']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editableCells = document.querySelectorAll('.editable');

        editableCells.forEach(cell => {
            cell.addEventListener('dblclick', function () {
                const field = this.getAttribute('data-field');
                const firstName = this.getAttribute('data-firstname');
                const lastName = this.getAttribute('data-lastname');
                const currentValue = this.textContent;

                const input = document.createElement('input');
                input.type = field === 'BIRTH_DATE' ? 'date' : 'text';
                input.value = currentValue;
                input.className = 'form-control edit-input';

                this.innerHTML = '';
                this.appendChild(input);
                input.focus();

                input.addEventListener('blur', function () {
                    saveChanges(field, firstName, lastName, this.value, cell);
                });

                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        saveChanges(field, firstName, lastName, this.value, cell);
                    }
                });
            });
        });

        function saveChanges(field, firstName, lastName, value, cell) {
            const formData = new FormData();
            formData.append('field', field);
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('value', value);

            fetch('/mygroup/update', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        cell.textContent = value;
                        cell.setAttribute('data-' + field.toLowerCase(), value);
                    } else {
                        alert('Помилка при оновленні: ' + data.error);
                        cell.textContent = cell.getAttribute('data-' + field.toLowerCase());
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    cell.textContent = cell.getAttribute('data-' + field.toLowerCase());
                });
        }
    });
</script>