$(document).ready(function() {
    $('.data-table th').click(function() {
        const table = $(this).parents('table').eq(0);
        const rows = table.find('tr:gt(0)').toArray().sort(compareCells($(this).index()));
        this.asc = !this.asc;
        if (!this.asc) {
            rows.reverse();
        }
        
        table.find('th').removeClass('sorting-asc sorting-desc');
        $(this).addClass(this.asc ? 'sorting-asc' : 'sorting-desc');
        
        for (let i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        }
    });

    function compareCells(index) {
        return function(a, b) {
            const valA = getCellValue(a, index);
            const valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
        };
    }

    function getCellValue(row, index) {
        return $(row).children('td').eq(index).text();
    }

    $('table').addClass('data-table');

    $('form').on('submit', function() {
        let isValid = true;
        $(this).find('input[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
        return isValid;
    });

    $('.alert').hide().fadeIn(500);
    
    $('.data-table th').each(function() {
        $(this).attr('title', 'Click to sort');
        $(this).css('cursor', 'pointer');
    });
    
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});