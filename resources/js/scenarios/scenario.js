

document.addEventListener("DOMContentLoaded", function(){

    const icons = document.getElementsByClassName("icon-box");
    for (let icon of icons) {
        const icon_window = document.getElementById(`${icon.id}_window`)
        icon_window.style.display = "none";
        icon.addEventListener("click", function(){
            if (icon_window.style.display == "none") {
                icon.style["background-color"] = "grey";
                icon_window.style.display = "block";
                const other_windows = document.getElementsByClassName("moveable_window");
                for (const sW of other_windows) {
                    sW.style["z-index"] = "0";
                };
                icon_window.style["z-index"] = "1";
            } else {
                icon.style["background-color"] = "lightgray";
                icon_window.style.display = "none";
            }
        })
    }

    //lukee character, mutta pätee jokaista info nappia
    const character_box = document.getElementsByClassName("character_box");
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

    const mobile_window = document.getElementsByClassName("mobile_window");
    const mobile_version = document.getElementById("mobile_version")
    for (let window of mobile_window) {
        mobile_version.appendChild(window)
    }
    const exit_box_mobile = document.getElementById("exit-box-mobile");
    mobile_version.appendChild(exit_box_mobile);

    const image_box = document.getElementsByClassName("image_box");
    for (let box of image_box) {
        if (document.getElementById(`full_${box.id}`)) {
        
        //tämä ei toimi koska mobiili versio laiminlyödään!:
        const full_image = document.getElementById(`full_${box.id}`);
        full_image.style.display = "none";
        box.addEventListener("click", function(){
                if (full_image.style.display == "none") {
                    box.style.display = "none";
                    full_image.style.display = "block";
                };
        });
        const close_image = full_image.getElementsByClassName("close_image");
        close_image[0].addEventListener("click", function(){
            box.style.display = "block";
            full_image.style.display = "none";
        })
    };
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
