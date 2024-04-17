function getRandomColor() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    const alpha = Math.random().toFixed(1); 
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}
    
    if (expenseTable && expenseTable.length === 0) {
    document.getElementById('expenseChart').style.display = 'none';
    }

    const expenseCategories = expenseTable.map(row => row.category);
    const expenseAmounts = expenseTable.map(row => row.amount);

    const ctx1 = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx1, {
    type: 'pie',
    data: {
    labels: expenseCategories,
    datasets: [{
    data: expenseAmounts,
    backgroundColor: expenseAmounts.map(() => getRandomColor()),
    }]
    },
    options: {
    responsive: true,
    maintainAspectRatio: true
    }
    });