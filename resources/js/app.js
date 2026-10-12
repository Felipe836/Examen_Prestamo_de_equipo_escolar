document.addEventListener('DOMContentLoaded', () => {
    // 1. Selector de Tema (Modo Claro / Modo Oscuro)
    const themeToggleBtn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('prestahard_theme') || 'light';

    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const activeTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('prestahard_theme', newTheme);
        });
    }

    // 2. Menú Móvil Sidebar Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.querySelector('.sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // 3. Agregar Dinámicamente Equipos en Formulario de Préstamo
    const addEquipmentBtn = document.getElementById('add-equipment-row');
    const equipmentContainer = document.getElementById('equipment-rows');

    if (addEquipmentBtn && equipmentContainer) {
        addEquipmentBtn.addEventListener('click', () => {
            const firstRow = equipmentContainer.querySelector('.equipment-row');
            if (firstRow) {
                const newRow = firstRow.cloneNode(true);
                const inputQty = newRow.querySelector('input[type="number"]');
                if (inputQty) inputQty.value = 1;
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm';
                removeBtn.innerText = 'Eliminar';
                removeBtn.addEventListener('click', () => newRow.remove());

                newRow.appendChild(removeBtn);
                equipmentContainer.appendChild(newRow);
            }
        });
    }
});