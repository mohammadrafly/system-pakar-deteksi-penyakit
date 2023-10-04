const base_url = 'http://localhost:8080/'

document.addEventListener('DOMContentLoaded', function () {
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const modal = document.getElementById('myModal');

    // Function to open the modal with animation
    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.remove('opacity-0', 'translate-y-[-50%]');
    }

    // Function to close the modal with animation
    function closeModal() {
        modal.classList.add('opacity-0', 'translate-y-[-50%]');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Wait for the animation duration
    }

    // Open modal button click handler
    openModalButton.addEventListener('click', openModal);

    // Close modal button click handler
    closeModalButton.addEventListener('click', closeModal);
});

// Function to hide flash messages after 3 seconds with a fade animation
function hideFlashMessages() {
    const flashMessages = document.querySelectorAll('.flash-message');
        
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => {
                message.style.display = 'none';
            }, 500); // Fade out duration (0.5 seconds)
        }, 3000); // Message display duration (3 seconds)
    });
}


document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('tbody');
    let itemsPerPage = 5; // Default number of items to display per page
    let currentPage = 1;

    function updateTable() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(currentPage * itemsPerPage, tableBody.children.length);

        for (let i = 0; i < tableBody.children.length; i++) {
            if (i >= startIndex && i < endIndex) {
                tableBody.children[i].style.display = '';
            } else {
                tableBody.children[i].style.display = 'none';
            }
        }

        const totalItems = tableBody.children.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`
    }

    updateTable();

    document.getElementById('prevPage').addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });

    document.getElementById('nextPage').addEventListener('click', function () {
        const totalItems = tableBody.children.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            updateTable();
        }
    });

    document.getElementById('itemsPerPage').addEventListener('change', handleItemsPerPageChange);
});

document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.querySelector('.group');
    dropdownButton.addEventListener('click', function() {
      const dropdownMenu = this.querySelector('ul');
      dropdownMenu.classList.toggle('hidden');
    });
  });

  function signOut() {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "anda ingin keluar dari sistem?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I Want to Sign Out!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url:`${base_url}logout`,
                type: 'GET',
                dataType: 'JSON',
                success: function (respond) {
                    swal.fire({
                        icon: respond.icon,
                        title: respond.title,
                        text: respond.text,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    }).then (function() {
                        window.location.href = `${base_url}`;
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.hideLoading();
                    swal.fire("!Opps ", "Something went wrong, try again later", "error");
                }
            });
        };
    });
}

function showAlert(icon, title, text) {
    Swal.fire({
        icon: icon, 
        title: title, 
        text: text,
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false
    }).then(() => location.reload());
}