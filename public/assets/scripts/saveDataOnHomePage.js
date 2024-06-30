function saveDataOnHomePage(){
    const selectedOption = localStorage.getItem('selectedOption');
    if (selectedOption) {
        document.getElementById('options').value = selectedOption;
    }

    document.getElementById('options').addEventListener('change', function() {
        localStorage.setItem('selectedOption', this.value);
        toggleFields();
    });

    function toggleFields() {
        const selectedOption = document.getElementById('options').value;
        const fieldsContainer = document.getElementById('fields');
        const fromDateInput = fieldsContainer.querySelector('input[name="fromDate"]');
        const toDateInput = fieldsContainer.querySelector('input[name="toDate"]');

        if (selectedOption === 'currentMonth') {
            const currentDate = new Date();
            const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            fromDateInput.value = formatDate(firstDayOfMonth);
            toDateInput.value = formatDate(lastDayOfMonth);

        } else if (selectedOption === 'previousMonth') {
            const currentDate = new Date();
            const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
            const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0);
            fromDateInput.value = formatDate(firstDayOfMonth);
            toDateInput.value = formatDate(lastDayOfMonth);

        } else {
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', () => {
                    localStorage.setItem(input.id, input.value);
                });
            });

            window.addEventListener('load', () => {
                document.querySelectorAll('input').forEach(input => {
                    const storedValue = localStorage.getItem(input.id);
                    if (storedValue) {
                        input.value = storedValue;
                    }
                });
            });
        }
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    toggleFields();
}