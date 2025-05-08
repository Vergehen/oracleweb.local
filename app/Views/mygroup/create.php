<div class="container mt-4">
    <h1>Додати новий запис до групи</h1>

    <form method="POST" action="/mygroup/create" id="createGroupForm">
        <div class="mb-3">
            <label for="firstName" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>

        <div class="mb-3">
            <label for="birthDate" class="form-label">Дата народження</label>
            <input type="date" class="form-control" id="birthDate" name="birthDate" required>
        </div>

        <div class="mb-3">
            <label for="phoneNumberVisible" class="form-label">Номер телефону</label>
            <div class="input-group">
                <span class="input-group-text">+380</span>
                <input type="tel" class="form-control" id="phoneNumberVisible" placeholder="XXXXXXXXX" maxlength="9">
                <input type="hidden" name="phoneNumber" id="phoneNumber" value="+380">
            </div>
            <small class="form-text text-muted">Формат: +380XXXXXXXXX (13 символів)</small>
        </div>

        <div class="mb-3">
            <label for="groupId" class="form-label">Група</label>
            <input type="text" class="form-control" id="groupId" name="groupId" placeholder="121-24-2" required>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="/mygroup" class="btn btn-secondary">Назад</a>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#phoneNumberVisible").on('input', function (e) {
            var value = $(this).val().replace(/[^\d]/g, '');
            $(this).val(value);
            $("#phoneNumber").val('+380' + value);
        });

        // Handle paste events for visible input
        $("#phoneNumberVisible").on('paste', function (e) {
            e.preventDefault();
            var clipboardData = e.originalEvent.clipboardData || window.clipboardData;
            var pastedData = clipboardData.getData('Text');

            var digits = pastedData.replace(/[^\d]/g, '');

            if (digits.length > 9) {
                digits = digits.substring(0, 9);
            }

            var currentValue = $(this).val().replace(/[^\d]/g, '');
            var cursorPos = this.selectionStart;
            var selectionLength = this.selectionEnd - this.selectionStart;

            var newValue;
            if (selectionLength > 0) {
                newValue = currentValue.substring(0, this.selectionStart) +
                    digits +
                    currentValue.substring(this.selectionEnd);
            } else {
                newValue = currentValue.substring(0, cursorPos) +
                    digits +
                    currentValue.substring(cursorPos);
            }

            if (newValue.length > 9) {
                newValue = newValue.substring(0, 9);
            }

            $(this).val(newValue);
            $("#phoneNumber").val('+380' + newValue);

            var newCursorPos = Math.min(cursorPos + digits.length, 9);
            this.selectionStart = newCursorPos;
            this.selectionEnd = newCursorPos;
        });

        $("#createGroupForm").on('submit', function (e) {
            const phoneNumber = $("#phoneNumber").val();
            const phoneDigits = $("#phoneNumberVisible").val();

            if (phoneDigits.length !== 9) {
                alert('Номер телефону має бути довжиною 9 цифр після +380 (всього 13 символів)');
                $("#phoneNumberVisible").focus();
                e.preventDefault();
                return false;
            }

            return true;
        });
    });
</script>