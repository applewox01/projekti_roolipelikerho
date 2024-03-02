
document.addEventListener("DOMContentLoaded", function(){
    const objects = document.getElementsByClassName("moveable_window");
    for (let object of objects) {
        object.addEventListener("mousedown", function(){
    
            document.addEventListener("mousemove", moveObject)
            function moveObject(event) {
                event.preventDefault();
                object.className = "window_moved";
                const viewportWidth = window.innerWidth;
                const viewportHeight = window.innerHeight;
                const scrollX = window.scrollX;
                const scrollY = window.scrollY;
                //console.log(event.clientY)
            
                if (event.clientX < viewportWidth-(object.style.width-50) 
                && event.clientY < viewportHeight-(object.style.height-50) 
                && event.clientY-(object.style.height-50) > object.style.width 
                && event.clientX-(object.style.width-50) > object.style.width) {
                    object.style.top = (event.clientY + scrollY - (object.style.height)) + "px"
                    object.style.left = (event.clientX + scrollX - (object.style.width)) + "px"
                }
            };
            
            document.addEventListener("mouseup", function(){
                document.removeEventListener("mousemove", moveObject);
                
            });
            
            });
    };
})
