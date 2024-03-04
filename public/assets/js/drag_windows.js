
document.addEventListener("DOMContentLoaded", function(){
    const objects = document.getElementsByClassName("moveable_window");
    for (let object of objects) {
        for (let child of object.querySelectorAll(".move_window")) {
                child.addEventListener("mousedown", function(){
    
                    document.addEventListener("mousemove", moveObject)
                    function moveObject(event) {
                        event.preventDefault();
                        object.style.position = "absolute";
                        const viewportWidth = window.innerWidth;
                        const viewportHeight = window.innerHeight;
                        object.style.opacity = 0.5;
                        object.style["pointer-events"] = "none";
        
                        let trueHeight = Number((object.style.height).replace('px', ''));
                        let trueWidth = Number((object.style.width).replace('px', ''));
        
                        //console.log(event.clientY)
        
                        if (event.clientY + (15) > 0 
                            && event.clientY + (trueHeight) < viewportHeight) {
                            trueHeight = Number((object.style.height).replace('px', ''));
                            object.style.top = (event.clientY - (15)) + "px"
                        }
                        if (event.clientX + (trueWidth - 75) > 150-trueWidth + 75
                            && event.clientX + (75) < viewportWidth) {
                            trueWidth = Number((object.style.width).replace('px', ''));
                            object.style.left = (event.clientX - (trueWidth - 75)) + "px"
                        }
                    };
                    
                    document.addEventListener("mouseup", function(){
                        object.style.opacity = 1;
                        object.style["pointer-events"] = "all";
                        document.removeEventListener("mousemove", moveObject);
                        
                    });
                    
                    });
                    break
        }
        for (let child of object.querySelectorAll(".hide_window")) {
            child.addEventListener("click", function(){
                for (let content of child.parentNode.querySelectorAll(".window_content")) {
                    if (content.style.hidden = false) {
                        content.style.hidden = true
                    } else {
                        content.style.hidden = true
                    }
                    break
                }
            })
            break
        }
    };
})
