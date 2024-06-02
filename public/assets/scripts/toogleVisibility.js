function toggleDivVisibility(divNumber) {
    var div = document.getElementById("div" + divNumber);
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}