
document.addEventListener("DOMContentLoaded", function(){
    const adventureList = document.getElementById("adventure-list");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.status == 200) {
        adventureList.innerHTML = xmlhttp.responseText;
    }
};
xmlhttp.open("GET", "../database/get_scenarios.blade.php", true);
xmlhttp.send();
})