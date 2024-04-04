

document.addEventListener("DOMContentLoaded", function(){

    const icons = document.getElementsByClassName("icon-box");
    for (let icon of icons) {
        const icon_window = document.getElementById(`${icon.id}_window`)
        icon_window.style.display = "none";
        icon.addEventListener("click", function(){
            if (icon_window.style.display == "none") {
                icon.style["background-color"] = "grey";
                icon_window.style.display = "block";
            } else {
                icon.style["background-color"] = "lightgray";
                icon_window.style.display = "none";
            }
        })
    }

    //lukee character, mutta pätee jokaista info nappia
    const character_box = document.getElementsByClassName("character_box");
    const character_box_error = document.getElementsByClassName("character_box_error");
    for (let box of character_box) {
        const character_info = box.getElementsByClassName("character_info");
        character_info[0].style.display = "none";
        box.addEventListener("click", function(){
            if (character_info.length > 0) {
                if (character_info[0].style.display == "none") {
                    character_info[0].style.display = "block";
                } else {
                    character_info[0].style.display = "none";
                }
            }
        })
    };
    for (let box of character_box_error) {
        const character_info = box.getElementsByClassName("character_info");
        character_info[0].style.display = "none";
        box.addEventListener("click", function(){
            if (character_info.length > 0) {
                if (character_info[0].style.display == "none") {
                    character_info[0].style.display = "block";
                } else {
                    character_info[0].style.display = "none";
                }
            }
        })
    };


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
