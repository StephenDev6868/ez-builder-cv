(function($) {
    "use strict"; // Start of use strict
    
    $("#copy_link").on("click", function(e) {
        const itemInput = document.createElement('input');
        itemInput.type = 'text';
        const content = document.getElementById('link_invite').value;
        itemInput.value = content;
        document.body.appendChild(itemInput);
        itemInput.select();
        const result = document.execCommand('copy');
        if (result) {
            const html = `<i class="fa fa-check-circle text-success"></i><small> ${langs.Copied}</smal>`;
            Swal.fire({
                position: 'top-end',
                timer: 3000,
                toast: true,
                html: html,
                showConfirmButton: false,
            });
        }
        document.body.removeChild(itemInput);
    });
})(jQuery); // End of use strict
