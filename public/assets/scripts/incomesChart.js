function getRandomColor() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    const alpha = Math.random().toFixed(1); 
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

     if (incomesTable && incomesTable.length === 0) {
        document.getElementById('incomesChart').style.display = 'none';
    }

    const incomeCategories = incomesTable.map((row) => row.category);
    const incomeAmounts = incomesTable.map((row) => row.amount);

    const ctx = document.getElementById('incomesChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: incomeCategories,
            datasets: [{
                data: incomeAmounts,
                backgroundColor: incomeAmounts.map(() => getRandomColor()),
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        },
    });