
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
            
                if (event.clientX < viewportWidth-(object.style.width) 
                && event.clientY < viewportHeight-(object.style.height) 
                && event.clientY-(object.style.height) > object.style.width 
                && event.clientX-(object.style.width) > object.style.width) {
                    object.style.top = (event.clientY + scrollY - 50) + "px"
                    object.style.left = (event.clientX + scrollX - 65) + "px"
                }
            };
            
            document.addEventListener("mouseup", function(){
                document.removeEventListener("mousemove", moveObject);
                
            });
            
            });
    };
})
