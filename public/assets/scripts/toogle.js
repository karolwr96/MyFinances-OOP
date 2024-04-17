
    function toggleFields() {
        const select = document.getElementById('options');
        const fields = document.getElementById('fields');

        if (select.value === 'individualInterval') {
            fields.classList.remove('hidden');
        } else {
            fields.classList.add('hidden');
        }
    }
