document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    let isMouseOverSidebar = false;

    sidebar.addEventListener('mouseenter', function() {
        isMouseOverSidebar = true;
    });

    sidebar.addEventListener('mouseleave', function() {
        isMouseOverSidebar = false;
        sidebar.style.width = '0';
    });

    document.addEventListener('mousemove', function(e) {
        if (e.clientX < 50 && !isMouseOverSidebar) {
            sidebar.style.width = '200px';
        }
    });
});