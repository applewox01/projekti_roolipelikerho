
const logout = document.getElementById('logout');
if (logout) {
    logout.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });
}

document.addEventListener("DOMContentLoaded", function(){
    if (document.getElementById("sort_form")) {
        const sort_form = document.getElementById("sort_form");
        sort_form.addEventListener("change", function() {
            sort_form.submit();
        })
    }
});
