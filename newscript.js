document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const leftMenu = document.getElementById('left-menu');

    // Hàm để chuyển đổi hiển thị của left-menu
    function toggleMenu() {
        leftMenu.classList.toggle('show');
    }

    // Hàm để ẩn menu khi nhấp vào bất kỳ nơi nào khác ngoài menu và nút
    function handleClickOutside(event) {
        if (!leftMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            if (leftMenu.classList.contains('show')) {
                leftMenu.classList.remove('show');
            }
        }
    }

    // Thêm sự kiện nhấp chuột vào menu-toggle
    menuToggle.addEventListener('click', toggleMenu);

    // Thêm sự kiện nhấp chuột ra ngoài menu và nút
    document.addEventListener('click', handleClickOutside);
});
