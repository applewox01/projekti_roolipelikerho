
//pari ongelmaa
//kokoa muuttaessa, se voi ylittää näytön koon ja mennä ulkopuolelle
//avatessa uusi ikkuna, toinen ikkuna menee ulkopuolelle

document.addEventListener("DOMContentLoaded", function(){

    const icons = document.getElementsByClassName("icon-box");
    for (let icon of icons) {
        icon.addEventListener("click", function(){
            const icon_window = document.getElementById(`${icon.id}_window`)
            if (icon_window.style.display == "none") {
                icon_window.style.display = "block";
            } else {
                icon_window.style.display = "none";
            }
        })
    }

    const character_boxes = document.getElementsByClassName("character_box");
    for (let box of character_boxes) {
        box.addEventListener("click", function(){
            const character_info = box.getElementsByClassName("character_info");
            if (character_info.length > 0) {
                if (character_info[0].style.display == "none") {
                    character_info[0].style.display = "block"
                } else {
                    character_info[0].style.display = "none"
                }
            }

        })
    }

    /*const add_character = document.getElementById("add_character");
    add_character.addEventListener("click", function(){
        const unassigned_list = document.getElementById("unassigned_list")
        if (unassigned_list.style.display == "none") {
            unassigned_list.style.display = "block"
        } else {
            unassigned_list.style.display = "none"
        }
    })*/

    /*const add_character_boxes = document.getElementsByClassName("add_character_box")
    for (let box of add_character_boxes) {
        box.addEventListener("click", function(){
            const scenario_id = document.getElementById("scenario_id").data;
            const character_id = box.id;
            const request = new XMLHttpRequest();
            request.onload(function(){

            })
            request.open("POST", "/addcharacter");
            request.send(scenario_id,character_id);
        })

    }*/

})
